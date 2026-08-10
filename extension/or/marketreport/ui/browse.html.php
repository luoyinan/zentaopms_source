<?php
/**
 * The browse file of marketreport module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang
 * @package     marketreport
 * @link        https://www.zentao.net
 */
namespace zin;

$marketParam  = $this->app->rawMethod == 'all' ? '' : "marketID=$marketID&";
$martetMethod = ($this->app->rawModule == 'marketresearch' && $this->app->rawMethod == 'reports') ? 'browse' : $this->app->rawMethod;
$featureBar   = [];
foreach($lang->marketreport->featureBar['browse'] as $featureType => $label) $featureBar[] = array('text' => $label, 'value' => $featureType, 'url' => inlink($martetMethod, $marketParam . "browseType={$featureType}&orderBy=$orderBy"), 'active' => $browseType == $featureType);
featureBar
(
    set::items($featureBar),
    set::current($browseType),
    checkbox
    (
        setID('involvedReport'),
        on::change()->call('changeInvolvedReport', jsRaw('event')),
        set::name('involvedReport'),
        set::checked($this->cookie->involvedReport),
        set::text($lang->project->mine)
    )
);

$canCreate  = common::hasPriv('marketreport', 'create');
$createLink = createLink('marketreport', 'create', "marketID=$marketID");
toolbar
(
    $canCreate ? btn(setClass('btn primary'), set::icon('plus'), set::url($createLink), $lang->marketreport->create) : null
);

$cols    = $this->loadModel('datatable')->getSetting('marketreport');
$reports = initTableData($reports, $cols, $this->marketreport);
foreach($reports as $report) $report->fromMarket = $marketID;

dtable
(
    set::cols($cols),
    set::data($reports),
    set::userMap($users),
    set::customCols(false),
    set::sortLink(createLink('marketreport', $martetMethod, $marketParam . "browseType=$browseType&orderBy={name}_{sortType}&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage&pageID=$pager->pageID")),
    set::footPager(usePager())
);

