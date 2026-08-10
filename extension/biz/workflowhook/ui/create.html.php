<?php
/**
 * The create file of workflowhook module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowhook
 * @link        https://www.zentao.net
 */
namespace zin;

$whereDatasources = $datasources;
unset($whereDatasources['formula']);

$formFields = defineFieldList('workflowhook');
$formFields->field('conditionTitle')->label($lang->workflowhook->condition)->control(array('control' => 'input', 'class' => 'hidden'))->labelClass('font-bold')->hidden(true)->width('full');
$formFields->field('workflowCondition')->control(array('control' => 'workflowcondition', 'datasources' => $datasources, 'fields' => $fields, 'module' => $flow->module))->hidden(true)->width('full');
$formFields->field('condition')->hidden(true)->value(0)->width('full');
$formFields->field('divider')->control(array('control' => 'divider', 'class' => 'my-2'))->hidden(true)->width('full');

$formFields->field('hookTitle')->label($lang->workflowhook->hook)->control(array('control' => 'input', 'class' => 'hidden'))->labelClass('font-bold')->width('full');
$formFields->field('action')->required(true)->control(array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeAction', 'data-params' => 'event'))->items($lang->workflowhook->actionList)->value('update')->width('1/2');
$formFields->field('table')->required(true)->control(array('control' => 'picker', 'data-on' => 'change', 'data-call' => 'changeTable', 'data-params' => 'event'))->items($tables)->value($flow->module)->width('1/2');
$formFields->field('fieldsBox')->control(array('control' => 'workflowFieldCondition', 'title' => $lang->workflowhook->field, 'name' => 'fields', 'hasLogicalOperator' => false, 'datasources' => $datasources, 'fields' => $fields, 'module' => $flow->module))->width('full');
$formFields->field('wheresBox')->control(array('control' => 'workflowFieldCondition', 'title' => $lang->workflowhook->where, 'name' => 'wheres', 'hasLogicalOperator' => true, 'datasources' => $whereDatasources, 'fields' => $fields, 'module' => $flow->module, 'data' => array(array('wheres[field]' => 'id', 'wheres[operator]' => 'equal', 'wheres[paramType]' => 'record', 'wheres[param]' => 'id'))))->width('full');
$formFields->field('message')->width('full');
$formFields->field('comment')->label($lang->comment)->control(array('control' => 'textarea', 'rows' => 3))->width('full');

formPanel
(
    set::actions(array(array('text' => $lang->workflowhook->condition, 'class' => 'primary', 'data-on' => 'click', 'data-call' => 'clickCondition'), 'submit')),
    set::title($title),
    set::layout('grid'),
    set::fields($formFields)
);

formula(set::flow($flow));
