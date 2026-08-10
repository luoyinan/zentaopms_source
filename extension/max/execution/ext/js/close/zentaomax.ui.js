window.showErrorTip = function($element, name, message)
{
    if(name.includes('-'))
    {
        const parts = name.split('-');
        const deliverableID = parts[1];
        const docID         = parts[2];

        const $control = $element.find('input[name="deliverable[' + deliverableID + '][doc][]"][value="' + docID + '"]').closest('div[data-form-name="deliverable[' + deliverableID + ']"]');
        const $tip     = $control.find('.form-tip');
        return {$control, $control, $tip, message};
    }
}
