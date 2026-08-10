<?php
/**
 * The opportunityview file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$canOpportunityView = common::hasPriv('opportunity', 'view') && helper::hasFeature('opportunity');
$sourceOpportunity  = '';
if(!empty($opportunity->from))
{
    $sourceLink        = createLink('opportunity', 'view', "opportunityID={$opportunity->from}");
    $sourceOpportunity = $canOpportunityView ? a(set::href($sourceLink), $opportunity->sourceName) : $opportunity->sourceName;
}

$statusLabel = span
(
    setClass('status-story status-' . $opportunity->status),
    span(setClass('label label-dot')),
    ' ',
    zget($lang->assetlib->statusList, $opportunity->status)
);

$basicInfo = array
(
    item(set::name($lang->assetlib->sourceOpportunity), $sourceOpportunity),
    item(set::name($lang->opportunity->source), zget($lang->opportunity->sourceList, $opportunity->source)),
    item(set::name($lang->opportunity->type), zget($lang->opportunity->typeList, $opportunity->type, $opportunity->type)),
    item(set::name($lang->opportunity->strategy), zget($lang->opportunity->strategyList, $opportunity->strategy)),
    item(set::name($lang->opportunity->status), $statusLabel),
    item(set::name($lang->opportunity->impact), zget($lang->opportunity->impactList, $opportunity->impact)),
    item(set::name($lang->opportunity->chance), zget($lang->opportunity->chanceList, $opportunity->chance)),
    item(set::name($lang->opportunity->ratio), $opportunity->ratio),
    item
    (
        set::name($lang->opportunity->pri),
        span
        (
            setClass('pri-' . $opportunity->pri),
            set::title(zget($lang->opportunity->priList, $opportunity->pri)),
            zget($lang->opportunity->priList, $opportunity->pri)
        )
    )
);

$lifeTime = array
(
    item(set::name($lang->assetlib->importedBy), zget($users, $opportunity->createdBy)),
    item(set::name($lang->assetlib->importedDate), helper::isZeroDate($opportunity->createdDate) ? '' : $opportunity->createdDate),
    item(set::name($lang->assetlib->approvedBy), $opportunity->status == 'active' ? zget($users, $opportunity->assignedTo) : ''),
    item(set::name($lang->assetlib->approvedDate), helper::isZeroDate($opportunity->approvedDate) ? '' : $opportunity->approvedDate),
    item(set::name($lang->opportunity->editedBy), zget($users, $opportunity->editedBy)),
    item(set::name($lang->opportunity->editedDate), helper::isZeroDate($opportunity->editedDate) ? '' : $opportunity->editedDate)
);

$sections = array();
$sections[] = setting()
    ->title($lang->opportunity->desc)
    ->control('html')
    ->content(empty($opportunity->desc) ? $lang->noDesc : $opportunity->desc);
$sections[] = setting()
    ->title($lang->opportunity->prevention)
    ->control('html')
    ->content(empty($opportunity->prevention) ? $lang->noDesc : $opportunity->prevention);
$sections[] = setting()
    ->title($lang->opportunity->resolution)
    ->control('html')
    ->content(empty($opportunity->resolution) ? $lang->noDesc : $opportunity->resolution);

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->opportunity->legendBasicInfo)
    ->children(wg(tableData($basicInfo)));
$tabs[] = setting()
    ->group('basic')
    ->title($lang->opportunity->legendLifeTime)
    ->children(wg(tableData($lifeTime)));

$actions = array();
if(hasPriv('assetlib', 'editOpportunity', $opportunity))
{
    $actions[] = array
    (
        'icon' => 'edit',
        'text' => $lang->edit,
        'hint' => $lang->edit,
        'url'  => createLink('assetlib', 'editOpportunity', "opportunityID={$opportunity->id}")
    );
}
if($opportunity->status == 'draft' && hasPriv('assetlib', 'approveOpportunity', $opportunity))
{
    $actions[] = array
    (
        'icon'        => 'glasses',
        'text'        => $lang->assetlib->approveOpportunity,
        'hint'        => $lang->assetlib->approveOpportunity,
        'url'         => createLink('assetlib', 'approveOpportunity', "opportunityID={$opportunity->id}"),
        'data-toggle' => 'modal'
    );
}
if(hasPriv('assetlib', 'removeOpportunity', $opportunity))
{
    $actions[] = array
    (
        'icon' => 'unlink',
        'text' => $lang->assetlib->removeOpportunity,
        'hint' => $lang->assetlib->removeOpportunity,
        'url'  => createLink('assetlib', 'removeOpportunity', "opportunityID={$opportunity->id}"),
        'className' => 'ajax-submit',
        'data-confirm' => $lang->assetlib->confirmDeleteOpportunity
    );
}

detail
(
    set::urlFormatter(array('{id}' => $opportunity->id)),
    set::backBtn(array('url' => $browseLink)),
    set::objectType('opportunity'),
    set::objectID($opportunity->id),
    set::object($opportunity),
    set::title($opportunity->name),
    set::sections($sections),
    set::tabs($tabs),
    set::actions($actions)
);
