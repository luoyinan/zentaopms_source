const saveButton      = $('#saveButton');
const saveDraftButton = $('#saveDraftButton');

window.addNewMarket = function()
{
    const checked        = $('#newMarket').prop('checked');
    const marketPicker   = $('#marketPickerBox');
    const marketNameBox  = $('#marketNameBox');
    const researchPicker = $('#research').data('zui.picker');
    const marketPickerUI = $('#market').data('zui.picker');

    marketPicker.toggleClass('hidden', checked);
    marketNameBox.toggleClass('hidden', !checked);

    if(!researchPicker) return;

    if(checked)
    {
        researchPicker.setValue('');
        researchPicker.setDisabled(true);
        if(marketPickerUI) marketPickerUI.setValue('');
    }
    else
    {
        researchPicker.setDisabled(false);
    }
};

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
    $('#newMarket').on('change', window.addNewMarket);
    window.addNewMarket();

    saveButton.on('click', function(e)
    {
        submitReport(e, 'published');
    });

    saveDraftButton.on('click', function(e)
    {
        submitReport(e, 'draft');
    });
});
