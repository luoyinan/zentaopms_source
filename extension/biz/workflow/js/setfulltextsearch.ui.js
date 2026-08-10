window.buildIndex = function(event)
{
    const module = $(event.target).closest('a').data('module');
    zui.Modal.confirm(confirmMessage).then((res) =>
    {
        if(res)
        {
            $('#resultBox').closest('.form-group').removeClass('hidden');
            $('#resultBox').empty();
            $('.buildBtn').attr('disabled', 'disabled');
            $('.buildBtn').attr('data-on', '');
            ajaxBuildIndex($.createLink('workflow', 'buildIndex', 'module=' + module));
        }
    });
}

window.ajaxBuildIndex = function(url)
{
    $.getJSON(url, function(response)
    {
        if(response.result == 'finished')
        {
            $('#resultBox').append("<li class='text-success'>" + response.message + "</li>");
            $('.buildBtn').removeAttr('disabled');
            $('.buildBtn').attr('data-on', 'click');
        }
        else
        {
            $('#resultBox').append("<li class='text-success'>" + response.message + "</li>");
            ajaxBuildIndex(response.next);
        }
    })
}
