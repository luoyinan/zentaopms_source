<?php
/**
 * The risk view file of assetlib module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

foreach($libs as $id => $name) $libItems[] = array('text' => $name, 'url' => inlink('risk', "libID={$id}"), 'active' => $libID == $id);
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
    set::link(inlink('risk', "libID={$libID}&browseType={key}")),
    set::current($browseType),
    li(searchToggle(set::open($browseType == 'bysearch'), set::module('riskLib')))
);

$importItem = array('text' => $lang->assetlib->importRisk, 'data-size' => 'sm','url' => inlink('importRisk', "libID=$libID"));
toolbar
(
    hasPriv('assetlib', 'riskLibView') ? item(set(array('id' => 'riskLibView', 'text' => $lang->assetlib->libView, 'icon' => 'list-alt', 'class' => 'ghost', 'url' => inlink('riskLibView', "libID=$libID")))) : null,
    common::hasPriv('assetlib', 'importRisk') ? dropdown
    (
        btn
        (
            setID('importBtn'),
            setClass('btn ghost square dropdown-toggle'),
            set::icon('import'),
        ),
        set::items(array($importItem)),
        set::placement('bottom-end')
    ): null
);

$canBatchAssignTo = common::hasPriv('assetlib', 'batchAssignToRisk');
$canBatchApprove  = common::hasPriv('assetlib', 'batchApproveRisk');
$canBatchRemove   = common::hasPriv('assetlib', 'batchRemoveRisk');
$canBatchAction   = ($browseType == 'all' or $browseType == 'bysearch') ? ($canBatchApprove or $canBatchRemove) : ($canBatchAssignTo or $canBatchApprove or $canBatchRemove);

$footToolbar = array();
if($canBatchAction)
{
    if($canBatchAssignTo && $browseType == 'draft')
    {
        $assignedToItems = array();
        foreach($approvers as $account => $name)
        {
            $assignedToItems[] = array('text' => $name, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', 'batchAssignToRisk', "libID={$libID}&assignedTo={$account}"));
        }

        $footToolbar['items'][] = array('text' => $lang->assetlib->assignedTo, 'class' => 'btn btn-caret size-sm', 'btnType' => 'secondary', 'items' => $assignedToItems,'type' => 'dropdown');
    }

    if($canBatchApprove)
    {
        $approveItems = array();
        foreach($lang->assetlib->resultList as $key => $value)
        {
            $approveItems[] = array('text' => $value, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', 'batchApproveRisk', "libID={$libID}&result={$key}"));
        }

        $footToolbar['items'][] = array('text' => $lang->assetlib->approve, 'class' => 'batch-btn', 'btnType' => 'secondary', 'items' => $approveItems, 'data-url' => createLink('assetlib', 'batchApproveRisk', "libID={$libID}"));
    }

    if($canBatchRemove)
    {
        $footToolbar['items'][] = array('text' => $lang->assetlib->removeRisk, 'class' => 'batch-btn', 'btnType' => 'secondary', 'data-formaction' => createLink('assetlib', 'batchRemoveRisk'));
    }
}

$cols = array();
foreach($config->assetlib->dtable->risk->fieldList as $fieldKey => $field)
{
    if($browseType == 'draft' && in_array($fieldKey, array('assignedTo', 'approvedDate'))) continue;
    if($browseType == 'draft' && $fieldKey == 'createdBy')
    {
        $cols['assignedTo'] = $config->assetlib->dtable->risk->fieldList['assignedTo'];
        $cols['assignedTo']['title']      = $lang->assetlib->assignedTo;
        $cols['assignedTo']['type']       = 'assign';
        $cols['assignedTo']['assignLink'] = array('module' => 'assetlib', 'method' => 'assignToRisk', 'params' => 'riskID={id}');
    }
    $cols[$fieldKey] = $field;
}

$risks = initTableData($risks, $cols);
dtable
(
    set::id('table-risk-list'),
    set::cols($cols),
    set::data($risks),
    set::userMap($users),
    set::fixedLeftWidth('44%'),
    set::checkable($canBatchAction ? true : false),
    set::orderBy($orderBy),
    set::sortLink(inlink('risk', "libkID={$libID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager())
);
