window.clickCondition = function()
{
    const condition = parseInt($('input[name=condition]').val());

    $('[data-name=conditionTitle]').toggleClass('hidden',    condition === 1);
    $('[data-name=divider]').toggleClass('hidden',           condition === 1);
    $('[data-name=workflowCondition]').toggleClass('hidden', condition === 1);
    $('input[name=condition]').val(condition === 0 ? 1 : 0);
}

window.changeAction = function(event)
{
    const action = $(event.target).val();
    $('.form-group[data-name=wheresBox]').toggleClass('hidden', action == 'insert');
    $('.form-group[data-name=fieldsBox]').toggleClass('hidden', action == 'delete');
}

window.changeTable = function(event)
{
    const table = $(event.target).val();
    $.getJSON($.createLink('workflowhook', 'ajaxGetTableFields', 'table=' + table), function(response)
    {
        $("input[name^='fields[field]']").each(function()
        {
            $(this).zui('picker').render({items: response});
            $(this).zui('picker').$.setValue('');
        });

        $("input[name^='wheres[field]']").each(function()
        {
            $(this).zui('picker').render({items: response});
            $(this).zui('picker').$.setValue('');
        });
    });
}
