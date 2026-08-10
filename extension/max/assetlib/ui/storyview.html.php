<?php
/**
 * The story view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$sourceStory = '';
if(!empty($story->fromStory))
{
    $sourceLink = $this->createLink($story->type, 'view', "storyID={$story->fromStory}&version={$story->fromVersion}");
    $sourceStory = hasPriv($story->type, 'view') ? a(set::href($sourceLink), $story->sourceName) : $story->sourceName;
}

$statusLabel = span
(
    setClass('status-story status-' . $story->status),
    span(setClass('label label-dot')),
    ' ',
    zget($lang->assetlib->statusList, $story->status)
);

$basicInfo = array
(
    item(set::name($lang->assetlib->sourceStory), $sourceStory),
    item(set::name($lang->story->status), $statusLabel),
    item(set::name($lang->story->category), zget($lang->story->categoryList, $story->category, $story->category)),
    item
    (
        set::name($lang->story->pri),
        span
        (
            setClass('label-pri label-pri-' . $story->pri),
            set::title(zget($lang->story->priList, $story->pri)),
            zget($lang->story->priList, $story->pri)
        )
    ),
    item(set::name($lang->story->estimate), $story->estimate . $config->hourUnit),
    item(set::name($lang->story->keywords), $story->keywords)
);

$lifeTime = array
(
    item(set::name($lang->assetlib->importedBy), zget($users, $story->openedBy) . $lang->at . $story->openedDate),
    item
    (
        set::name($lang->assetlib->approvedBy),
        ($story->status == 'active' && !empty($story->assignedTo)) ? zget($users, $story->assignedTo) . $lang->at . $story->approvedDate : ''
    ),
    item
    (
        set::name($lang->story->lastEditedBy),
        !empty($story->lastEditedBy) ? zget($users, $story->lastEditedBy) . $lang->at . $story->lastEditedDate : ''
    )
);

$sections = array();
$sections[] = setting()
    ->title($lang->story->legendSpec)
    ->control('html')
    ->content(empty($story->spec) ? $lang->noDesc : $story->spec);
$sections[] = setting()
    ->title($lang->story->legendVerify)
    ->control('html')
    ->content(empty($story->verify) ? $lang->noDesc : $story->verify);
if(!empty($story->files))
{
    $sections[] = array
    (
        'control'    => 'fileList',
        'files'      => $story->files,
        'padding'    => false,
        'showDelete' => false,
        'object'     => $story
    );
}

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->story->legendBasicInfo)
    ->children(wg(tableData($basicInfo)));
$tabs[] = setting()
    ->group('basic')
    ->title($lang->story->legendLifeTime)
    ->children(wg(tableData($lifeTime)));

$actions = array();
if(hasPriv('assetlib', 'editStory', $story))
{
    $actions[] = array
    (
        'icon' => 'edit',
        'text' => $lang->edit,
        'hint' => $lang->edit,
        'url'  => createLink('assetlib', 'editStory', "storyID={$story->id}")
    );
}
if($story->status == 'draft' && hasPriv('assetlib', 'approveStory', $story))
{
    $actions[] = array
    (
        'icon'        => 'glasses',
        'text'        => $lang->assetlib->approveStory,
        'hint'        => $lang->assetlib->approveStory,
        'url'         => createLink('assetlib', 'approveStory', "storyID={$story->id}"),
        'data-toggle' => 'modal'
    );
}
if(hasPriv('assetlib', 'removeStory', $story))
{
    $actions[] = array
    (
        'icon' => 'unlink',
        'text' => $lang->assetlib->removeStory,
        'hint' => $lang->assetlib->removeStory,
        'url'  => createLink('assetlib', 'removeStory', "storyID={$story->id}"),
        'data-confirm' => $lang->assetlib->confirmDeleteStory,
        'className' => 'ajax-submit'
    );
}

detail
(
    set::urlFormatter(array('{id}' => $story->id)),
    set::backBtn(array('url' => $browseLink)),
    set::objectType('story'),
    set::objectID($story->id),
    set::object($story),
    set::title($story->title),
    set::sections($sections),
    set::tabs($tabs),
    set::actions($actions)
);
