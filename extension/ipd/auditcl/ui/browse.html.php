<?php
namespace zin;
if(!$hasAuditcl)
{
    $currentModuleName = $lang->auditcl->qa;
    include('../../common/ext/ui/closefeaturenotice.html.php');
    return;
}

featureBar
(
    set::current('all'),
    set::linkParams("groupID={$groupID}&processID={$processID}&browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}"),
    li(searchToggle(set::module('auditcl'), set::open($browseType == 'bysearch')))
);

$canBatchCreate  = hasPriv('auditcl', 'batchCreate');
$batchCreateLink = $this->createLink('auditcl', 'batchCreate', "groupID=$groupID");
$batchCreateItem = array('text' => $lang->auditcl->batchCreate, 'url' => $batchCreateLink);
toolbar
(
    $canBatchCreate ? item(set($batchCreateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

sidebar
(
    moduleMenu
    (
        set::modules($moduleTree),
        set::activeKey($processID),
        set::allText($lang->auditcl->process),
        set::settingLink(''),
        set::showDisplay(false),
        set::closeLink(createLink('auditcl', 'browse', "groupID={$groupID}&processID=0")),
        set::app($app->tab)
    )
);

$canBatchEdit   = hasPriv('auditcl', 'batchEdit');
$canBatchDelete = hasPriv('auditcl', 'batchDelete');
$footToolbar    = array();
if($canBatchEdit) $footToolbar[] = array
(
    'type' => 'btn-group',
    'items' => array
    (
        array
        (
            'text' => $lang->edit,
            'className' => 'secondary batch-btn',
            'data-page' => 'batch',
            'data-formaction' => createLink('auditcl', 'batchEdit', "groupID=$groupID")
        )
    )
);
if($canBatchDelete) $footToolbar[] = array
(
    'type' => 'btn-group',
    'items' => array
    (
        array
        (
            'text' => $lang->delete,
            'className' => 'secondary batch-btn',
            'data-formaction' => createLink('auditcl', 'batchDelete', "confirm=no")
        )
    )
);

$cols = $config->auditcl->dtable->fieldList;
$data = initTableData($auditclList, $cols);

dtable
(
    set::id('auditcls'),
    set::userMap($users),
    set::cols($cols),
    set::data($data),
    set::sortLink($this->createLink('auditcl', 'browse', "groupID=$groupID&processID=$processID&browseType=$browseType&queryID=myQueryID&orderBy={name}_{sortType}")),
    set::orderBy($orderBy),
    set::checkable($canBatchEdit || $canBatchDelete),
    set::footPager(usePager()),
    set::footToolbar($footToolbar)
);
