window.changeApproval = function(event)
{
    $('.approvalflowBox').toggleClass('hidden', $(event.target).val() != 'enabled');
}

window.changeApprovalFlow = function(event)
{
    const approval = $(event.target).val();
    if(approval)
    {
        $(event.target).closest('.input-group').find('a.designBtn').removeClass('hidden');
        $(event.target).closest('.input-group').find('a.designBtn').attr('href', $.createLink('approvalflow', 'design', 'id=' + $(event.target).val()));
    }
    else
    {
        $(event.target).closest('.input-group').find('a.designBtn').addClass('hidden');
    }
}

window.beforeSubmit = async function()
{
    let result = true;
    if($('input[name=approval]:checked').val() == 'enabled' && $('input[name=approvalFlow]').val() > 0)
    {
        result = await zui.Modal.confirm({title: confirmTitle, message: {html: confirmContent}, size: 'xm', actions: [{class: 'danger', key: 'confirm', text: confirmedBtn}, {key: 'cancel'}]});
    }
    return result;
}

window.enableApproval = function(workflow, flowID)
{
    const approval     = 'enabled';
    const approvalFlow = flowID;
    const url          = $.createLink('workflow', 'setapproval', `workflow=${workflow}`);

    $.post(url, {approval, approvalFlow}, function(response)
    {
        loadPage();
    })
}
