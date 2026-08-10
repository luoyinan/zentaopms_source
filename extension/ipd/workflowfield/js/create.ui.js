window.waitDom('.picker-box [name=type]', function(){setDataTip();})

function initOptionSortable()
{
    var $container = $('.option-rows-sortable').first();
    if(!$container.length) return;

    var sortable = $container.data('zui.sortable');
    if(sortable && typeof $container.sortable === 'function')
    {
        try { $container.sortable('destroy'); } catch(e) {}
    }

    $container.sortable({
        selector: '.form-group.optionGroup',
        trigger: '.sortItem',
        dragCssClass: 'drag-row',
        reverse: true
    });
}

/*
 * 初始化变量，绑定事件
 * Init variables, bind events.
 */
$(document).ready(function()
{
    const expressionEventNamespace = '.workflowfieldExpression';
    const expressionSelectors      = ['.btn-expression', '.clear-last', '.clear-all', '.save-expression', '.cancel-expression', '.set-expression'];

    expressionSelectors.forEach(function(selector)
    {
        $(document).off('click', selector);
        $(document).off('click' + expressionEventNamespace, selector);
    });

    window.minField.integerDigits = parseInt(window.minField.integerDigits);
    window.maxField.integerDigits = parseInt(window.maxField.integerDigits);
    window.minField.decimalDigits = parseInt(window.minField.decimalDigits);
    window.maxField.decimalDigits = parseInt(window.maxField.decimalDigits);

    /* 初始化公式变量。*/
    if($('#expression').val())
    {
        try
        {
            window.expression = JSON.parse($('#expression').val());
            if(!Array.isArray(window.expression)) window.expression = [];
        }
        catch(error)
        {
            window.expression = [];
        }
    }
    else
    {
        window.expression = [];
    }

    $(document).off('click' + expressionEventNamespace, '.btn-expression').on('click' + expressionEventNamespace, '.btn-expression', function()
    {
        var text = $(this).html();
        var data = $(this).data();
        var type = $(this).data('type');

        $('#expressionDIV .expression').append("<span class='item-expression item-" + type + "'>" + text + "</span>");

        window.expression.push(data);
        removeErrorLabel();
    });

    $(document).off('click' + expressionEventNamespace, '.clear-last').on('click' + expressionEventNamespace, '.clear-last', function()
    {
        $('#expressionDIV .expression .item-expression').last().remove();

        window.expression.pop();
        removeErrorLabel();
    });

    $(document).off('click' + expressionEventNamespace, '.clear-all').on('click' + expressionEventNamespace, '.clear-all', function()
    {
        $('#expressionDIV .expression .item-expression').remove();

        window.expression.length = 0;
        removeErrorLabel();
    });

    $(document).off('click' + expressionEventNamespace, '.save-expression').on('click' + expressionEventNamespace, '.save-expression', function()
    {
        var hasError = checkExpression();
        if(!hasError)
        {
            $('#fieldTable .expression').html($('#expressionDIV .expression').html());
            $('#fieldTable #expression').val(JSON.stringify(window.expression));
            $('#expressionDIV').addClass('hidden');
            $('#fieldTable').removeClass('hidden');
        }
    });

    $(document).off('click' + expressionEventNamespace, '.cancel-expression').on('click' + expressionEventNamespace, '.cancel-expression', function()
    {
        removeErrorLabel();

        $('#expressionDIV').addClass('hidden');
        $('#fieldTable').removeClass('hidden');
    });

    initOptionSortable();

    $(document).off('click' + expressionEventNamespace, '.set-expression').on('click' + expressionEventNamespace, '.set-expression', function()
    {
        initExpression();

        $('#expressionLabel').remove();
        $('#expressionDIV').removeClass('hidden');
        $('#fieldTable').addClass('hidden');
    });
});

/**
 * 设置数据提示
 * Set data tip.
 */
