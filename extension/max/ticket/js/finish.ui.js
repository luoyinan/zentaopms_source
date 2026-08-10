window.updateConsumed = function()
{
    let currentConsumed = $('#currentConsumed').val();
    if(!parseFloat(currentConsumed)) currentConsumed = 0;

    var totalConsumed = parseFloat(currentConsumed) + parseFloat(consumed);
    totalConsumed = Math.round(totalConsumed * 1000) / 1000;
    $('#consumed').val(totalConsumed);
}
