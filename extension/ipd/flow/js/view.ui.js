window.reloadPage = function(e)
{
    let $this = $(e.target);

    $.getJSON($this.attr('href'), function(response)
    {
        if(response.message)
        {
            zui.Modal.alert(response.message).then(() => response.locate ? loadPage(response.locate) : loadCurrentPage());
        }
        else
        {
            response.locate ? loadPage(response.locate) : loadCurrentPage();
        }
    });
    return false;
};

window.loadAllPrevData = function()
{
    $('.prevField').each(function()
    {
        loadPrevData($(this));
    });
    $('.prevTR').each(function()
    {
        loadPrevData($(this), 0, 'tr');
    });
}