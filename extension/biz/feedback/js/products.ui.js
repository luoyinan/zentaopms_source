window.onRenderCell = function(result, {row, col})
{
    if(result && col.name == 'name')
    {
        if(row.data.dataType == 'program')     result[0] = {html: "<icon class='icon icon-program mr-1'></icon>" + result[0]};
        if(row.data.dataType == 'productLine') result[0] = {html: "<icon class='icon icon-data-structure mr-1'></icon>" + result[0]};
    }

    return result;
}
