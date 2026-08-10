window.showTable = function(event)
{
    const tableID = $(event.target).closest('.btn').data('id');
    loadTarget($.createLink('workflow', 'ajaxViewDB', 'id=' + tableID), '#previewArea');
}

window.useTable = function()
{
    const form = new FormData();
    $('input[type=checkbox]:checked').each(function()
    {
        const module = $(this).closest('.listitem').data('module');
        if(module) form.append('tables[]', module);
    });

    $.ajaxSubmit({url: $.createLink('workflow', 'quotedb', 'module=' + module + '&groupID=' + groupID), data: form});
}

if(typeof(firstTableID) != 'undefined' && firstTableID)
{
    loadTarget($.createLink('workflow', 'ajaxViewDB', 'id=' + firstTableID), '#previewArea');
}
