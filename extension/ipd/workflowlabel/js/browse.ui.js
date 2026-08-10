window.onRenderCell = function(result, info)
{
    if(info.col.name == 'id')
    {
        result[0] = {html: "<i class='icon-move'></i>", className: 'text-gray cursor-move move-process'};
    }
    return result;
};

window.onSortEnd = function(from, to, type)
{
    if(!from || !to) return false;

    const url  = $.createLink('workflowlabel', 'sort');
    const form = new FormData();

    form.append('labels', JSON.stringify(this.state.rowOrders));

    $.ajaxSubmit({url, data:form});
    return true;
}
