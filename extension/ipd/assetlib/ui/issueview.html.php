<?php
/**
 * The issueview file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$canIssueView = common::hasPriv('issue', 'view') && helper::hasFeature('issue');
$sourceIssue  = '';
if(!empty($issue->from))
{
    $sourceLink  = createLink('issue', 'view', "issueID={$issue->from}");
    $sourceIssue = $canIssueView ? a(set::href($sourceLink), $issue->sourceName) : $issue->sourceName;
}

$statusLabel = span
(
    setClass('status-issue status-' . $issue->status),
    span(setClass('label label-dot')),
    ' ',
    zget($lang->assetlib->statusList, $issue->status)
);

$basicInfo = array
(
    item(set::name($lang->assetlib->sourceIssue), $sourceIssue),
    item(set::name($lang->issue->type), zget($lang->issue->typeList, $issue->type)),
    item(set::name($lang->issue->severity), zget($lang->issue->severityList, $issue->severity)),
    item
    (
        set::name($lang->issue->pri),
        span
        (
            setClass('label-pri label-pri-' . $issue->pri),
            set::title(zget($lang->issue->priList, $issue->pri)),
            zget($lang->issue->priList, $issue->pri)
        )
    ),
    item(set::name($lang->assetlib->status), $statusLabel),
    item(set::name($lang->assetlib->importedBy), zget($users, $issue->createdBy)),
    item(set::name($lang->assetlib->importedDate), helper::isZeroDate($issue->createdDate) ? '' : $issue->createdDate),
    $issue->status == 'active' ? item(set::name($lang->assetlib->approvedBy), zget($users, $issue->assignedTo)) : null,
    $issue->status == 'active' ? item(set::name($lang->assetlib->approvedDate), helper::isZeroDate($issue->approvedDate) ? '' : $issue->approvedDate) : null,
    item(set::name($lang->issue->editedBy), zget($users, $issue->editedBy)),
    item(set::name($lang->issue->editedDate), helper::isZeroDate($issue->editedDate) ? '' : $issue->editedDate)
);

$sections = array();
$sections[] = setting()
    ->title($lang->issue->desc)
    ->control('html')
    ->content(empty($issue->desc) ? "<div class='text-center text-muted'>{$lang->noData}</div>" : $issue->desc);
if(!empty($issue->files))
{
    $sections[] = array
    (
        'control'    => 'fileList',
        'files'      => $issue->files,
        'padding'    => false,
        'showDelete' => false,
        'object'     => $issue
    );
}

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->issue->basicInfo)
    ->children(wg(tableData(array_filter($basicInfo))));

$actions = array();
if(!$issue->deleted && hasPriv('assetlib', 'editIssue', $issue))
{
    $actions[] = array
    (
        'icon' => 'edit',
        'text' => $lang->edit,
        'hint' => $lang->edit,
        'url'  => createLink('assetlib', 'editIssue', "issueID={$issue->id}")
    );
}
if(!$issue->deleted && $issue->status == 'draft' && hasPriv('assetlib', 'approveIssue', $issue))
{
    $actions[] = array
    (
        'icon'        => 'glasses',
        'text'        => $lang->assetlib->approveIssue,
        'hint'        => $lang->assetlib->approveIssue,
        'url'         => createLink('assetlib', 'approveIssue', "issueID={$issue->id}"),
        'data-toggle' => 'modal'
    );
}
if(!$issue->deleted && hasPriv('assetlib', 'removeIssue', $issue))
{
    $actions[] = array
    (
        'icon' => 'unlink',
        'text' => $lang->assetlib->removeIssue,
        'hint' => $lang->assetlib->removeIssue,
        'url'  => createLink('assetlib', 'removeIssue', "issueID={$issue->id}"),
        'className' => 'ajax-submit',
        'data-confirm' => $lang->assetlib->confirmDeleteIssue
    );
}

detail
(
    set::urlFormatter(array('{id}' => $issue->id)),
    set::backBtn(array('url' => $browseLink)),
    set::objectType('issue'),
    set::objectID($issue->id),
    set::object($issue),
    set::deleted($issue->deleted),
    set::title($issue->title),
    set::sections($sections),
    set::tabs($tabs),
    set::actions($actions)
);
