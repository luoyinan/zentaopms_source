<?php
namespace zin;

set::zui(true);

jsVar('window.defaultField', $config->workflowfield->default);
jsVar('window.maxField', $config->workflowfield->max);
jsVar('window.minField', $config->workflowfield->min);
jsVar('window.placeholder', $lang->workflowfield->placeholder);
jsVar('window.workflowfieldTypeList', $config->workflowfield->typeList);

$controlSelectItems = array();
foreach($lang->workflowfield->controlTypeList as $value => $text)
{
    $controlSelectItems[] = array('value' => $value, 'text' => $text);
}

$datasourceSelectItems = array();
foreach($datasources as $value => $text)
{
    $datasourceSelectItems[] = array('value' => (string)$value, 'text' => $text);
}
jsVar('window.importDatasourceItems', $datasourceSelectItems);

$allTypeItems = array();
foreach($config->workflowfield->typeList as $group => $typeList)
{
    foreach($typeList as $type => $label)
    {
        $allTypeItems[] = array('value' => $type, 'text' => $label);
    }
}

$batchData = array();
foreach($fieldList as $key => $field)
{
    $batchData[] = array(
        'rowKey'          => $key,
        'name'            => $field->name,
        'field'           => $field->field,
        'control'         => $field->control,
        'type'            => $field->type,
        'length'          => $field->length !== '' && $field->length !== null ? $field->length : 255,
        'integerDigits'   => isset($field->integerDigits) ? $field->integerDigits : 10,
        'decimalDigits'   => isset($field->decimalDigits) ? $field->decimalDigits : 2,
        'optionType'      => zget($field, 'datasource', ''),
        'options'         => zget($field, 'options', ''),
        'sql'             => zget($field, 'sql', ''),
        'default'         => zget($field, 'defaultValue', ''),
    );
}

$items = array(
    array(
        'name'     => 'name',
        'label'    => $lang->workflowfield->name,
        'control'  => 'input',
        'width'    => '120px',
        'required' => true,
    ),
    array(
        'name'     => 'field',
        'label'    => $lang->workflowfield->field,
        'control'  => 'input',
        'width'    => '120px',
        'required' => true,
    ),
    array(
        'name'     => 'control',
        'label'    => $lang->workflowfield->control,
        'control'  => array('control' => 'picker', 'items' => $controlSelectItems),
        'width'    => '120px',
        'required' => true,
    ),
    array(
        'name'     => 'type',
        'label'    => $lang->workflowfield->type,
        'control'  => array('control' => 'picker', 'items' => $allTypeItems),
        'width'    => '120px',
        'required' => true,
    ),
    array(
        'name'        => 'length',
        'label'       => $lang->workflowfield->length,
        'control'     => array(
            'control'     => 'number',
            'class'       => 'form-control length',
            'min'         => 1,
            'max'         => 1000,
            'step'        => 1,
            'placeholder' => $lang->workflowfield->placeholder->varcharLength,
        ),
        'width'       => '100px',
        'placeholder' => $lang->workflowfield->placeholder->varcharLength,
    ),
    array(
        'name'        => 'integerDigits',
        'label'       => $lang->workflowfield->integerDigits,
        'control'     => array(
            'control'     => 'number',
            'class'       => 'form-control digits',
            'min'         => 1,
            'max'         => 12,
            'step'        => 1,
            'placeholder' => $lang->workflowfield->placeholder->integerDigits,
        ),
        'width'       => '100px',
        'placeholder' => $lang->workflowfield->placeholder->integerDigits,
    ),
    array(
        'name'        => 'decimalDigits',
        'label'       => $lang->workflowfield->decimalDigits,
        'control'     => array(
            'control'     => 'number',
            'class'       => 'form-control digits',
            'min'         => 0,
            'max'         => 8,
            'step'        => 1,
            'placeholder' => $lang->workflowfield->placeholder->decimalDigits,
        ),
        'width'       => '100px',
        'placeholder' => $lang->workflowfield->placeholder->decimalDigits,
    ),
    array(
        'name'    => 'optionType',
        'label'   => $lang->workflowfield->datasource,
        'control' => array('control' => 'picker', 'items' => $datasourceSelectItems),
        'width'   => '140px',
    ),
    array(
        'name'    => 'options',
        'label'   => $lang->workflowfield->options,
        'control' => array('control' => 'textarea', 'rows' => 1),
        'width'   => '180px',
    ),
    array(
        'name'    => 'sql',
        'label'   => $lang->workflowfield->sql,
        'control' => array('control' => 'textarea', 'rows' => 1),
        'width'   => '180px',
    ),
    array(
        'name'    => 'default',
        'label'   => $lang->workflowfield->defaultValue,
        'control' => 'input',
        'width'   => '120px',
    ),
);

formBatchPanel
(
    set::title($lang->workflowfield->showImport),
    set::mode('edit'),
    set::formID('ajaxForm'),
    set::url(inlink('showImport', "module={$module}")),
    set::idKey('rowKey'),
    set::items($items),
    set::data($batchData),
    set::showExtra(false),
    set::addRowIcon(false),
    set::deleteRowIcon(false),
    set::sortRowIcon(false),
    set::onRenderRow(jsRaw('onRenderRow')),
    on::change('[data-name="control"]', 'onControlChange'),
    on::change('[data-name="type"]', 'onTypeChange'),
    on::change('[data-name="length"], [data-name="integerDigits"], [data-name="decimalDigits"]', 'onNumberChange'),
    on::change('[data-name="optionType"]', 'onOptionTypeChange'),
    on::change('[name^=options], [name^=sql]', 'onOptionsSqlChange'),
    div(setClass('text-warning px-4 pb-2'), $lang->workflowfield->excel->tips),
);

render();
