<?php
/**
 * The opportunity view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

foreach($libs as $id => $name) $libItems[] = array('text' => $name, 'url' => inlink('opportunity', "libID={$id}"), 'active' => $libID == $id);
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
    set::link(inlink('opportunity', "libID={$libID}&browseType={key}")),
    set::current($browseType),
    li(searchToggle(set::open($browseType == 'bysearch'), set::module('opportunityLib')))
);

$importItem = array('text' => $lang->assetlib->importOpportunity, 'data-size' => 'sm', 'url' => inlink('importOpportunity', "libID=$libID"));
toolbar
(
    hasPriv('assetlib', 'opportunityLibView') ? item(set(array('id' => 'opportunityLibView', 'text' => $lang->assetlib->libView, 'icon' => 'list-alt', 'class' => 'ghost', 'url' => inlink('opportunityLibView', "libID=$libID")))) : null,
    common::hasPriv('assetlib', 'importOpportunity') ? dropdown
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
    ) : null
);

$canBatchAssignTo = common::hasPriv('assetlib', 'batchAssignToOpportunity');
$canBatchApprove  = common::hasPriv('assetlib', 'batchApproveOpportunity');
$canBatchRemove   = common::hasPriv('assetlib', 'batchRemoveOpportunity');
$canBatchAction   = ($browseType == 'all' or $browseType == 'bysearch') ? ($canBatchApprove or $canBatchRemove) : ($canBatchAssignTo or $canBatchApprove or $canBatchRemove);

$footToolbar = array();
if($canBatchAction)
{
    if($canBatchAssignTo && $browseType == 'draft')
    {
        $assignedToItems = array();
        foreach($approvers as $account => $name)
        {
            $assignedToItems[] = array('text' => $name, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', 'batchAssignToOpportunity', "libID={$libID}&assignedTo={$account}"));
        }

        $footToolbar['items'][] = array('text' => $lang->assetlib->assignedTo, 'class' => 'btn btn-caret size-sm', 'btnType' => 'secondary', 'items' => $assignedToItems, 'type' => 'dropdown');
    }

    if($canBatchApprove)
    {
        $approveItems = array();
        foreach($lang->assetlib->resultList as $key => $value)
        {
            $approveItems[] = array('text' => $value, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', 'batchApproveOpportunity', "libID={$libID}&result={$key}"));
        }

        $footToolbar['items'][] = array('text' => $lang->assetlib->approve, 'class' => 'batch-btn', 'btnType' => 'secondary', 'items' => $approveItems, 'data-url' => createLink('assetlib', 'batchApproveOpportunity', "libID={$libID}"));
    }

    if($canBatchRemove)
    {
        $footToolbar['items'][] = array('text' => $lang->assetlib->removeOpportunity, 'class' => 'batch-btn', 'btnType' => 'secondary', 'data-formaction' => createLink('assetlib', 'batchRemoveOpportunity'));
    }
}

$cols = array();
foreach($config->assetlib->dtable->opportunity->fieldList as $fieldKey => $field)
{
    if($browseType == 'draft' && in_array($fieldKey, array('assignedTo', 'approvedDate'))) continue;
    if($browseType == 'draft' && $fieldKey == 'createdBy')
    {
        $cols['assignedTo'] = $config->assetlib->dtable->opportunity->fieldList['assignedTo'];
        $cols['assignedTo']['title']      = $lang->assetlib->assignedTo;
        $cols['assignedTo']['type']       = 'assign';
        $cols['assignedTo']['assignLink'] = array('module' => 'assetlib', 'method' => 'assignToOpportunity', 'params' => 'opportunityID={id}');
    }
    $cols[$fieldKey] = $field;
}

$opportunities = initTableData($opportunities, $cols);
dtable
(
    set::id('table-opportunity-list'),
    set::cols($cols),
    set::data($opportunities),
    set::userMap($users),
    set::fixedLeftWidth('44%'),
    set::checkable($canBatchAction ? true : false),
    set::orderBy($orderBy),
    set::sortLink(inlink('opportunity', "libID={$libID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager()),
    set::emptyTip($lang->noData)
);
