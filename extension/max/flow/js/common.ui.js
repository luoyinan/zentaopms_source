function loadPrevData(selector, dataID, element)
{
    let $selector = $(selector);
    if($selector.length == 0) return;
    if(typeof $selector.data('prev') == 'undefined') $selector = $selector.closest('.prevField');

    if(typeof dataID  === 'undefined') dataID  = 0;
    if(typeof element === 'undefined') element = 'p';

    let prev   = $selector.data('prev');
    let next   = $selector.data('next');
    let action = $selector.data('action');
    if(dataID == 0) dataID = $selector.data('dataid');

    $('.prevData.' + prev).remove();

    /* Must use flow as module name here because the function ajaxGetPrevData is not a action of a flow. */
    var link = $.createLink('flow', 'ajaxGetPrevData', 'prev=' + prev + '&next=' + next + '&action=' + action + '&dataID=' + dataID + '&element=' + element);
    $.get(link, function(prevData)
    {
        if(!prevData) return false;

        let prevHtml = prevData;
        if(action != 'view') prevHtml = "<div class='prevData pt-2 " + prev + "'>" + prevData + "</div>";
        if(element == 'p') $selector.append(prevHtml);
        if(element == 'tr') $selector.after(prevHtml);
    });
}

window.loadSubStatus = function(event)
{
    const status = event.target.value;
    let  options = $('div[data-name="subStatus"]').data('options');
    if(typeof options == 'undefined') return;

    let currentOptions = options?.[status]?.options;
    if(currentOptions == 'undefined') return;

    let items = [];
    for(let key in currentOptions) {
        items.push({text: currentOptions[key], value: key});
    }

    if(items.length > 0) $('[name="subStatus"]').zui('picker').render({items: items});
};