window.changeType = function(e)
{
    const value = e.target.value;
    const $form = $(e.target).closest('form');
    if(value == 'batch')
    {
        $form.find('.batch-mode-row').removeClass('hidden');
        $('[name=position]').closest('.form-row').addClass('hidden');
        $('[name=show]').closest('.form-row').addClass('hidden');
        $('[name=open]').zui('picker').render({items: batchOpenList});
    }
    else
    {
        $form.find('.batch-mode-row').addClass('hidden');
        $('[name=position]').closest('.form-row').removeClass('hidden');
        $('[name=show]').closest('.form-row').removeClass('hidden');
        $('[name=open]').zui('picker').render({items: openList});
    }
}
