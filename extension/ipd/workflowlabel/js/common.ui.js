window.renderRowData = function($row, index, row)
{
    if(index === 0)
    {
        $row.find('[data-name=fields]').find('.picker-box').on('inited', function(e, info)
        {
            info[0].render({disabled: true});
        });
        $row.find('[data-name=operators]').find('.picker-box').on('inited', function(e, info)
        {
            info[0].render({disabled: true});
        });
        $row.find('[data-name=valueBox]').find('.picker-box').on('inited', function(e, info)
        {
            info[0].render({disabled: true});
        });
        $row.find('button[data-type=delete]').addClass('hidden');
    }
    else
    {
        $row.find('[data-name=valueBox]').find('.picker-box').on('inited', function(e, info)
        {
            processValueBox($(e.target).closest('.form-batch-row'), index + 1, row);
        });
    }
}

window.processValueBox = function($row, index, data)
{
    const operator = $row.find('[name^=operators]').val();
    const field    = $row.find('[name^=fields]').val();

    if(!field) return false;

    $row.find('#valueBox').empty();
    $.getJSON($.createLink('workflowfield', 'ajaxGetFieldOptions', 'module=' + moduleName + '&field=' + field), function(response)
    {
        if(response.control == 'input')
        {
            $row.find('#valueBox').append("<input class='form-control form-batch-input' type='text' autocomplete='off' name='values[" + index + "]' id='values' data-name='values' value='" + (data.values ? data.values : '') + "'/>");
            if(operator == 'between')
            {
                $row.find('#valueBox').append("<input class='form-control form-batch-input' type='text' autocomplete='off' name='values2[" + index + "]' id='values2' data-name='values2' value='" + (data.values2 ? data.values2 : '') + "'/>");
            }
        }
        else if(response.control == 'datePicker')
        {
            $row.find('#valueBox').append("<div id='values_" + index + "' class='form-group-wrapper picker-box'></div>");
            new zui.DatePicker(`#values_${index}`, {
                name: `values[${index}]`,
                defaultValue: data.values ? data.values : ''
            });
            $(`#values_${index}`).val(data.values);
            if(operator == 'between')
            {
                $row.find('#valueBox').append("<div id='values2_" + index + "' class='form-group-wrapper picker-box'></div>");
                new zui.DatePicker(`#values2_${index}`, {
                    name: `values2[${index}]`,
                    defaultValue: data.values2 ? data.values2 : ''
                });
            }
        }
        else if(response.control == 'datetimePicker')
        {
            $row.find('#valueBox').append("<div id='values_" + index + "' class='form-group-wrapper picker-box'></div>");
            new zui.DatetimePicker(`#values_${index}`, {
                name: `values[${index}]`,
                defaultValue: data.values ? data.values : ''
            });

            if(operator == 'between')
            {
                $row.find('#valueBox').append("<div id='values2_" + index + "' class='form-group-wrapper picker-box'></div>");
                new zui.DatetimePicker(`#values2_${index}`, {
                    name: `values2[${index}]`,
                    defaultValue: data.values2 ? data.values2 : ''
                });
            }
        }
        else
        {
            $row.find('#valueBox').append("<div id='values_" + index + "' class='form-group-wrapper picker-box'></div>");
            new zui.Picker(`#values_${index}`, {
                items: response.options,
                name: `values[${index}]`,
                defaultValue: data.values ? data.values : ''
            });

            if(operator == 'between')
            {
                $row.find('#valueBox').append("<div id='values2_" + index + "' class='form-group-wrapper picker-box'></div>");
                new zui.Picker(`#values2_${index}`, {
                    items: response.options,
                    name: `values2[${index}]`,
                    defaultValue: data.values2 ? data.values2 : ''
                });
            }
        }
    });
    setTimeout(function() {$row.find(`#values_${index}`).attr('data-name', 'values');$row.find(`#values2_${index}`).attr('data-name', 'values2');}, 1000);
}

window.changeFields = function(event)
{
    const $tr   = $(event.target).closest('.form-batch-row');
    const index = $tr.data('index') + 1;
    const value = $tr.find('input[name^=values]').val();
    processValueBox($tr, index, {values: value});
}

window.changeType = function(event)
{
    const $form = $('#editLabelForm');
    const type  = event && event.target ? $(event.target).val() : $form.find('[name=type]').val();

    $form.find('[data-name=paramsBox]').toggleClass('hidden', type == 'sql');
    $form.find('[data-name=sql]').toggleClass('hidden', type != 'sql');
}

$(function()
{
    changeType();
    setTimeout(changeType, 100);
});
