<?php
/**
 * The browse file of workflowhook module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowhook
 * @link        https://www.zentao.net
 */
namespace zin;

$actionList = array();
$actionList['edit']   = array('text' => $lang->edit,   'url' => array('module' => 'workflowhook', 'method' => 'edit',   'params' => 'action={actionID}&key={key}'), 'data-toggle' => 'modal');
$actionList['delete'] = array('text' => $lang->delete, 'url' => array('module' => 'workflowhook', 'method' => 'delete', 'params' => 'action={actionID}&key={key}'), 'className' => 'ajax-submit', 'data-confirm' => array('message' => $lang->workflowhook->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x'));

$cols = array();
$cols['sql']       = array('name' => 'sql',       'title' => $lang->workflowhook->common,    'type' => 'title',    'sortType' => false);
$cols['condition'] = array('name' => 'condition', 'title' => $lang->workflowhook->condition, 'type' => 'category', 'sortType' => false);
$cols['comment']   = array('name' => 'comment',   'title' => $lang->comment,                 'type' => 'desc',     'sortType' => false);
$cols['actions']   = array('name' => 'actions',   'title' => $lang->actions,                 'type' => 'actions',  'width' => '120', 'list' => $actionList, 'menu' => array_keys($actionList));

$dataList = array();
foreach($action->hooks as $key => $hook)
{
    $conditionLabel  = '';
    $hookConditions = zget($hook, 'conditions', '');
    if(is_object($hookConditions))
    {
        $conditionLabel .= zget($hookConditions, 'sql', '');
    }
    elseif(is_array($hookConditions))
    {
        foreach($hookConditions as $k => $condition)
        {
            if($k > 0) $conditionLabel .= ' ' . $lang->workflowhook->logicalOperatorList[$condition->logicalOperator] . ' ';
            $conditionLabel .= zget($fields, $condition->field);
            $conditionLabel .= zget($config->workflowhook->operatorList, $condition->operator);
            if(strpos($config->workflow->virtualParams, ",$condition->param,") !== false)
            {
                $conditionLabel .= $lang->workflowhook->options[$condition->param];
            }
            else
            {
                $conditionLabel .= $condition->param;
            }
        }
    }
    else
    {
        $conditionLabel .= $hookConditions;
    }
    $hook->condition = $conditionLabel;
    $hook->key       = $key;
    $hook->actionID  = $action->id;
    $dataList[] = $hook;
}

$dataList = initTableData($dataList, $cols, $this->workflowhook);

modalHeader
(
    setClass('justify-between'),
    to::suffix
    (
        hasPriv('workflowhook', 'create') ? a
        (
            set::href(createLink('workflowhook', 'create', "action=$action->id")),
            setClass('btn primary pull-right'),
            setData(array('toggle' => 'modal')),
            icon('plus'),
            $lang->workflowhook->create
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
