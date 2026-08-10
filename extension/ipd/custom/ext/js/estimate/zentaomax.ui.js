window.changeUnit = function(e)
{
    if(e.target.value == undefined) return;

    const changed   = e.target.value;
    let   hourPoint = '';
    if(changed != unit)
    {
        if(changed == 0) hourPoint = workingHours;
        if(changed == 1) hourPoint = storyPoint;
        if(changed == 2) hourPoint = functionPoint;

        let convertTitle = convertRelationTitle.replace('%s', hourPoint);
        let convertTips  = convertRelationTips.replace(/%s/g, hourPoint);
        let submitTips   = saveTips.replace(/%s/g, hourPoint);

        $('#convertRelations .modal-title').text(convertTitle);
        $('#convertRelations #tips').text(convertTips);
        $('#convertFactor ~ .input-control-suffix').text(hourPoint);
        $('#saveTips').text(submitTips);

        zui.Modal.open({id: 'convertRelations'});
    }

    if(changed == 0)
    {
        $('#efficiency + .input-control-suffix').text(workingHours);
        $('#efficiency').val("1");
        $('.efficiencyBox').addClass('hidden');
    }

    if(changed == 1 || changed == 2)
    {
        $('#efficiency').val('');
        $('.efficiencyBox').removeClass('hidden');
        if(changed == 1) $('#efficiency + .input-control-suffix').text(efficiency + storyPoint);
        if(changed == 2) $('#efficiency + .input-control-suffix').text(efficiency + functionPoint);
    }
};

/**
 * Set scale factor.
 *
 * @access public
 * @return void
 */
window.setScaleFactor = function()
{
    let scaleFactor = $('#convertFactor').val();

    /* Judgment of required items. */
    if(!scaleFactor) return zui.Modal.alert(notempty);
    if(isNaN(scaleFactor)) return zui.Modal.alert(isNumber);

    $('[name=scaleFactor]').val(scaleFactor);
    zui.Modal.hide();
}
