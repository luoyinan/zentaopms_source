window.changeInvolvedReport = function(e)
{
    const isChecked = $(e.target).prop('checked');
    $.cookie.set('involvedReport', isChecked ? 1 : 0, {expires: config.cookieLife, path: config.webRoot});
    loadCurrentPage();
};
