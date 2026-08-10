const saveButton      = $('#saveButton');
const saveDraftButton = $('#saveDraftButton');

function submitReport(e, status)
{
    saveButton.attr('disabled', true);
    saveDraftButton.attr('disabled', true);

    $("#dataform input[name='status']").remove();
    $('<input />').attr('type', 'hidden').attr('name', 'status').attr('value', status).appendTo('#dataform');
    $('#dataform').trigger('submit');
    e.preventDefault();

    setTimeout(function()
    {
        if(saveDraftButton.attr('disabled') == 'disabled')
        {
            setTimeout(function()
            {
                saveButton.removeAttr('disabled');
                saveDraftButton.removeAttr('disabled');
            }, 1000);
        }
        else
        {
            saveButton.removeAttr('disabled');
        }
    }, 100);
}

$(function()
{
    if(typeof sourceData !== 'undefined' && sourceData == 'outside') $('.showInside').hide();

    saveButton.on('click', function(e)
    {
        submitReport(e, 'published');
    });

    saveDraftButton.on('click', function(e)
    {
        submitReport(e, 'draft');
    });
});
