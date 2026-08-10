<?php
/**
 * The browse file of risk module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Mengyi Liu
 * @package     risk
 * @link        https://www.zentao.net
 */
namespace zin;

$linkParams = "param=0&orderBy=$orderBy&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
$featureBar = [];
foreach($lang->demandpool->labelList as $featureType => $label) $featureBar[] = array('text' => $label, 'value' => $featureType, 'url' => inlink('browse', "brorseType={$featureType}&{$linkParams}"), 'active' => $browseType == $featureType);
featureBar
(
    set::items($featureBar),
    set::current($browseType),
    li(searchToggle(set::module('demandpool'), set::open($browseType == 'bysearch')))
);

$canCreate  = common::hasPriv('demandpool', 'create');
$createLink = createLink('demandpool', 'create');
toolbar
(
    $canCreate ? btn(setClass('btn primary'), set::icon('plus'), set::url($createLink), $lang->demandpool->create) : null
);

foreach($demandpools as $demandpool)
{
    $demandpool->draft       = zget(zget(zget($demandpool, 'summary', array()), 'draft',       array()), 'count', 0);
    $demandpool->reviewing   = zget(zget(zget($demandpool, 'summary', array()), 'reviewing',   array()), 'count', 0);
    $demandpool->wait        = zget(zget(zget($demandpool, 'summary', array()), 'wait',        array()), 'count', 0);
    $demandpool->willCharter = zget(zget(zget($demandpool, 'summary', array()), 'willCharter', array()), 'count', 0);
    $demandpool->inCharter   = zget(zget(zget($demandpool, 'summary', array()), 'inCharter',   array()), 'count', 0);

    $owner = '';
    if(!empty($demandpool->owner))
    {
        foreach(explode(',', str_replace(' ', '', $demandpool->owner)) as $account) $owner .= ' ' . zget($users, $account);
    }
    $demandpool->owner = trim($owner);
}


$cols = $this->loadModel('datatable')->getSetting('demandpool');
$demandpools = initTableData($demandpools, $cols, $this->demandpool);

dtable
(
    set::cols($cols),
    set::data($demandpools),
    set::userMap($users),
    set::customCols(false),
    set::sortLink(createLink('demandpool', 'browse', "browseType={$browseType}&param=0&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager())
);

