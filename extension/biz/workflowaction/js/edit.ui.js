window.changeStatus = function(e)
{
    const value = e.target.value;
    const $form = $(e.target).closest('form');
    if(value == 'enable')
    {
        $form.find('.action-toggle-row').removeClass('hidden');
    }
    else
    {
        $form.find('.action-toggle-row').addClass('hidden');
    }
};