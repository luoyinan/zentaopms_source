window.clickSubmit = function()
{
    if(navigator.userAgent.toLowerCase().indexOf("opera") > -1) return true;

    const $fileName = $('#fileName');
    if($fileName.val() === '') $fileName.val(untitledText);

    $.cookie.set('downloading', 0, {expires: config.cookieLife, path: config.webRoot});
    time = setInterval("closeWindow()", 300);
    $('.modal-dialog').addClass('loading');

    return true;
};

window.closeWindow = function()
{
    if($.cookie.get('downloading') == 1)
    {
        $('.modal-dialog').removeClass('loading');
        zui.Modal.hide();
        $.cookie.set('downloading', null);
        clearInterval(time);
    }
};
