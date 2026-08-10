window.getCellSpan = function(cell)
{
    if(!['stage', 'required'].includes(cell.col.name) && cell.row.data.rowspan)
    {
        return {rowSpan: cell.row.data.rowspan};
    }
}

window.onRenderCell = function(result, {row, col})
{
    if(result[0] && col.name == 'actions' && row.data.systemList == 1)
    {
        if(typeof result[0]?.props?.items == 'object')
        {
            result[0].props.items.map(item =>
            {
                delete item['data-toggle'];

                if(row.data.category == 'PP')
                {
                    item.url = $.createLink('programplan', 'browse', 'projectID=' + projectID);
                }
                else if(row.data.category == 'SRS')
                {
                    item.url = $.createLink('projectstory', 'story', 'projectID=' + projectID);
                }
                else if(['unittest', 'feature', 'intergrate', 'system', 'smoke', 'bvt'].includes(row.data.category))
                {
                    item.url = $.createLink('project', 'testcase', 'projectID=' + projectID);
                }
                else
                {
                    item.url = $.createLink('design', 'browse', 'projectID=' + projectID);
                }
            });
        }
    }

    return result;
}
