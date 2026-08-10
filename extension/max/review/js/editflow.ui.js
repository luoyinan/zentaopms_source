window.refreshApproval = function()
{
    $.getJSON($.createLink('review', 'ajaxGetApproval', 'workflow=' + workflow), function(data)
    {
        $('[name=flow]').zui('picker').render(data)
    });
}

window.refreshDesignLink = function(e)
{
    $('#designBtn').removeClass('hidden');

    var flow = e.target.value;
    if(flow.length == 0) $('#designBtn').addClass('hidden');

    var link = $.createLink('approvalflow', 'design', 'id=' + flow);
    $('#designBtn').attr('href', link);
}
