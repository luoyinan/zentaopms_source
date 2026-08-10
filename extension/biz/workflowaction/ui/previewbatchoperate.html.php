<?php
namespace zin;

$formBatchItems = [];
foreach($fields as $field)
{
    $control = $this->flow->buildFormControl($field);
    $options = $this->workflowfield->getFieldOptions($field, true);
    $formBatchItems[] = formBatchItem
    (
        set::width('120px'),
        set::name($field->field),
        set::label($field->name),
        set::control($control['control']),
        set::items($options)
    );
}

formBatchPanel(
    set::actions(array()),
    set::maxRows(3),
    $formBatchItems
);
