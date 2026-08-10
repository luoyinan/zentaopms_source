window.changeType = function()
{
    const type = $('[name="type"]').val();
    if(type === 'no')
    {
        $('.dataLine, .sqlLine, .messageLine').addClass('hidden');
    }
    else if(type === 'sql')
    {
        $('.sqlLine, .messageLine').removeClass('hidden');
        $('.dataLine').addClass('hidden');
    }
    else
    {
        $('.dataLine, .messageLine').removeClass('hidden');
        $('.sqlLine').addClass('hidden');
    }
}

window.renderDataFormRowData = function($row, index, row)
{
    // 第一行不显示逻辑运算符控件
    if(index == 0) $row.find('[data-name*=logicalOperator] > div').addClass('hidden');
    $row.find('[data-name="verifications[paramType]"]').find('.picker-box').on('inited', function(e, info)
    {
        const $td          = $row.find('[data-name="verifications[param]"]');
        const $paramType   = typeof row != 'undefined' ? row['verifications[paramType]'] : $row.find('[name*=paramType]').val();
        const defaultValue = typeof row != 'undefined' ? row['verifications[param]'] : '';
        let   key          = parseInt($row.attr('data-index')) + 1;
        let   name         = 'verifications[param][' + key + ']';

        loadParam($td, $paramType, defaultValue, name, $row);
    });
}

window.renderSqlFormRowData = function($row, index, row)
{
    $row.find('[data-name="paramType"]').find('.picker-box').on('inited', function(e, info)
    {
        const $td          = $row.find('[data-name="param"]');
        const $paramType   = typeof row != 'undefined' ? row['paramType'] : $row.find('[name^=paramType]').val();
        const defaultValue = typeof row != 'undefined' ? row['param'] : '';
        let   key          = parseInt($row.attr('data-index')) + 1;
        let   name         = 'param[' + key + ']';

        loadParam($td, $paramType, defaultValue, name, $row);
    });
}

window.changeParamType = function(event)
{
    const $tr        = $(event.target).closest('.form-batch-row');
    const type       = $tr.closest('.form-group').hasClass('dataLine') ? 'data' : 'sql';
    const $td        = type == 'data' ? $tr.find('[data-name="verifications[param]"]') : $tr.find('[data-name="param"]');
    const $paramType = $tr.find('[name*=paramType]').val();
    let   key        = parseInt($tr.attr('data-index')) + 1;
    let   name       = type == 'data' ? 'verifications[param][' + key + ']' : 'param[' + key + ']';

    loadParam($td, $paramType, '', name, $tr);
}

function loadParam($td, paramType, defaultValue, name, $tr)
{
    $tr = $tr || $td.closest('.form-batch-row');

    switch(paramType)
    {
        case 'deptManager':
            $td.html("<input type='text' name='" + name + "' value='deptManager' class='form-control disabled'>");
            break;
        case 'actor':
            $td.html("<input type='text' name='" + name + "' value='actor' class='form-control disabled'>");
            break;
        case 'today':
            $td.html('<div class="form-group-wrapper controlBox"></div>');
            new zui.DatePicker($td.find('.controlBox'), {name: name, defaultValue: defaultValue});
            break;
        case 'now':
            $td.html('<div class="form-group-wrapper controlBox"></div>');
            new zui.DatetimePicker($td.find('.controlBox'), {name: name, defaultValue: defaultValue});
            break;
        case 'custom':
            const field = $tr.find('[name*=field]').val();
            const key   = parseInt($tr.attr('data-index')) + 1;
            if(field)
            {
                loadFieldControl($tr, field, key, defaultValue);
            }
            else
            {
                $td.html("<input type='text' name='" + name + "' value='" + defaultValue + "' class='form-control'>");
            }
            break;
        default:
            const link = $.createLink('workflowfield', 'ajaxGetParamOptions', 'paramType=' + paramType);
            $.getJSON(link, function(data)
            {
                $td.html('<div class="form-group-wrapper controlBox"></div>');

                const controlBox = $td.find('.controlBox');
                new zui.Picker(controlBox, {
                    items: data.options,
                    name: name,
                    defaultValue: defaultValue,
                    required: true
                });
            });
    }
}

window.changeVarName = function(e)
{
    const $sql = $('.sqlLine').find('[name=sql]');
    $sql.val($sql.val() + "'$" + $(e.target).val() + "'");
}

window.changeField = function(e)
{
    const $tr       = $(e.target).closest('.form-batch-row');
    const paramType = $tr.find('[name*=paramType]').val();
    if(paramType != 'custom') return;

    const $td  = $tr.find('[data-name="verifications[param]"]');
    const key  = parseInt($tr.attr('data-index')) + 1;
    const name = 'verifications[param][' + key + ']';

    loadParam($td, paramType, '', name, $tr);
}

window.loadFieldControl = function(tr, field, key, defaultValue = '')
{
    const url = $.createLink('approvalflow', 'ajaxGetFieldControl', `field=${field}&module=${workflow}`);
    $.get(url, function(data)
    {
        data = JSON.parse(data);

        tr.find('[data-name="verifications[param]"]').html(`<div class='form-group-wrapper controlBox'></div>`);

        const controlBox = tr.find('[data-name="verifications[param]"] .controlBox');
        const options    = data?.options;
        const control    = data?.control;
        const name       = 'verifications[param][' + key + ']';

        if(control == 'picker')
        {
            new zui.Picker(controlBox, {
                items: options,
                name: name,
                defaultValue: defaultValue,
                required: true
            });
        }
        else if(control == 'datePicker')
        {
            new zui.DatePicker(controlBox, {name: name, defaultValue: defaultValue});
        }
        else if(control == 'datetimePicker')
        {
            new zui.DatetimePicker(controlBox, {name: name, defaultValue: defaultValue});
        }
        else
        {
            controlBox.html(`<input type='text' class='form-control' name='${name}' value='${defaultValue}' required>`);
        }
    });
}
