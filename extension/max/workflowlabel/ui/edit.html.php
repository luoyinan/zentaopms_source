<?php
/**
 * The edit file of workflowlabel module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowlabel
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('moduleName', $label->module);

$type = empty($label->type) ? 'data' : $label->type;

$typeList = array();
foreach($lang->workflowlabel->typeList as $typeName => $typeLabel) $typeList[] = array('text' => $typeLabel, 'value' => $typeName);

$params = array();
$params[] = array('label' => $lang->workflowlabel->params, 'name' => 'fields', 'control' => array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeFields', 'data-params' => 'event'), 'items' => $fields);
$params[] = array('label' => '', 'name' => 'operators', 'control' => array('control' => 'picker', 'items' => $lang->workflowlabel->operatorList, 'data-on' => 'change', 'data-call' => 'changeFields', 'data-params' => 'event'));
$params[] = array('label' => '', 'name' => 'valueBox',  'control' => array('control' => 'inputGroup', 'items' => array(array('control' => 'picker', 'name' => 'values', 'items' => $lang->workflowfield->default->options->deleted), array('control' => 'input', 'name' => 'values2', 'class' => 'hidden'))));

$orders   = array();
$orders[] = array('label' => $lang->workflowlabel->orderBy, 'name' => 'orderFields', 'control' => array('control' => 'picker', 'shareSelections' => true), 'items' => $fields);
$orders[] = array('label' => '',                            'name' => 'orderTypes',  'control' => array('control' => 'picker', 'required' => true),        'items' => $lang->workflowlabel->orderTypeList);

$paramsData = empty($label->params) ? array(array('fields' => 'deleted', 'operators' => 'equal', 'values' => '0')) : $label->params;

$fields = defineFieldList('workflowlabel');
$fields->field('label')->control(['type' => 'input', 'id' => 'label'])->required(true)->value($label->label)->width('full');
$fields->field('type')->control('picker')->items($typeList)->value($type)->width('full');
$fields->field('paramsBox')->class($type == 'sql' ? 'condition-box data-condition-box hidden' : 'condition-box data-condition-box')->control(array('control' => 'formBatch', 'minRows' => '2', 'tagName' => 'div', 'actions' => array(), 'items' => $params, 'data' => $paramsData, 'actionsText' => '', 'onRenderRow' => jsRaw('renderRowData')))->width('full');
$fields->field('sql')->class($type == 'sql' ? 'condition-box sql-condition-box' : 'condition-box sql-condition-box hidden')->label($lang->workflowlabel->sql)->control(array('control' => 'textarea', 'rows' => 4, 'placeholder' => $lang->workflowlabel->placeholder->sql))->value(zget($label, 'sql', ''))->width('full');
$fields->field('ordersBox')->control(array('control' => 'formBatch', 'minRows' => '1', 'tagName' => 'div', 'actions' => array(), 'items' => $orders, 'data' => $label->orderBy, 'actionsText' => ''))->width('full');

formPanel
(
    on::change('[name=type]', 'changeType'),
    set::formID('editLabelForm'),
    set::title($title),
    set::layout('grid'),
    set::fields($fields)
);
