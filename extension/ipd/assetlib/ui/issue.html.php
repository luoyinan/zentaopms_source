<?php
/**
 * The issue view file of assetlib module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

foreach($libs as $id => $name) $libItems[] = array('text' => $name, 'url' => inlink('issue', "libID={$id}"), 'active' => $libID == $id);
featureBar
(
    to::leading
    (
        dropdown
        (
            btn(zget($libs, $libID), setClass('ghost')),
            set::items($libItems),
            set::trigger('click')
        ),
    ),
    set::link(inlink('issue', "libID={$libID}&browseType={key}")),
    set::current($browseType),
    li(searchToggle(set::open($browseType == 'bysearch'), set::module('issueLib')))
);

$importItem = array('text' => $lang->assetlib->importIssue, 'data-size' => 'sm','url' => inlink('importIssue', "libID=$libID"));
toolbar
(
    hasPriv('assetlib', 'issueLibView') ? item(set(array('id' => 'issueLibView', 'text' => $lang->assetlib->libView, 'icon' => 'list-alt', 'class' => 'ghost', 'url' => inlink('issueLibView', "libID=$libID")))) : null,
    common::hasPriv('assetlib', 'importIssue') ? dropdown
    (
        btn
        (
            setID('importBtn'),
            setClass('btn ghost square dropdown-toggle'),
            set::icon('import', setClass('mr-1')),
            set::text($lang->import)
        ),
        set::items(array($importItem)),
        set::placement('bottom-end')
    ): null
);

$canBatchAssignTo = common::hasPriv('assetlib', 'batchAssignToIssue');
$canBatchApprove  = common::hasPriv('assetlib', 'batchApproveIssue');
$canBatchRemove   = common::hasPriv('assetlib', 'batchRemoveIssue');
$canBatchAction   = ($browseType == 'all' or $browseType == 'bysearch') ? ($canBatchApprove or $canBatchRemove) : ($canBatchAssignTo or $canBatchApprove or $canBatchRemove);

$footToolbar = array();
if($canBatchAction)
{
    if($canBatchAssignTo && $browseType == 'draft')
    {
        $assignedToItems = array();
        foreach($approvers as $account => $name)
        {
            $assignedToItems[] = array('text' => $name, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', 'batchAssignToIssue', "libID={$libID}&assignedTo={$account}"));
        }

        $footToolbar['items'][] = array('text' => $lang->assetlib->assignedTo, 'class' => 'btn btn-caret size-sm', 'btnType' => 'secondary', 'items' => $assignedToItems,'type' => 'dropdown');
    }

    if($canBatchApprove)
    {
        $approveItems = array();
        foreach($lang->assetlib->resultList as $key => $value)
        {
            $approveItems[] = array('text' => $value, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', 'batchApproveIssue', "libID={$libID}&result={$key}"));
        }

        $footToolbar['items'][] = array('text' => $lang->assetlib->approve, 'class' => 'batch-btn', 'btnType' => 'secondary', 'items' => $approveItems, 'data-url' => createLink('assetlib', 'batchApproveIssue', "libID={$libID}"));
    }

    if($canBatchRemove)
    {
        $footToolbar['items'][] = array('text' => $lang->assetlib->removeIssue, 'class' => 'batch-btn', 'btnType' => 'secondary', 'data-formaction' => createLink('assetlib', 'batchRemoveIssue'));
    }
}

$cols = array();
foreach($config->assetlib->dtable->issue->fieldList as $fieldKey => $field)
{
    if($browseType == 'draft' && in_array($fieldKey, array('assignedTo', 'approvedDate'))) continue;
    if($browseType == 'draft' && $fieldKey == 'createdBy')
    {
        $cols['assignedTo'] = $config->assetlib->dtable->issue->fieldList['assignedTo'];
        $cols['assignedTo']['title']      = $lang->assetlib->assignedTo;
        $cols['assignedTo']['type']       = 'assign';
        $cols['assignedTo']['assignLink'] = array('module' => 'assetlib', 'method' => 'assignToIssue', 'params' => 'issueID={id}');
    }
    $cols[$fieldKey] = $field;
}

$issues = initTableData($issues, $cols);
dtable
(
    set::id('table-issue-list'),
    set::cols($cols),
    set::data($issues),
    set::userMap($users),
    set::fixedLeftWidth('44%'),
    set::checkable($canBatchAction ? true : false),
    set::orderBy($orderBy),
    set::sortLink(inlink('issue', "libkID={$libID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager())
);