function setDataTip()
{
    var type     = $('[name=type]').val();
    var $dataTip = $('.dataTip');

    switch(type)
    {
        case 'tinyint' :
        case 'smallint' :
        case 'mediumint' :
        case 'int' :
            var max = window.maxField[type];
            var min = window.minField[type];
            $dataTip.html(window.tips.number.replace(/MAX/, max).replace(/MIN/, min)).removeClass('hidden');
            break;
        case 'decimal' :
            var integerDigits = $('#integerDigits').val();
                integerDigits = integerDigits ? parseInt(integerDigits) : 0;
                integerDigits = integerDigits > window.maxField.integerDigits ? window.maxField.integerDigits     : integerDigits;
                integerDigits = integerDigits < window.minField.integerDigits ? window.defaultField.integerDigits : integerDigits;
                integerDigits = parseInt(integerDigits);

            var decimalDigits = $('#decimalDigits').val();
                decimalDigits = decimalDigits ? parseInt(decimalDigits) : 0;
                decimalDigits = decimalDigits > window.maxField.decimalDigits ? window.maxField.decimalDigits     : decimalDigits;
                decimalDigits = decimalDigits < window.minField.integerDigits ? window.defaultField.decimalDigits : decimalDigits;
                decimalDigits = parseInt(decimalDigits);

            var max = '.'.padStart(integerDigits + 1, 9).padEnd(integerDigits + decimalDigits + 1, 9);
            var min = '-' + max;

            $dataTip.html(window.tips.number.replace(/MAX/, max).replace(/MIN/, min)).removeClass('hidden');
            break;
        case 'char' :
            var length = $('#length').val();
                length = length ? parseInt(length) : 0;
                length = length > window.maxField.charLength ? window.maxField.charLength     : length;
                length = length < window.minField.charLength ? window.defaultField.charLength : length;

            $dataTip.html(window.tips.string.replace(/LENGTH/, length)).removeClass('hidden');
            break;
        case 'varchar' :
            var length = $('#length').val();
                length = length ? parseInt(length) : 0;
                length = length > window.maxField.varcharLength ? window.maxField.varcharLength     : length;
                length = length < window.minField.varcharLength ? window.defaultField.varcharLength : length;

            $dataTip.html(window.tips.string.replace(/LENGTH/, length)).removeClass('hidden');
            break;
        default :
            $dataTip.html('').addClass('hidden');
    }
}

/**
 * 设置默认值的控件
 * Set default control.
 */
