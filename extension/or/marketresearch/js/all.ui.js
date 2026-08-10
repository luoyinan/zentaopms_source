window.changeInvolved = function(event)
{
    var involved = $(event.target).is(':checked') ? 1 : 0;
    $.cookie.set('involvedResearch', involved, {expires: config.cookieLife, path: config.webRoot});
    window.reloadPage();
};

/**
 * 提示并删除调研。
 * Delete marketresearch with tips.
 *
 * @param  int    researchID
 * @param  string researchName
 * @access public
 * @return void
 */
window.confirmDelete = function(researchID, researchName)
{
    zui.Modal.confirm(confirmDelete.replace('%s', researchName)).then((res) =>
    {
        if(res) $.ajaxSubmit({url: $.createLink('marketresearch', 'delete', 'researchID=' + researchID)});
    });
}
