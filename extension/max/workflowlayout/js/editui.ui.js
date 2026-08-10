window.addCondition = function(event)
{
    let index = 0;
    let options = zui.Picker.query("[name^='field']").options;
    options = JSON.parse(JSON.stringify(options));

    /* 计算条件字段的最大index. */
    $(".condition-field-box [name^='field']").each(function()
    {
        let id = $(this).attr('name').replace(/[^\d]/g, '');
        id = parseInt(id);
        index = id > index ? id : index;
    })

    index ++;

    const copyRow = $('.condition-row').first().clone();

    copyRow.attr('data-key', index);
    copyRow.find('.condition-label-box .form-label').text('');
    copyRow.find('.condition-field-box').html(`<div class="form-group-wrapper condition-field-box-inner${index}"></div>`);
    copyRow.find('.condition-operator').html(`<div class="form-group-wrapper condition-operator-inner${index}"></div>`);
    copyRow.find('.condition-param').html(`<input type='text' class='form-control' name='param[${index}]'>`);

    $(event.target).closest('.condition-row').after(copyRow);

    new zui.Picker(`.condition-field-box-inner${index}`, {name: `field[${index}]`, items: options.items});
    new zui.Picker(`.condition-operator-inner${index}`, {name: `operator[${index}]`, items: operatorItems, required: true});
};

window.delCondition = function(event)
{
    const $rows = $('.condition-row');
    if($rows.length <= 1) return;
    $(event.target).closest('.condition-row').remove();
};

window.changeConditionField = function(event)
{
    const $row  = $(event.target).closest('.condition-row');
    const field = $(event.target).val();
    const link  = $.createLink('approvalflow', 'ajaxGetFieldControl', `field=${field}&module=${window.moduleName}`);

    $.get(link, function(data)
    {
        data = JSON.parse(data);

        $row.find('.condition-param').html(`<div class='form-group-wrapper controlBox'></div>`);

        const controlBox = $row.find('.condition-param .controlBox');
        const options    = data.options;
        const control    = data.control;
        const name       = `param[${$row.data('key')}]`;

        if(control == 'picker')
        {
            new zui.Picker(controlBox, {
                items: options,
                name: name,
                required: true
            });
        }
        else if(control == 'datePicker')
        {
            new zui.DatePicker(controlBox, {name: name});
        }
        else if(control == 'datetimePicker')
        {
            new zui.DatetimePicker(controlBox, {name: name});
        }
        else
        {
            controlBox.html(`<input type='text' class='form-control' name='${name}' required>`);
        }
    });
};