window.setDefaultControl = function()
{
    let control      = $('[name="control"]').val();
    let type         = $('[name="type"]').val();
    let optionType   = $('[name="optionType"]').val();
    let defaultValue = $('[name="default"]').val();

    if(control == 'input' || control == 'textarea' || control == 'multi-select' || control == 'checkbox' || control == 'richtext' || control == 'file')
    {
        $('.defaultBox').html("<input type='text' name='default' value='" + defaultValue + "' id='default' class='form-control' autocomplete='off'>");
        return false;
    }
    if(control == 'date')
    {
        const parent = $('.defaultBox').parent();
        $('.defaultBox').remove();
        parent.append('<div class="input-group defaultBox"></div>');
        new zui.DatePicker('.defaultBox', {
            name: 'default'
        });
        return false;
    }
    if(control == 'datetime')
    {
        const parent = $('.defaultBox').parent();
        $('.defaultBox').remove();
        parent.append('<div class="input-group defaultBox"></div>');
        new zui.DatetimePicker('.defaultBox', {
            name: 'default'
        });
        return false;
    }
    if(control == 'integer')
    {
        var max  = window.maxField[type];
        var min  = window.minField[type];

        $('.defaultBox').html("<input type='number' name='default' value='" + defaultValue + "' id='default' max='" + max + "' min='" + min + "' step='1' class='form-control' autocomplete='off'>");
        return false;
    }
    if(control == 'decimal' || control == 'formula')
    {
        var integerDigits = $('#integerDigits').val();
            integerDigits = integerDigits ? parseInt(integerDigits) : 0;
            integerDigits = integerDigits > window.maxField.integerDigits ? window.maxField.integerDigits     : integerDigits;
            integerDigits = integerDigits < window.minField.integerDigits ? window.defaultField.integerDigits : integerDigits;
            integerDigits = parseInt(integerDigits);

        var decimalDigits = $('#decimalDigits').val();
            decimalDigits = decimalDigits ? parseInt(decimalDigits) : 0;
            decimalDigits = decimalDigits > window.maxField.decimalDigits ? window.maxField.decimalDigits     : decimalDigits;
            decimalDigits = decimalDigits < window.minField.integerDigits ? window.defaultField.decimalDigits : decimalDigits;
            decimalDigits = parseInt(decimalDigits);

        var max  = '.'.padStart(integerDigits + 1, 9).padEnd(integerDigits + decimalDigits + 1, 9);
        var min  = '-' + max;
        var step = '0.'.padEnd(decimalDigits + 1, 0) + 1;

        $('.defaultBox').html("<input type='number' name='default' value='" + defaultValue + "' id='default' max='" + max + "' min='" + min + "' step='" + step + "' class='form-control' autocomplete='off'>");
        return false;
    }

    if(!optionType || optionType == 'category' || optionType == 'prevModule')
    {
        $('.defaultBox').html("<input type='text' name='default' value='" + defaultValue + "' id='default' class='form-control' autocomplete='off'>");
        return false;
    }

    if(typeof defaultValue === 'string') defaultValue = defaultValue.split(',');

    if(optionType == 'custom')
    {
        const parent = $('.defaultBox').parent();
        $('.defaultBox').remove();
        parent.append('<div class="input-group defaultBox"></div>');

        const multiple = (control == 'multi-select' || control == 'checkbox');
        const items    = [];
        $('input[id^=options][id*=code]').each(function(index, code)
        {
            var code = $(this).val();
            var name = $(this).closest('.input-group').find('input[id^=options][id*=name]').val();

            items.push({value: code, text: name});
        });

        new zui.Picker('.defaultBox', {
            items: items,
            name: 'default',
            defaultValue: defaultValue,
            required: false,
            multiple: multiple
        });
    }
    else
    {
        const parent = $('.defaultBox').parent();
        $('.defaultBox').remove();
        parent.append('<div class="input-group defaultBox"></div>');

        let sql = $('[name="sql"]').val();

        control = window.btoa(encodeURI(control));
        sql     = window.btoa(encodeURI(sql));
        value   = window.btoa(encodeURI(defaultValue));

        var link = $.createLink('workflowfield', 'ajaxGetDefaultControl', 'mode=advanced&control=' + control + '&optionType=' + optionType + '&type=' + type + '&sql=&sqlVar=&elementName=&default=' + value);
        $.post(link, {sql: sql}, function(data)
        {
            data = JSON.parse(data);
            new zui.Picker('.defaultBox', {
                items: data,
                name: 'default',
                required: false
            });

            $('#default').parent().html(data);
            initDefault($('#default'), control, optionType, type, sql, defaultValue);
        })
    }

    return false;
}

function initDefault($selector, control, optionType, type, sql, defaultValue)
{
    if($selector.find('option[value=ajax_search_more]').length == 1)
    {
        $selector.find('option[value=ajax_search_more]').remove();

        var url = createLink('workflowfield', 'ajaxGetMoreDefault', 'mode=advanced&control=' + control + '&optionType=' + optionType + '&type=' + type + '&sql=' + sql + '&sqlVars=&search={search}');

        initPicker($selector, {remote: url});
    }
    else
    {
        $selector.chosen().val(defaultValue).trigger('chosen:updated');
    }
}

function fixVarControls()
{
    var varControls = $('#varsTD .varControl');
    if(varControls.size() == 0) $('#varsTR').hide();
    for(i = 0; i < varControls.size(); i++)
    {
        if(i % 2 == 0)
        {
            $(varControls[i]).removeClass('pull-left pull-right').addClass('pull-left');
        }
        else
        {
            $(varControls[i]).removeClass('pull-left pull-right').addClass('pull-right');
        }
        if(i > 1)
        {
            $(varControls[i]).css('padding-top', '5px');
        }
        else
        {
            $(varControls[i]).css('padding', '0');
        }
    }
}

function initExpression()
{
    let name        = $('#name').val() == '' ? window.formulaLang.common : $('#name').val();
    let $expression = $('#expressionDIV .expression');

    $expression.find('.item-name').html(name);
    $expression.find('.item-expression').remove();

    if($('#expression').val())
    {
        window.expression = JSON.parse($('#expression').val());

        appendExpression(window.expression, $expression);
    }
    else
    {
        window.expression.length = 0;
    }
}

