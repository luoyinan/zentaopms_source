window.selectAll = function()
{
    let allChecked = true;
    $('input[name^=reports]').each(function()
    {
        if(!$(this).prop('checked')) allChecked = false;
    });
    $('input[name^=reports]').each(function()
    {
        $(this).prop('checked', !allChecked);
    });
};

window.clickInit = function()
{
    const form = new FormData();
    $('input[name^=reports]').each(function()
    {
        if($(this).prop('checked')) form.append('reports[]', $(this).val());
    });
    postAndLoadPage($.createLink(moduleName, 'report'), form, '#report');
};