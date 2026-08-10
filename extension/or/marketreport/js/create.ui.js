window.toggleMarketPickerBox = function(e)
{
    const value = $("[name='newMarket']").prop('checked');
    if(value)
    {
        $('#marketPickerBox').addClass('hidden');
        $('#marketNameBox').removeClass('hidden');
        $("[name='research']").zui('picker').render({disabled: true});
    }
    else
    {
        $('#marketPickerBox').removeClass('hidden');
        $('#marketNameBox').addClass('hidden');
        $("[name='research']").zui('picker').render({disabled: false});
    }
};

window.clickSubmit = function(e)
{
    const status = $(e.submitter).data('status');
    if(status === undefined) return;

    $(e.submitter).closest('form').find('[name=status]').val(status);
};