function appendExpression(expression, $selector)
{
    for(var i in expression)
    {
        let current = expression[i];
        let text    = current.text;
        if(current.type == 'target')
        {
            if(current.function)
            {
                text = window.formulaLang.functions[current.function].replace('%s', window.modules[current.module]).replace('%s', window.moduleFields[current.module][current.field]);
            }
            else
            {
                text = window.modules[current.module] + '_' + window.moduleFields[current.module][current.field];
            }
        }

        $selector.append("<span class='item-expression item-" + current.type + "'>" + text + "</span>");
    }
}

function checkExpression()
{
    if(window.expression.length == 0)
    {
        appendErrorLabel(window.formulaLang.error.empty);

        return true;
    }
    else
    {
        let fakeExpression = [];
        for(var i in window.expression)
        {
            let current = window.expression[i];

            if(current.type == 'target')   fakeExpression.push(current.field);
            if(current.type == 'operator') fakeExpression.push(current.operator);
            if(current.type == 'number')   fakeExpression.push(current.value);
        }

        fakeExpression = fakeExpression.join('');
        try
        {
            math.parse(fakeExpression);
        }
        catch(error)
        {
            appendErrorLabel(window.formulaLang.error.error);

            return true;
        }

        let error  = false;
        let length = window.expression.length;
        for(var i in window.expression)
        {
            i = parseInt(i);

            let current = window.expression[i];
            let prev    = '';
            let next    = '';

            if(i > 0)         prev = window.expression[i - 1];
            if(i < length -1) next = window.expression[i + 1];

            switch(current.type)
            {
                case 'target' :
                    if(prev != '' && (prev.type != 'operator' || prev.operator == ')'))
                    {
                        error = true;
                        break;
                    }
                    if(next != '' && (next.type != 'operator' || next.operator == '('))
                    {
                        error = true;
                        break;
                    }
                    break;
                case 'number' :
                    if(current.value == '.')
                    {
                        if(prev == '' || prev.type != 'number' || prev.value == '.')
                        {
                            error = true;
                            break;
                        }
                        if(next == '' || next.type != 'number' || next.value == '.')
                        {
                            error = true;
                            break;
                        }
                    }
                    else
                    {
                        if(prev != '' && (prev.type == 'target' || (prev.type == 'operator' && prev.operator == ')')))
                        {
                            error = true;
                            break;
                        }
                        if(next != '' && (next.type == 'target' || (next.type == 'operator' && next.operator == '(')))
                        {
                            error = true;
                            break;
                        }
                    }
                    break;
                case 'operator' :
                    switch(current.operator)
                    {
                        case '(' :
                            if(prev != '' && (prev.type != 'operator' || prev.operator == ')'))
                            {
                                error = true;
                                break;
                            }
                            if(next == '' || (next.type == 'number' && next.value == '.') || (next.type == 'operator' && next.operator != '('))
                            {
                                error = true;
                                break;
                            }
                            break;
                        case ')' :
                            if(prev == '' || (prev.type == 'number' && prev.value == '.') || (prev.type == 'operator' && prev.operator != ')'))
                            {
                                error = true;
                                break;
                            }
                            if(next != '' && (next.type != 'operator' || next.operator == '('))
                            {
                                error = true;
                                break;
                            }
                            break;
                        default :
                            if(prev == '' || (prev.type == 'operaor' && prev.operator != ')') || (prev.type == 'number' && prev.value == '.'))
                            {
                                error = true;
                                break;
                            }
                            if(next == '' || (next.type == 'operaor' && next.operator != '(') || (next.type == 'number' && next.value == '.'))
                            {
                                error = true;
                                break;
                            }
                    }
                    break;
            }

            if(error)
            {
                appendErrorLabel(window.formulaLang.error.error);

                return true;
            }
        }

        return false;
    }
}

function appendErrorLabel(message)
{
    removeErrorLabel();
    $('#expressionDIV .expression').css('border-color', '#953B39').after("<span id='expressionLabel' for='expression' class='danger-pale'>" + message + '</span>');
}

function removeErrorLabel()
{
    $('#expressionDIV .expression').css('border-color', '').next('#expressionLabel').remove();
}

