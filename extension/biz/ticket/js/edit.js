$(function()
{
    if(notifyEmailRequired) $("input[name^=notifyEmail").parent().addClass('required');
    if(customerRequired)    $("input[name^=customer").parent().addClass('required');
    if(contactRequired)     $("input[name^=contact").parent().addClass('required');
    if($('.detail .contactBox').length == 1) $('.detail .contactBox a:last').addClass('hidden');
})

/**
 * Add item.
 *
 * @param  obj $obj
 * @access public
 * @return void
 */
function addItem(obj)
{
    var item = $('#addItem').html().replace(/%i%/g, itemIndex);
    $(obj).closest('tr').next('.notifyEmailBox').after(item);
    if($('.detail .contactBox').length > 1) $('.detail .contactBox a').removeClass('hidden');
    itemIndex ++;
}

/**
 * Delete item.
 *
 * @param  obj $obj
 * @access public
 * @return void
 */
function deleteItem(obj)
{
    $(obj).closest('tr').next('.notifyEmailBox').remove();
    $(obj).closest('tr').prev('.customerBox').remove();
    $(obj).closest('tr').remove();
    if($('.detail .contactBox').length == 1) $('.detail .contactBox a:last').addClass('hidden');
}
