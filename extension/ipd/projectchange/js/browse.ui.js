window.onRenderCell = function(result, info)
{
    const {col, row} = info;
    if(col.name == 'actions')
    {
        if(row.data.status != 'wait' && row.data.status != 'reject' && row.data.status != 'reviewing')
        {
            const actionItem = result[0]?.props?.items?.[4];
            if(actionItem && actionItem.disabled) actionItem['hint'] = deleteHint.replace('%s', statusList[row.data.status]);
        }
    }

    if(col.name == 'status' && row.data.isConditionalPassApproval)
    {
        result[0].props.children += '(' + conditionalResult + ')';
    }
    return result;
};