/* Toggle options. */
window.changeControl = function(e)
{
    let control = $('[name="control"]').val();

    const isHiddenPlaceholder = window.hiddenPlaceholder.includes(control);
    if(isHiddenPlaceholder) {
        $('.tipInfoBox').addClass('hidden');
        $('.default-tip').addClass('hidden');
    } else {
        $('.tipInfoBox').removeClass('hidden');
        $('.default-tip').removeClass('hidden');
    }

    if(control == 'file')
    {
        $('.hide-in-file').addClass('hidden');
    }
    else
    {
        $('.hide-in-file').removeClass('hidden');
    }

    if(control == 'file') return false;

    let type            = window.defaultField.type;
    let optionClass     = window.defaultField.optionClass;
    let length          = $('#length').val();
    let integerDigits   = parseInt($('#integerDigits').val());
    let decimalDigits   = parseInt($('#decimalDigits').val());
    let isOptionControl = (control == 'select' || control == 'multi-select' || control == 'radio' || control == 'checkbox');

    if(!length) length = window.defaultField.varcharLength;

    if(!integerDigits || integerDigits < window.minField.integerDigits || integerDigits > window.maxField.integerDigits) integerDigits = window.defaultField.integerDigits;
    if(!decimalDigits || decimalDigits < window.minField.decimalDigits || decimalDigits > window.maxField.decimalDigits) decimalDigits = window.defaultField.decimalDigits;

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

    const options = typeList[optionClass];
    const items   = [];

    for(let key in options) {
        items.push({value: key, text: options[key]});
    }

    $('#length').val(length);
    $('#integerDigits').val(integerDigits);
    $('#decimalDigits').val(decimalDigits);
    $('[name="type"]').zui('picker').render({items: items});
    $('[name="type"]').zui('picker').$.setValue(type);

    $('.set-expression').closest('.form-group').toggleClass('hidden', control != 'formula');
    $('[name="optionType"]').closest('.form-group').toggleClass('hidden', !isOptionControl);
    changeOptionType();
    changeType();
}

window.changeType = function(e)
{
    let type = $('[name="type"]').val();

    if(type == 'char')    $('#length').attr({'placeholder' : window.placeholder.charLength,    'title' : window.placeholder.charLength,    'max' : window.maxField.charLength});
    if(type == 'varchar') $('#length').attr({'placeholder' : window.placeholder.varcharLength, 'title' : window.placeholder.varcharLength, 'max' : window.maxField.varcharLength});

    if(type == 'char' || type == 'varchar') {
        $('.varcharBox').removeClass('hidden');
    } else {
        $('.varcharBox').addClass('hidden');
    }

    if(type == 'decimal') {
        $('.integerBox').removeClass('hidden');
    } else {
        $('.integerBox').addClass('hidden');
    }

    if(type != 'text') {
        $('#default').closest('.form-group').removeClass('hidden');
        $('.default-tip').removeClass('hidden');
    } else {
        $('#default').closest('.form-group').addClass('hidden');
        $('.default-tip').addClass('hidden');
    }

    setDataTip();
    setDefaultControl();
}

window.changeLength = function(e)
{
    setDataTip();
    setDefaultControl();
}

window.changeOptionType = function(e)
{
    let control         = $('[name="control"]').val();
    let optionType      = $('[name="optionType"]').val();
    let isOptionControl = (control == 'select' || control == 'multi-select' || control == 'radio' || control == 'checkbox');

    $('.optionGroupWrap').toggleClass('hidden', !(isOptionControl && optionType == 'custom'));
    $('.sqlGroup').toggleClass('hidden', !(isOptionControl && optionType == 'sql'));

    $('#optionsDIVLabel, #sqlLabel').remove();

    setDefaultControl();

    if(isOptionControl && optionType == 'custom') initOptionSortable();
}

    /* Add a option. */
window.addItem = function(e)
{
    const $parent = $(e.target).closest('.form-group');
    const newLine = $parent.clone();

    newLine.find('.form-label').remove();
    newLine.find('input').val('');
    $parent.after(newLine);

    initOptionSortable();
};

    /* Delete a option. */
window.delItem = function(e)
{
    if($('.optionGroup').length > 1) $(e.target).parents('.optionGroup').remove();
}
