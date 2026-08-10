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
foreach($lang->assetlib->featureBar['caselib'] as $featureType => $label) $featureBar[] = array('text' => $label, 'value' => $featureType, 'url' => inlink('caselib', "browseType=$featureType"), 'active' => $browseType == $featureType);
featureBar
(
    set::items($featureBar),
    set::current($browseType),
);


$cols = $config->assetlib->dtable->browse->fieldList;
$cols['name']['link']['url']['module'] = 'caselib';
$cols['name']['link']['url']['method'] = 'browse';
$cols['addedBy'] = $cols['createdBy'];
unset($cols['actions'], $cols['createdBy']);

$this->loadModel('file');
foreach($libs as $lib) $lib = $this->file->replaceImgURL($lib, 'desc');
$libs = initTableData($libs, $cols, $this->assetlib);

dtable
(
    set::id('libList'),
    set::cols($cols),
    set::data(array_values($libs)),
    set::userMap($users),
    set::checkable(false),
    set::orderBy($orderBy),
    set::footPager(usePager()),
    set::sortLink(inlink($app->rawMethod, "browseType={$browseType}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::emptyTip($lang->noData)
);
