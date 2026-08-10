<?php
/**
 * The browse view file of assetlib module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <wangyidong@chandao.net>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$featureBar = [];
foreach($lang->assetlib->featureBar[$app->rawMethod] as $featureType => $label) $featureBar[] = array('text' => $label, 'value' => $featureType, 'url' => inlink($app->rawMethod), 'active' => true);
featureBar
(
    set::items($featureBar),
    set::current('all'),
);

$hasThisFeature = helper::hasFeature($objectType);
toolbar
(
    hasPriv('assetlib', $createMethod) ? btn
    (
        setClass('primary', $hasThisFeature ? '' : 'disabled'),
        set::hint($hasThisFeature ? '' : zget($lang->assetlib, "{$objectType}NoFeature", '')),
        set::url($this->createLink('assetlib', $createMethod)),
        set::icon('plus'),
        $lang->assetlib->{$createMethod}
    ) : null
);

$cols = $config->assetlib->dtable->browse->fieldList;
$cols['actions']['list']['edit']['url']['method'] = $editMethod;
$cols['name']['link']['url']['method']            = $objectType;

foreach($libs as $lib) $lib->desc = strip_tags($lib->desc);

$libs    = initTableData($libs, $cols, $this->assetlib);
$canSort = $canSort && hasPriv('assetlib', 'libSort');

jsVar('objectType', $objectType);
dtable
(
    set::id('libList'),
    set::cols($cols),
    set::data(array_values($libs)),
    set::userMap($users),
    set::checkable(false),
    set::orderBy($orderBy),
    set::footPager(usePager()),
    set::sortLink(inlink($app->rawMethod, "orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::plugins(array('sortable')),
    set::onSortEnd($canSort ? jsRaw('window.onSortEnd') : null),
    set::emptyTip($lang->noData),
    set::createTip($lang->assetlib->$createMethod),
    set::createLink(hasPriv('assetlib', $createMethod) ? createLink('assetlib', $createMethod) : null)
);
