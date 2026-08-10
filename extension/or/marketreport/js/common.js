let eventInitiator = '';

function getPicker(name)
{
    return $('#' + name).data('zui.picker');
}

function toggleInsideRows()
{
    const source = $('[name=source]:checked').val();
    $('.showInside').toggle(source !== 'outside');
}

$(function()
{
    if($('#market').length)
    {
        $('#market').on('select', function() { eventInitiator = 'market'; });
        $('#market').on('change', function(event, changeValue)
        {
            const picker = getPicker('research');
            if(!picker) return;

            const marketID = parseInt(changeValue && changeValue.value ? changeValue.value : '0');
            $.get(createLink('marketreport', 'ajaxGetResearchList', 'marketID=' + marketID), function(data)
            {
                picker.updateOptionList(JSON.parse(data), true);
                if(eventInitiator == 'market') picker.setValue('');
            });
        });
    }

    if($('#research').length)
    {
        $('#research').on('select', function() { eventInitiator = 'research'; });
        $('#research').on('change', function(event, changeValue)
        {
            const picker = getPicker('market');
            if(!picker) return;

            const researchID = parseInt(changeValue && changeValue.value ? changeValue.value : '0');
            $.get(createLink('marketreport', 'ajaxGetMarketList', 'researchID=' + researchID), function(data)
            {
                data = JSON.parse(data);
                picker.updateOptionList(data, true);
                if(data.length == 1) picker.setValue(data[0].value);
            });
        });
    }

    $(document).on('change', '[name=source]', toggleInsideRows);
    toggleInsideRows();
});
