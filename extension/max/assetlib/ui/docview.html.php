<?php
/**
 * The docview file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$editMethod    = $objectType == 'practice' ? 'editPractice' : 'editComponent';
$approveMethod = $objectType == 'practice' ? 'approvePractice' : 'approveComponent';
$removeMethod  = $objectType == 'practice' ? 'removePractice' : 'removeComponent';
$objectName    = $objectType == 'practice' ? 'practice' : 'component';
$confirmDelete = $objectType == 'practice' ? $lang->assetlib->confirmDeletePractice : $lang->assetlib->confirmDeleteComponent;

$content = '';
if($doc->type == 'url')
{
    $url = $doc->content;
    if(!preg_match('/^https?:\/\//', $url)) $url = 'http://' . $url;
    $content = html::a($url, $url, '_blank');
}
elseif($doc->contentType == 'markdown')
{
    $content = '<pre class="bg-canvas p-4 rounded">' . htmlspecialchars($doc->content) . '</pre>';
}
else
{
    $content = $doc->content;
}

$sections = array();
$sections[] = setting()
    ->title($lang->doc->content)
    ->control('html')
    ->content($content);
if(!empty($doc->files))
{
    $sections[] = array
    (
        'control' => 'fileList',
        'files'   => $doc->files,
        'object'  => $doc
    );
}

$sourceDoc = '';
if(!empty($doc->from))
{
    $sourceDoc = html::a(
        createLink('doc', 'view', "docID={$doc->from}&version={$doc->fromVersion}"),
        zget($source, 'title', '')
    );
}

$basicInfo = array
(
    item(set::name($lang->assetlib->sourceDoc), array('content' => html($sourceDoc))),
    item(set::name($lang->assetlib->importedBy), zget($users, $doc->addedBy)),
    item(set::name($lang->assetlib->importedDate), helper::isZeroDate($doc->addedDate) ? '' : $doc->addedDate),
    item(set::name($lang->assetlib->approvedBy), $doc->status == 'active' ? zget($users, $doc->assignedTo) : ''),
    item(set::name($lang->assetlib->approvedDate), helper::isZeroDate($doc->approvedDate) ? '' : $doc->approvedDate),
    item(set::name($lang->doc->editedBy), zget($users, $doc->editedBy)),
    item(set::name($lang->doc->editedDate), helper::isZeroDate($doc->editedDate) ? '' : $doc->editedDate)
);

$tabs = array();
$tabs[] = setting()->group('basic')->title($lang->doc->basicInfo)->children(wg(tableData($basicInfo)));
$tabs[] = setting()->group('basic')->title($lang->doc->keywords)->children(empty($doc->keywords) ? $lang->noData : $doc->keywords);
if(!empty($doc->digest)) $tabs[] = setting()->group('basic')->title($lang->doc->digest)->children($doc->digest);

$actions = array();
if(hasPriv('assetlib', $editMethod, $doc))
{
    $actions[] = array
    (
        'icon' => 'edit',
        'text' => $lang->assetlib->edit,
        'hint' => $lang->assetlib->edit,
        'url'  => createLink('assetlib', $editMethod, "docID={$doc->id}")
    );
}
if($doc->status == 'draft' && hasPriv('assetlib', $approveMethod, $doc))
{
    $actions[] = array
    (
        'icon'        => 'glasses',
        'text'        => $lang->assetlib->approve,
        'hint'        => $lang->assetlib->approve,
        'url'         => createLink('assetlib', $approveMethod, "docID={$doc->id}"),
        'data-toggle' => 'modal'
    );
}
if(hasPriv('assetlib', $removeMethod, $doc))
{
    $actions[] = array
    (
        'icon'         => 'unlink',
        'text'         => $lang->assetlib->remove,
        'hint'         => $lang->assetlib->remove,
        'url'          => createLink('assetlib', $removeMethod, "docID={$doc->id}"),
        'className'    => 'ajax-submit',
        'data-confirm' => $confirmDelete
    );
}

detail
(
    set::urlFormatter(array('{id}' => $doc->id)),
    set::backBtn(array('url' => $browseLink)),
    set::objectType('doc'),
    set::objectID($doc->id),
    set::object($doc),
    set::title('#' . ($version ? $version : $doc->version) . ' ' . $doc->title),
    set::sections($sections),
    set::tabs($tabs),
    set::actions($actions)
);
