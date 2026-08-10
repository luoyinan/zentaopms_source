window.getCellSpan = function(cell)
{
    if(!['stage', 'required'].includes(cell.col.name) && cell.row.data.rowspan)
    {
        return {rowSpan: cell.row.data.rowspan};
    }
}

window.onRenderCell = function(result, {row, col})
{
    if(result && col.name == 'actions')
    {
        if(row.data.builtin)
        {
            $.each(result[0].props.items, function(i, item)
            {
                if(!item.disabled) return;
                result[0].props.items[i].hint = builtinConfirm;
            });
        }
    }

    return result;
}

$(document).off('click', '[data-formaction]').on('click', '[data-formaction]', function()
{
    const $this = $(this);
    if($this.attr('class').indexOf('disabled') !== -1) return;

    const dtable = zui.DTable.query($('#deliverableTable'));
    const checkedList = dtable.$.getChecks();
    if(!checkedList.length) return;

    const postData  = new FormData();
    const checkedID = {};
    checkedList.forEach((id) =>
    {
        id = String(id).split('_')[0];
        if(checkedID[id]) return;

        postData.append('deliverableIdList[]', id);
        checkedID[id] = true;
    });

    if($this.data('page') == 'batch')
    {
        postAndLoadPage($this.data('formaction'), postData);
    }
    else
    {
        $.ajaxSubmit({ "url": $this.data('formaction'), "data": postData });
    }
});
