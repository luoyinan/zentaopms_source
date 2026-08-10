<?php
/**
 * The riskview file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$canRiskView = common::hasPriv('risk', 'view') && helper::hasFeature('risk');
$sourceRisk  = '';
if(!empty($risk->from))
{
    $sourceLink = createLink('risk', 'view', "riskID={$risk->from}");
    $sourceRisk = $canRiskView ? a(set::href($sourceLink), $risk->sourceName) : $risk->sourceName;
}

$statusLabel = span
(
    setClass('status-story status-' . $risk->status),
    span(setClass('label label-dot')),
    ' ',
    zget($lang->assetlib->statusList, $risk->status)
);

$basicInfo = array
(
    item(set::name($lang->assetlib->sourceRisk), $sourceRisk),
    item(set::name($lang->risk->source), zget($lang->risk->sourceList, $risk->source)),
    item(set::name($lang->risk->category), zget($lang->risk->categoryList, $risk->category, $risk->category)),
    item(set::name($lang->risk->strategy), zget($lang->risk->strategyList, $risk->strategy)),
    item(set::name($lang->risk->status), $statusLabel),
    item(set::name($lang->risk->impact), zget($lang->risk->impactList, $risk->impact)),
    item(set::name($lang->risk->probability), zget($lang->risk->probabilityList, $risk->probability)),
    item(set::name($lang->risk->rate), $risk->rate),
    item
    (
        set::name($lang->risk->pri),
        span
        (
            setClass('pri-' . $risk->pri),
            set::title(zget($lang->risk->priList, $risk->pri)),
            zget($lang->risk->priList, $risk->pri)
        )
    )
);

$lifeTime = array
(
    item(set::name($lang->assetlib->importedBy), zget($users, $risk->createdBy)),
    item(set::name($lang->assetlib->importedDate), helper::isZeroDate($risk->createdDate) ? '' : $risk->createdDate),
    item(set::name($lang->assetlib->approvedBy), $risk->status == 'active' ? zget($users, $risk->assignedTo) : ''),
    item(set::name($lang->assetlib->approvedDate), helper::isZeroDate($risk->approvedDate) ? '' : $risk->approvedDate),
    item(set::name($lang->risk->editedBy), zget($users, $risk->editedBy)),
    item(set::name($lang->risk->editedDate), helper::isZeroDate($risk->editedDate) ? '' : $risk->editedDate)
);

$sections = array();
$sections[] = setting()
    ->title($lang->risk->prevention)
    ->control('html')
    ->content(empty($risk->prevention) ? $lang->noDesc : $risk->prevention);
$sections[] = setting()
    ->title($lang->risk->remedy)
    ->control('html')
    ->content(empty($risk->remedy) ? $lang->noDesc : $risk->remedy);
$sections[] = setting()
    ->title($lang->risk->resolution)
    ->control('html')
    ->content(empty($risk->resolution) ? $lang->noDesc : $risk->resolution);

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->risk->legendBasicInfo)
    ->children(wg(tableData($basicInfo)));
$tabs[] = setting()
    ->group('basic')
    ->title($lang->risk->legendLifeTime)
    ->children(wg(tableData($lifeTime)));

$actions = array();
if(hasPriv('assetlib', 'editRisk', $risk))
{
    $actions[] = array
    (
        'icon' => 'edit',
        'text' => $lang->edit,
        'hint' => $lang->edit,
        'url'  => createLink('assetlib', 'editRisk', "riskID={$risk->id}")
    );
}
if($risk->status == 'draft' && hasPriv('assetlib', 'approveRisk', $risk))
{
    $actions[] = array
    (
        'icon'        => 'glasses',
        'text'        => $lang->assetlib->approveRisk,
        'hint'        => $lang->assetlib->approveRisk,
        'url'         => createLink('assetlib', 'approveRisk', "riskID={$risk->id}"),
        'data-toggle' => 'modal'
    );
}
if(hasPriv('assetlib', 'removeRisk', $risk))
{
    $actions[] = array
    (
        'icon' => 'unlink',
        'text' => $lang->assetlib->removeRisk,
        'hint' => $lang->assetlib->removeRisk,
        'url'  => createLink('assetlib', 'removeRisk', "riskID={$risk->id}"),
        'className' => 'ajax-submit',
        'data-confirm' => $lang->assetlib->confirmDeleteRisk
    );
}

detail
(
    set::urlFormatter(array('{id}' => $risk->id)),
    set::backBtn(array('url' => $browseLink)),
    set::objectType('risk'),
    set::objectID($risk->id),
    set::object($risk),
    set::title($risk->name),
    set::sections($sections),
    set::tabs($tabs),
    set::actions($actions)
);
