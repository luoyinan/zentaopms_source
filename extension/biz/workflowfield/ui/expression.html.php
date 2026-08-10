<?php
namespace zin;

$jsRoot = $config->webRoot . 'js/';
h::import($jsRoot . 'math.js');

$modules      = array($flow->module => $flow->name);
$numberFields = $this->workflowfield->getNumberFields($flow->module);
$moduleFields = array($flow->module => $numberFields);

$targetBlocks = array();

$mainLinks = array();
foreach($numberFields as $fieldCode => $target)
{
    if(isset($field) && !empty($field->field) && $field->field == $fieldCode) continue;

    $displayTarget = $flow->name . '_' . $target;
    $mainLinks[]   = a(
        setClass('btn btn-expression'),
        set::href('javascript:;'),
        set('data-type', 'target'),
        set('data-module', $flow->module),
        set('data-field', $fieldCode),
        set('data-text', $displayTarget),
        $displayTarget
    );
}
$targetBlocks[] = div(set('module', $flow->module), $mainLinks);

if(!$flow->parent)
{
    $subTables = $this->loadModel('workflow', 'flow')->getPairs($flow->module);
    foreach($subTables as $subModule => $tableName)
    {
        $subFields = $this->workflowfield->getNumberFields($subModule, true);

        $modules[$subModule]      = $tableName;
        $moduleFields[$subModule] = $subFields;

        $subLinks = array();
        foreach($subFields as $fieldCode => $fieldName)
        {
            foreach($lang->workflowfield->formula->functions as $function => $label)
            {
                $displayTarget = sprintf($label, $tableName, $fieldName);
                $subLinks[]    = a(
                    setClass('btn btn-expression'),
                    set::href('javascript:;'),
                    set('data-type', 'target'),
                    set('data-module', $subModule),
                    set('data-field', $fieldCode),
                    set('data-function', $function),
                    set('data-text', $displayTarget),
                    $displayTarget
                );
            }
        }
        $targetBlocks[] = div(set('module', $subModule), $subLinks);
    }
}

jsVar('window.modules', $modules);
jsVar('window.moduleFields', $moduleFields);

$operatorLinks = array();
foreach($config->workflowfield->formula->operators as $operator => $label)
{
    $operatorLinks[] = a(
        setClass('btn btn-expression'),
        set::href('javascript:;'),
        set('data-type', 'operator'),
        set('data-operator', $operator),
        set('data-text', $label),
        $label
    );
}

$numberLinks = array();
foreach($config->workflowfield->formula->numbers as $number)
{
    $numberLinks[] = a(
        setClass('btn btn-expression'),
        set::href('javascript:;'),
        set('data-type', 'number'),
        set('data-value', (string)$number),
        set('data-text', (string)$number),
        (string)$number
    );
}

div(
    setID('expressionDIV'),
    setClass('hidden'),
    div(
        setClass('expression'),
        span(setClass('item-name'), $lang->workflowfield->formula->common),
        span('=')
    ),
    div(
        setClass('clear-expression'),
        a(
            setClass('clear-last'),
            set::href('javascript:;'),
            $lang->workflowfield->formula->clearLast
        ),
        a(
            setClass('clear-all'),
            set::href('javascript:;'),
            $lang->workflowfield->formula->clearAll
        )
    ),
    div(
        setClass('detail'),
        div(setClass('detail-heading'), $lang->workflowfield->formula->target),
        div(setClass('detail-content'), $targetBlocks)
    ),
    div(
        setClass('detail'),
        div(setClass('detail-heading'), $lang->workflowfield->formula->operator),
        array_merge($operatorLinks, array(div(setClass('detail-content'))))
    ),
    div(
        setClass('detail'),
        div(setClass('detail-heading'), $lang->workflowfield->formula->numbers),
        div(setClass('detail-content'), $numberLinks)
    ),
    div(
        setClass('form-actions text-center'),
        a(
            setClass('btn btn-primary save-expression'),
            set::href('javascript:;'),
            $lang->save
        ),
        a(
            setClass('btn cancel-expression'),
            set::href('javascript:;'),
            $lang->cancel
        )
    )
);
