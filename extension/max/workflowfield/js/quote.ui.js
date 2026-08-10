window.showField = function(event)
{
    const fieldID = $(event.target).closest('.btn').data('id');
    loadPage($.createLink('workflowfield', 'quote', 'module=' + module + '&groupID=' + groupID + '&fieldID=' + fieldID), '#fieldInfo');
}

window.useField = function()
{
    const form = new FormData();
    $('input[type=checkbox]:checked').each(function()
    {
        form.append('fields[]', $(this).closest('.listitem').data('field'));
    });
    $.ajaxSubmit({url: $.createLink('workflowfield', 'quote', 'module=' + module + '&groupID=' + groupID), data:form});
}
