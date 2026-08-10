window.clickSubmit = function(e)
{
    const status = $(e.submitter).data('status');
    if(status === undefined) return;

    $(e.submitter).closest('form').find('[name=status]').val(status);
};