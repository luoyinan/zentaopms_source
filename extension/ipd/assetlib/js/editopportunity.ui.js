window.computeOpportunityIndex = function()
{
    const impact = Number($('[name="impact"]').val() || 0);
    const chance = Number($('[name="chance"]').val() || 0);
    const ratio  = parseInt(impact * chance, 10);

    let pri = '';
    if(0 < ratio && ratio <= 5) pri = '3';
    if(5 < ratio && ratio <= 12) pri = '2';
    if(15 <= ratio && ratio <= 25) pri = '1';

    $('[name="ratio"]').val(ratio || '');
    if(pri) $('[name="pri"]').val(pri).trigger('change');
};