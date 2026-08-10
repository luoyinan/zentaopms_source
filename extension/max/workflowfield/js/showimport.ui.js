/**
 * Workflow field import confirm — batch form (ZIN / formBatchPanel).
 * @link https://www.zentao.net
 */

window.onRenderRow = function($row, index, row)
{
    $row.attr('data-key', String(row.rowKey !== undefined ? row.rowKey : index));
    $row.find('[data-name=optionType]').find('.picker-box').on('inited', function(e, info)
    {
        onApplyControl($row);
    });

    $row.find('[data-name=type]').find('.picker-box').on('inited', function(e, info)
    {
        onUpdateTypeDependentUI($row, row.type);
    });
};

window.onControlChange = function(event)
{
    onApplyControl($(event.target).closest('tr'));
};

window.onTypeChange = function(event)
{
    onUpdateTypeDependentUI($(event.target).closest('tr'));
};

window.onNumberChange = function(event)
{
    onSetDefault($(event.target).closest('tr'));
};

window.onOptionTypeChange = function(event)
{
    onUpdateOptionSourceUI($(event.target).closest('tr'));
    onSetDefault($(event.target).closest('tr'));
};

window.onOptionsSqlChange = function(event)
{
    $(event.target).closest('td').find('.text-error').remove();
    onSetDefault($(event.target).closest('tr'));
};

/**
 * Build type picker items from workflowfieldTypeList[optionClass] (same shape as create.ui.js).
 */
function onTypeItemsForClass(optionClass)
{
    const options = window.workflowfieldTypeList[optionClass];
    const items     = [];
    if(!options) return items;
    for(const key in options) items.push({value: key, text: options[key]});
    return items;
}

function onApplyControl($row)
{
    let control = $row.find('[name^=control]').val();
    let type            = window.defaultField.type;
    let optionClass     = window.defaultField.optionClass;
    let length          = $row.find('[name^=length]').val();
    let integerDigits   = $row.find('[name^=integerDigits]').val();
    let decimalDigits   = $row.find('[name^=decimalDigits]').val();
    const optionTypeVal = $row.find('[name^=optionType]').val();
    const isOptionControl = (control == 'select' || control == 'multi-select' || control == 'radio' || control == 'checkbox');

    if(!length)        length        = window.defaultField.varcharLength;
    if(!integerDigits) integerDigits = window.defaultField.integerDigits;
    if(!decimalDigits) decimalDigits = window.defaultField.decimalDigits;

    switch(control)
    {
        case 'formula' :
        case 'decimal' :
            type        = 'decimal';
            optionClass = 'decimal';
            length      = '';
            break;
        case 'integer' :
            type        = 'int';
            optionClass = 'integer';
            length      = '';
            break;
        case 'multi-select' :
        case 'checkbox' :
        case 'textarea' :
        case 'richtext' :
            type        = 'text';
            optionClass = 'text';
            length      = '';
            break;
        case 'date' :
            type        = 'date';
            optionClass = 'date';
            length      = '';
            break;
        case 'datetime' :
            type        = 'datetime';
            optionClass = 'time';
            length      = '';
            break;
    }

    $row.find('[name^=length]').val(length);
    $row.find('[name^=integerDigits]').val(integerDigits);
    $row.find('[name^=decimalDigits]').val(decimalDigits);

    const $typePicker = $row.find('[name^=type]').zui('picker');
    if($typePicker && $typePicker.$)
    {
        const items       = onTypeItemsForClass(optionClass);
        const currentType = $row.find('[name^=type]').val();
        $typePicker.render({items: items});
        const keep = items.some(function(i){ return i.value === currentType; });
        const next = keep ? currentType : (items[0] ? items[0].value : type);
        if(typeof $typePicker.$.setValue === 'function') $typePicker.$.setValue(next, true);
    }

    const $optPicker = $row.find('[name^=optionType]').zui('picker');
    if($optPicker && $optPicker.$)
    {
        if(isOptionControl)
        {
            $optPicker.render({disabled: false, items: window.importDatasourceItems});
            $optPicker.$.setValue(optionTypeVal || '');
        }
        else
        {
            $optPicker.render({disabled: true, items: []});
            $optPicker.$.setValue('');
        }
    }

    onUpdateOptionSourceUI($row);
    onUpdateTypeDependentUI($row);
}

