<?php
/**
 * The edit file of workflowhook module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowhook
 * @link        https://www.zentao.net
 */
namespace zin;

$hook = $action->hooks[$key];

$whereDatasources = $datasources;
unset($whereDatasources['formula']);

$formFields = defineFieldList('workflowhook');
$formFields->field('conditionTitle')->label($lang->workflowhook->condition)->control(array('control' => 'input', 'class' => 'hidden'))->labelClass('font-bold')->hidden(empty($hook->conditions) ? true : false)->width('full');
$formFields->field('workflowCondition')->control(array('control' => 'workflowcondition', 'datasources' => $datasources, 'fields' => $fields, 'module' => $flow->module, 'data' => $hook))->hidden(empty($hook->conditions) ? true : false)->width('full');
$formFields->field('condition')->hidden(true)->value(empty($hook->conditions) ? 0 : 1)->width('full');
$formFields->field('divider')->control(array('control' => 'divider', 'class' => 'my-2'))->hidden(empty($hook->conditions) ? true : false)->width('full');

$formFields->field('hookTitle')->label($lang->workflowhook->hook)->control(array('control' => 'input', 'class' => 'hidden'))->labelClass('font-bold')->width('full');
$formFields->field('action')->required(true)->control(array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeAction', 'data-params' => 'event'))->items($lang->workflowhook->actionList)->value($hook->action)->width('1/2');
$formFields->field('table')->required(true)->control(array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeTable', 'data-params' => 'event'))->items($tables)->value($hook->table)->width('1/2');
$formFields->field('fieldsBox')->control(array('control' => 'workflowFieldCondition', 'title' => $lang->workflowhook->field, 'name' => 'fields', 'hasLogicalOperator' => false, 'datasources' => $datasources, 'fields' => $tableFields, 'module' => $hook->table, 'data' => $hook->fields))->width('full')->hidden($hook->action == 'delete');
$formFields->field('wheresBox')->control(array('control' => 'workflowFieldCondition', 'title' => $lang->workflowhook->where, 'name' => 'wheres', 'hasLogicalOperator' => true, 'datasources' => $whereDatasources, 'fields' => $tableFields, 'module' => $hook->table, 'data' => $hook->wheres))->hidden($hook->action == 'insert')->width('full');
$formFields->field('message')->value(!empty($hook->message) ? $hook->message : '')->width('full');
$formFields->field('comment')->label($lang->comment)->control(array('control' => 'textarea', 'rows' => 3))->value(!empty($hook->comment) ? $hook->comment : '')->width('full');

formPanel
(
    set::actions(array(array('text' => $lang->workflowhook->condition, 'class' => 'primary', 'data-on' => 'click', 'data-call' => 'clickCondition'), 'submit')),
    set::title($title),
    set::layout('grid'),
    set::fields($formFields)
);

formula(set::flow($flow));
