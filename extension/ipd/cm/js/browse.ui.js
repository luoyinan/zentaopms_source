window.onRenderCell = function(result, info)
{
    const {col, row} = info;
    if(col.name == 'status' && row.data.isConditionalPassApproval)
    {
        result[0].props.children += '(' + conditionalResult + ')';
    }
    return result;
};
