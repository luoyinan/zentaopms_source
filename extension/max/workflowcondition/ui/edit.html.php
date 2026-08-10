<?php
/**
 * The edit file of workflowcondition module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowcondition
 * @link        https://www.zentao.net
 */
namespace zin;

$conditions = $action->conditions[$key];
$conditions->conditions = !empty($conditions->fields) ? $conditions->fields : array();

if($conditions->conditionType == 'sql') $conditions->conditions = new stdclass();
if(!empty($conditions->sql)) $conditions->conditions->sql       = $conditions->sql;
if(!empty($conditions->sql)) $conditions->conditions->sqlResult = $conditions->sqlResult;

$formFields = defineFieldList('workflowcondition');
$formFields->field('workflowCondition')->control(array('control' => 'workflowcondition', 'fields' => $fields, 'module' => $action->module, 'hasVarName' => false, 'data' => $conditions))->width('full');

formPanel
(
    to::titleSuffix(span(setClass('text-warning text-sm font-normal'), $lang->workflowcondition->tips)),
    set::title($title),
    set::layout('grid'),
    set::fields($formFields)
);
