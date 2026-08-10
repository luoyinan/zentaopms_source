<?php
/**
 * The browse file of workflowcondition module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowcondition
 * @link        https://www.zentao.net
 */
namespace zin;

$actionList = array();
$actionList['edit']   = array('text' => $lang->edit,   'url' => array('module' => 'workflowcondition', 'method' => 'edit',   'params' => 'action={actionID}&key={key}'), 'data-toggle' => 'modal');
$actionList['delete'] = array('text' => $lang->delete, 'url' => array('module' => 'workflowcondition', 'method' => 'delete', 'params' => 'action={actionID}&key={key}'), 'className' => 'ajax-submit', 'data-confirm' => array('message' => $lang->workflowcondition->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x'));

$cols = array();
$cols['condition'] = array('name' => 'condition', 'title' => $lang->workflowcondition->condition, 'type' => 'desc',     'sortType' => false);
$cols['actions']   = array('name' => 'actions',   'title' => $lang->actions,                      'type' => 'actions',  'width' => '120', 'list' => $actionList, 'menu' => array_keys($actionList));

$dataList = array();
foreach($action->conditions as $key => $condition)
{
    $conditionLabel  = '';
    $conditionType = zget($condition, 'conditionType', '');
    if($conditionType == 'sql')
    {
        $conditionLabel = $condition->sql;
    }
    else
    {
        $conditionFields = zget($condition, 'fields', array());
        foreach($conditionFields as $index => $field)
        {
            if($index > 0)
            {
                if(empty($field->logicalOperator)) $field->logicalOperator = 'and';

                $conditionLabel .= ' ' . $lang->workflowcondition->logicalOperatorList[$field->logicalOperator] . ' ';
            }
            $conditionLabel .=  zget($fields, zget($field, 'field'));
            $conditionLabel .=  zget($lang->workflowcondition->operatorList, zget($field, 'operator', ''));

            $fieldParam = zget($field, 'param', '');
            if($fieldParam && strpos($config->workflow->virtualParams, ",$fieldParam,") !== false)
            {
                $conditionLabel .= $lang->workflowcondition->options[$fieldParam];
            }
            else
            {
                $conditionLabel .= $fieldParam;
            }
        }
    }

    $condition->condition = $conditionLabel;
    $condition->key       = $key;
    $condition->actionID  = $action->id;
    $dataList[] = $condition;
}

$dataList = initTableData($dataList, $cols, $this->workflowcondition);

modalHeader
(
    setClass('justify-between'),
    to::suffix
    (
        hasPriv('workflowcondition', 'create') ? a
        (
            set::href(createLink('workflowcondition', 'create', "action=$action->id")),
            setClass('btn primary pull-right'),
            setData(array('toggle' => 'modal')),
            icon('plus'),
            $lang->workflowcondition->create
        ) : null
    )
);

div
(
    dtable
    (
        set::data($dataList),
        set::cols($cols)
    )
);
