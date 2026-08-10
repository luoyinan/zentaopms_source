<?php
namespace zin;

$formGroups = [];
foreach($fields as $field)
{
    if(strpos($field->field, 'sub_') === 0 && !isset($childFields[$field->field])) continue;

    if($field->field == 'id' || $field->field == 'parent')
    {
        $formGroups[] = formGroup
        (
            set::label($field->name),
            set::width('1/2'),
            input
            (
                set::name($field->field),
                set::value($lang->workflowfield->placeholder->auto),
                set::disabled(true)
            )
        );
    }
    elseif(isset($childFields[$field->field]))
    {
        $items = [];
        foreach($childFields[$field->field] as $childField)
        {
            if(!$childField->show) continue;
            if($childField->control == 'file') continue;

            $control = $this->flow->buildFormControl($childField);
            $options = $this->workflowfield->getFieldOptions($childField, true);
            $items[$childField->field] = array(
                'name' => $childField->field,
                'label' => $childField->name,
                'control' => $control['control'],
                'items' => $options
            );
        }

        $formGroups[] = formGroup
        (
            set::width('full'),
            set::label($field->name),
            formBatch
            (
                set::tagName('div'),
                set::mode('add'),
                set::actions([]),
                set::maxRows(2),
                set::items($items)
            )
        );
    }
    else
    {
        $control = $this->flow->buildFormControl($field);
        $options = $this->workflowfield->getFieldOptions($field, true);
        $width   = $control['control'] == 'editor' ? 'full' : '1/2';
        $formGroups[] = formGroup
        (
            set::width($width),
            set::label($field->name),
            set::control($control['control']),
            set::items($options)
        );
    }
}

formPanel(
    set::actions(array()),
    set::layout('grid'),
    $formGroups
);