function onUpdateTypeDependentUI($row, type)
{
    if(!type) type = $row.find('[name^=type]').val();

    if(type == 'char')    $row.find('[name^=length]').attr({'placeholder' : window.placeholder.charLength,    'title' : window.placeholder.charLength,    'max' : window.maxField.charLength});
    if(type == 'varchar') $row.find('[name^=length]').attr({'placeholder' : window.placeholder.varcharLength, 'title' : window.placeholder.varcharLength, 'max' : window.maxField.varcharLength});

    if(['char', 'varchar'].includes(type))
    {
        $row.find('.length').removeClass('disabled');
        $row.find('.length').attr('disabled', false);
    }
    else
    {
        $row.find('.length').addClass('disabled');
        $row.find('.length').removeAttr('disabled');
    }

    if(type == 'decimal')
    {
        $row.find('.digits').removeClass('disabled');
        $row.find('.digits').removeAttr('disabled');
    }
    else
    {
        $row.find('.digits').addClass('disabled');
        $row.find('.digits').attr('disabled', true);
    }

    onSetDefault($row);
}

function onUpdateOptionSourceUI($row)
{
    const $sql            = $row.find('[name^=sql]');
    const $options        = $row.find('[name^=options]');
    const optionType      = $row.find('[name^=optionType]').val();
    const control         = $row.find('[name^=control]').val();
    const isOptionControl = (control == 'select' || control == 'multi-select' || control == 'radio' || control == 'checkbox');

    $sql.closest('td').find('.text-error').add($options.closest('td').find('.text-error')).remove();

    if(isOptionControl && optionType == 'sql')
    {
        $sql.removeClass('disabled');
        $sql.removeAttr('disabled');
        $options.val('');
        $options.addClass('disabled');
        $options.attr('disabled', true);
    }
    else if(isOptionControl && optionType == 'custom')
    {
        $sql.val('');
        $sql.addClass('disabled');
        $sql.attr('disabled', true);
        $options.removeClass('disabled');
        $options.removeAttr('disabled');
    }
    else
    {
        $sql.val('');
        $sql.addClass('disabled');
        $sql.attr('disabled', true);
        $options.removeClass('disabled');
        $options.removeAttr('disabled');
    }
}

