window.clickSubmit = function(e)
{
    let hasData = false;
    $('[name^=name]').each(function()
    {
        if($(this).val())
        {
            hasData = true;
            return false;
        }
    })

    if(splitTaskRelation && Object.keys(splitTaskRelation).length > 0 && hasData)
    {
        zui.Modal.confirm({message: unlinkRelationTip, actions: [{key: 'confirm', text: unlinkLang, btnType: 'primary', class: 'btn-wide'}, {key: 'cancel'}]}).then((res) =>
        {
            if(res)
            {
                let $form    = $('#taskBatchCreateForm > .panel-body form');
                let formUrl  = $form.attr('action');
                let formData = new FormData($form[0]);

                let $submitBtn = $form.find('.form-actions [type=submit]');
                $submitBtn.prop('disabled', true);
                $.ajaxSubmit(
                {
                    url: formUrl,
                    data: formData,
                    onFail: (error) => {
                        $submitBtn.prop('disabled', false);
                       if(error?.message) showValidateMessage(error.message);
                }});
            }
            else
            {
                return false;
            }
        })

        return false;
    }
}
