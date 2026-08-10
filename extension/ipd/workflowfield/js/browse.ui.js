window.renderFieldCell = function(result, info)
{
    if(info.col.name == 'sort')
    {
        result[0] = {html: "<i class='icon-move'></i>", className: 'text-gray cursor-move move-field'};
    }

    return result;
}

window.onSortEnd = function(from, to, type)
{
    if(!from || !to) return false;

    const url  = $.createLink('workflowfield', 'sort');
    const form = new FormData();

    form.append('fieldIdList', JSON.stringify(this.state.rowOrders));

    $.ajaxSubmit({url, data:form});
    $.apps.updateAppUrl($.createLink('workflowfield', 'browse', `module=${flowModule}`));
    return true;
}