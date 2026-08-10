window.computeRiskIndex = function()
{
    const impact      = Number($('[name="impact"]').val() || 0);
    const probability = Number($('[name="probability"]').val() || 0);
    const rate        = parseInt(impact * probability, 10);

    let pri = '';
    if(0 < rate && rate <= 5) pri = '3';
    if(5 < rate && rate <= 12) pri = '2';
    if(15 <= rate && rate <= 25) pri = '1';

    $('[name="rate"]').val(rate || '');
    if(pri) $('[name="pri"]').val(pri).trigger('change');
};