function onSetDefault($row)
{
    const key          = $row.data('index');
    const control      = $row.find('[name^=control]').val();
    const type         = $row.find('[name^=type]').val();
    const optionType   = $row.find('[name^=optionType]').val();
    let   defaultValue = $row.find('[name^=default]').val();
    let   $defaultTD   = $row.find('td[data-name="default"]');
    if(!$defaultTD.length) $defaultTD = $row.find('[name^=default]').closest('td');

    $defaultTD.empty();
    $defaultTD.append(`<div class="input-group defaultBox${key}"></div>`);

    if(control == 'textarea' || control == 'multi-select' || control == 'checkbox' || control == 'richtext' || control == 'file')
    {
        $defaultTD.find(`.defaultBox${key}`).html("<input type='text' name='default[" + key + "]' id='default" + key + "' class='form-control' readonly>");
        return false;
    }
    if(control == 'input')
    {
        $defaultTD.find(`.defaultBox${key}`).html("<input type='text' name='default[" + key + "]' value='" + defaultValue + "' id='default" + key + "' class='form-control' autocomplete='off'>");
        return false;
    }
    if(control == 'date')
    {
        new zui.DatePicker(`.defaultBox${key}`, {
            name: 'default[' + key + ']'
        });
        return false;
    }
    if(control == 'datetime')
    {
        new zui.DatetimePicker(`.defaultBox${key}`, {
            name: 'default[' + key + ']'
        });
        return false;
    }
    if(control == 'integer')
    {
        const max = window.maxField[type];
        const min = window.minField[type];

        $defaultTD.find(`.defaultBox${key}`).html("<input type='number' name='default[" + key + "]' id='default" + key + "' max='" + max + "' min='" + min + "' step='1' class='form-control' autocomplete='off'>");
        return false;
    }
    if(control == 'decimal' || control == 'formula')
    {
        let integerDigits = $row.find('[name^=integerDigits]').val();
        integerDigits = integerDigits ? parseInt(integerDigits) : 0;
        integerDigits = integerDigits > window.maxField.integerDigits ? window.maxField.integerDigits     : integerDigits;
        integerDigits = integerDigits < window.minField.integerDigits ? window.defaultField.integerDigits : integerDigits;
        integerDigits = parseInt(integerDigits);

        let decimalDigits = $row.find('[name^=decimalDigits]').val();
        decimalDigits = decimalDigits ? parseInt(decimalDigits) : 0;
        decimalDigits = decimalDigits > window.maxField.decimalDigits ? window.maxField.decimalDigits     : decimalDigits;
        decimalDigits = decimalDigits < window.minField.integerDigits ? window.defaultField.decimalDigits : decimalDigits;
        decimalDigits = parseInt(decimalDigits);

        const max  = '.'.padStart(integerDigits + 1, 9).padEnd(integerDigits + decimalDigits + 1, 9);
        const min  = '-' + max;
        const step = '0.'.padEnd(decimalDigits + 1, 0) + 1;

        $defaultTD.find(`.defaultBox${key}`).html("<input type='number' name='default[" + key + "]' id='default" + key + "' max='" + max + "' min='" + min + "' step='" + step + "' class='form-control' autocomplete='off'>");
        return false;
    }

    if(!optionType || optionType == 'category' || optionType == 'prevModule')
    {
        $defaultTD.find(`.defaultBox${key}`).html("<input type='text' name='default[" + key + "]' id='default" + key + "' class='form-control' autocomplete='off'>");
        return false;
    }

    if(typeof defaultValue === 'string') defaultValue = defaultValue.split(',');

    if(optionType == 'custom')
    {
        const options  = $row.find('[name^=options]').val();
        const multiple = (control == 'multi-select' || control == 'checkbox');

        const items = [];
        $.each(String(options || '').split('\n'), function(index, value)
        {
            const arr  = value.split(',');
            const code = arr[0] ? arr[0] : '';
            const text = arr[1] !== undefined ? arr[1] : code;

            items.push({value: code, text: text});
        });

        new zui.Picker(`.defaultBox${key}`, {
            items: items,
            name: 'default[' + key + ']',
            defaultValue: defaultValue,
            required: false,
            multiple: multiple
        });

        return false;
    }

    const typeForAjax = $row.find('[name^=type]').val();
    const sql         = $row.find('[name^=sql]').val();

    const controlB64 = window.btoa(encodeURI(control));
    const sqlB64     = window.btoa(encodeURI(sql));
    const nameB64    = window.btoa(encodeURI(name));
    const valueStr   = Array.isArray(defaultValue) ? defaultValue.join(',') : String(defaultValue || '');
    const valueB64   = window.btoa(encodeURI(valueStr));
    const link       = $.createLink('workflowfield', 'ajaxGetDefaultControl', 'mode=advanced&control=' + controlB64 + '&optionType=' + optionType + '&type=' + typeForAjax + '&sql=' + sqlB64 + '&sqlVars=&elementName=' + nameB64 + '&default=' + valueB64);

    $.post(link, {sql: sqlB64}, function(data)
    {
        data = JSON.parse(data);
        new zui.Picker(`.defaultBox${key}`, {
            items: data,
            name: 'default[' + key + ']',
            required: false
        });
    })

    return false;
}