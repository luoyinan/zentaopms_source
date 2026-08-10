window.changeSource = function(value)
{
    if(typeof value == 'object') value = '';

    const field = $('[name^=source]').val();
    const url   = $.createLink('approvalflow', 'ajaxGetFieldControl', `field=${field}&module=${workflow}`);
    $.get(url, function(data)
    {
        data = JSON.parse(data);

        $('.source-value-box').html(`<div class='form-group-wrapper controlBox'></div>`);

        const controlBox = $('.source-value-box .controlBox');
        const options    = data.options;
        const control    = data.control;
        const name       = 'value[1]';

        if(control == 'picker')
        {
            new zui.Picker(controlBox, {
                items: options,
                name: name,
                required: true,
                value: value
            });
        }
        else if(control == 'datePicker')
        {
            const datePicker = new zui.DatePicker(controlBox, {name: name, value: value});
        }
        else if(control == 'datetimePicker')
        {
            const datetimePicker = new zui.DatetimePicker(controlBox, {name: name, value: value});
        }
        else
        {
            controlBox.html(`<input type='text' class='form-control' name='${name}' required value='${value}'>`);
        }
    });

    disableFields();
}

window.changeTarget = function(event)
{
    disableFields();
}

window.addTarget = function(event)
{
    let index = 0;
    let options = zui.Picker.query("[name^='target']").options;
    options = JSON.parse(JSON.stringify(options));

    /* 计算目标字段的最大index. */
    const chosenFields = [];
    const sourceField = $(".source-field-box [name^='source']").val();
    if(sourceField) chosenFields.push(sourceField);

    $(".linkage-target-row [name^='target']").each(function()
    {
        chosenFields.push($(this).val());
        let id = $(this).attr('name').replace(/[^\d]/g, '');
        id = parseInt(id);
        index = id > index ? id : index;
    })

    index ++;

    /* Disable chosen products. */
    options.items.forEach(function(item)
    {
        if(chosenFields.includes(item.value)) item.disabled = true;
    });

    const copyRow = $('.linkage-target-row').first().clone();
    copyRow.find('.target-label').text('');

    copyRow.find('.target-box').html(`<div class="form-group-wrapper target-box-inner${index}"></div>`);
    copyRow.find('.status-box').html(`<div class="form-group-wrapper status-box-inner${index}"></div>`);

    $(event.target).closest('.linkage-target-row').after(copyRow);

    new zui.Picker(`.target-box-inner${index}`, {name: `target[${index}]`, items: options.items});
    new zui.Picker(`.status-box-inner${index}`, {name: `status[${index}]`, items: window.statusItems, required: true});

    disableFields();
}

window.delTarget = function(event)
{
    if($('.linkage-target-row').length == 1) return;
    $(event.target).closest('.linkage-target-row').remove();
}

/**
 * 已经选中的目标字段不可重复选择。
 * Disable the fields that have been selected.
 */
function disableFields()
{
    let chosenFields  = [];
    const sourceField = $(".source-field-box [name^='source']").val();
    if(sourceField) chosenFields.push(sourceField);

    $(".linkage-target-row [name^='target']").each(function()
    {
        const field= $(this).val();
        if(field && chosenFields.indexOf(field) == -1) chosenFields.push(field);
    });

    let allItems = zui.Picker.query("[name^='target']").options.items;
    let fieldItems = [];
    for(i = 0; i < allItems.length; i++)
    {
        allItems[i].disabled = false;
        if(chosenFields.includes(allItems[i].value)) allItems[i].disabled = true;
        fieldItems[allItems[i].value] = Object.assign({},allItems[i]);
        fieldItems[allItems[i].value].i = i;
    }

    $(".linkage-source-row [name^='source']").each(function()
    {
        const $field = $(this).zui('picker');
        const field  = $(this).val();
        let currentFieldItems = JSON.parse(JSON.stringify(allItems));
        if(field) currentFieldItems[fieldItems[field].i].disabled = false;

        $field.render({items: currentFieldItems});
    });

    $(".linkage-target-row [name^='target']").each(function()
    {
        const $field = $(this).zui('picker');
        const field  = $(this).val();
        let currentFieldItems = JSON.parse(JSON.stringify(allItems));
        if(field) currentFieldItems[fieldItems[field].i].disabled = false;

        $field.render({items: currentFieldItems});
    });
}

window.waitDom('.source-field-box .picker-select', function()
{
    disableFields();
    changeSource($('[name^=value]').val());
});