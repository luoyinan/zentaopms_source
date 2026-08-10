<?php
/**
 * The create file of workflowlabel module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowlabel
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('moduleName', $module);

$typeList = array();
foreach($lang->workflowlabel->typeList as $type => $typeName) $typeList[] = array('text' => $typeName, 'value' => $type);

$params = array();
$params[] = array('label' => $lang->workflowlabel->params, 'name' => 'fields', 'control' => array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeFields', 'data-params' => 'event'), 'items' => $fields);
$params[] = array('label' => '', 'name' => 'operators', 'control' => array('control' => 'picker', 'items' => $lang->workflowlabel->operatorList, 'data-on' => 'change', 'data-call' => 'changeFields', 'data-params' => 'event'));
$params[] = array('label' => '', 'name' => 'valueBox',  'control' => array('control' => 'inputGroup', 'items' => array(array('control' => 'picker', 'name' => 'values', 'items' => $lang->workflowfield->default->options->deleted), array('control' => 'input', 'name' => 'values2', 'class' => 'hidden'))));

$orders   = array();
$orders[] = array('label' => $lang->workflowlabel->orderBy, 'name' => 'orderFields', 'control' => array('control' => 'picker', 'shareSelections' => true), 'items' => $fields);
$orders[] = array('label' => '',                            'name' => 'orderTypes',  'control' => array('control' => 'picker', 'required' => true),        'items' => $lang->workflowlabel->orderTypeList);

$fields = defineFieldList('workflowlabel');
$fields->field('label')->control(['type' => 'input', 'id' => 'label'])->required(true)->width('full');
$fields->field('type')->control('picker')->items($typeList)->value('data')->width('full');
$fields->field('paramsBox')->class('condition-box data-condition-box')->control(array('control' => 'formBatch', 'minRows' => '2', 'tagName' => 'div', 'actions' => array(), 'items' => $params, 'data' => array(array('fields' => 'deleted', 'operators' => 'equal', 'values' => '0')), 'actionsText' => '', 'onRenderRow' => jsRaw('renderRowData')))->width('full');
$fields->field('sql')->class('condition-box sql-condition-box hidden')->label($lang->workflowlabel->sql)->control(array('control' => 'textarea', 'rows' => 4, 'placeholder' => $lang->workflowlabel->placeholder->sql))->value("deleted = '0'")->width('full');
$fields->field('ordersBox')->control(array('control' => 'formBatch', 'minRows' => '1', 'tagName' => 'div', 'actions' => array(), 'items' => $orders, 'actionsText' => ''))->width('full');

formPanel
(
    on::change('[name=type]', 'changeType'),
    set::formID('createLabelForm'),
    set::title($title),
    set::layout('grid'),
    set::fields($fields)
);
