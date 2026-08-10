window.refreshApproval = function()
{
    $.getJSON($.createLink('review', 'ajaxGetApproval', 'workflow=' + workflow), function(data)
    {
        $('[name=flow]').zui('picker').render(data)
    });
}

window.refreshDesignLink = function(e)
{
    $('a.designLink').removeClass('hidden');

    var flow = e.target.value;
    if(flow.length == 0) $('a.designLink').addClass('hidden');

    var link = $.createLink('approvalflow', 'design', 'id=' + flow);
    $('a.designLink').attr('href', link);
}
