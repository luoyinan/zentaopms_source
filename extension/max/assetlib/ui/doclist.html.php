<?php
/**
 * The doclist view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$browseMethod       = $objectType == 'practice' ? 'practice' : 'component';
$libViewMethod      = $objectType == 'practice' ? 'practiceLibView' : 'componentLibView';
$importMethod       = $objectType == 'practice' ? 'importPractice' : 'importComponent';
$batchAssignMethod  = $objectType == 'practice' ? 'batchAssignToPractice' : 'batchAssignToComponent';
$batchApproveMethod = $objectType == 'practice' ? 'batchApprovePractice' : 'batchApproveComponent';
$batchRemoveMethod  = $objectType == 'practice' ? 'batchRemovePractice' : 'batchRemoveComponent';
$viewMethod         = $objectType == 'practice' ? 'practiceView' : 'componentView';
$editMethod         = $objectType == 'practice' ? 'editPractice' : 'editComponent';
$approveMethod      = $objectType == 'practice' ? 'approvePractice' : 'approveComponent';
$removeMethod       = $objectType == 'practice' ? 'removePractice' : 'removeComponent';
$objectIDParam      = $objectType == 'practice' ? 'practiceID' : 'componentID';

foreach($libs as $id => $name) $libItems[] = array('text' => $name, 'url' => inlink($browseMethod, "libID={$id}"), 'active' => $libID == $id);
featureBar
(
    to::leading
    (
        dropdown
        (
            btn(zget($libs, $libID), setClass('ghost')),
            set::items($libItems),
            set::trigger('click')
        )
    ),
    set::link(inlink($browseMethod, "libID={$libID}&browseType={key}")),
    set::current($browseType),
    li(searchToggle(set::open($browseType == 'bysearch'), set::module($objectType . 'Lib')))
);

$importItem = array('text' => $lang->assetlib->$importMethod, 'data-size' => 'sm', 'url' => inlink($importMethod, "libID={$libID}"));
toolbar
(
    hasPriv('assetlib', $libViewMethod) ? item(set(array('id' => $libViewMethod, 'text' => $lang->assetlib->libView, 'icon' => 'list-alt', 'class' => 'ghost', 'url' => inlink($libViewMethod, "libID=$libID")))) : null,
    common::hasPriv('assetlib', $importMethod) ? dropdown
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

$canBatchAssignTo = common::hasPriv('assetlib', $batchAssignMethod);
$canBatchApprove  = common::hasPriv('assetlib', $batchApproveMethod);
$canBatchRemove   = common::hasPriv('assetlib', $batchRemoveMethod);
$canBatchAction   = ($browseType == 'all' || $browseType == 'bysearch') ? ($canBatchApprove || $canBatchRemove) : ($canBatchAssignTo || $canBatchApprove || $canBatchRemove);

$footToolbar = array();
if($canBatchAction)
{
    if($canBatchAssignTo && $browseType == 'draft')
    {
        $assignedToItems = array();
        foreach($approvers as $account => $name)
        {
            $assignedToItems[] = array('text' => $name, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', $batchAssignMethod, "libID={$libID}&assignedTo={$account}"));
        }
        $footToolbar['items'][] = array('text' => $lang->assetlib->assignedTo, 'class' => 'btn btn-caret size-sm', 'btnType' => 'secondary', 'items' => $assignedToItems, 'type' => 'dropdown');
    }

    if($canBatchApprove)
    {
        $approveItems = array();
        foreach($lang->assetlib->resultList as $key => $value)
        {
            $approveItems[] = array('text' => $value, 'class' => 'batch-btn', 'data-formaction' => createLink('assetlib', $batchApproveMethod, "libID={$libID}&result={$key}"));
        }
        $footToolbar['items'][] = array('text' => $lang->assetlib->approve, 'class' => 'batch-btn', 'btnType' => 'secondary', 'items' => $approveItems, 'data-url' => createLink('assetlib', $batchApproveMethod, "libID={$libID}"));
    }

    if($canBatchRemove)
    {
        $footToolbar['items'][] = array('text' => $lang->assetlib->remove, 'class' => 'batch-btn', 'btnType' => 'secondary', 'data-formaction' => createLink('assetlib', $batchRemoveMethod));
    }
}

$actionList = array();
$actionList[$editMethod]    = array('icon' => 'edit', 'text' => $lang->assetlib->edit, 'hint' => $lang->assetlib->edit, 'url' => array('module' => 'assetlib', 'method' => $editMethod, 'params' => "{$objectIDParam}={id}"));
$actionList[$approveMethod] = array('icon' => 'glasses', 'text' => $lang->assetlib->approve, 'hint' => $lang->assetlib->approve, 'url' => array('module' => 'assetlib', 'method' => $approveMethod, 'params' => "{$objectIDParam}={id}", 'onlybody' => true), 'data-toggle' => 'modal');
$actionList[$removeMethod]  = array('icon' => 'unlink', 'text' => $lang->assetlib->remove, 'hint' => $lang->assetlib->remove, 'url' => array('module' => 'assetlib', 'method' => $removeMethod, 'params' => "{$objectIDParam}={id}"), 'className' => 'ajax-submit');

$cols = array();
$cols['id']        = array('name' => 'id', 'title' => $lang->idAB, 'type' => 'checkID');
$cols['title']     = array('name' => 'title', 'title' => $lang->assetlib->name, 'type' => 'title', 'link' => array('module' => 'assetlib', 'method' => $viewMethod, 'params' => "{$objectIDParam}={id}"), 'nestedToggle' => true);
$cols['status']    = array('name' => 'status', 'title' => $lang->assetlib->status, 'type' => 'status', 'statusMap' => $lang->assetlib->statusList);
if($browseType == 'draft') $cols['assignedTo'] = array('name' => 'assignedTo', 'title' => $lang->assetlib->assignedTo, 'type' => 'assign', 'assignLink' => array('module' => 'assetlib', 'method' => $objectType == 'practice' ? 'assignToPractice' : 'assignToComponent', 'params' => "{$objectIDParam}={id}"));
$cols['addedBy']   = array('name' => 'addedBy', 'title' => $lang->assetlib->createdBy, 'type' => 'user');
$cols['addedDate'] = array('name' => 'addedDate', 'title' => $lang->assetlib->createdDate, 'type' => 'date');
if($browseType == 'all' || $browseType == 'bysearch')
{
    $cols['approvedBy']   = array('name' => 'assignedTo', 'title' => $lang->assetlib->approved, 'type' => 'user');
    $cols['approvedDate'] = array('name' => 'approvedDate', 'title' => $lang->assetlib->approvedDate, 'type' => 'date');
}
$cols['actions'] = array('name' => 'actions', 'title' => $lang->actions, 'type' => 'actions', 'list' => $actionList, 'menu' => array($editMethod, $approveMethod, $removeMethod));

$objects = initTableData($objects, $cols, $this->assetlib);
dtable
(
    set::id('table-doc-list'),
    set::cols($cols),
    set::data($objects),
    set::userMap($users),
    set::fixedLeftWidth('44%'),
    set::checkable($canBatchAction ? true : false),
    set::orderBy($orderBy),
    set::sortLink(inlink($browseMethod, "libID={$libID}&browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager()),
    set::emptyTip($lang->noData)
);
