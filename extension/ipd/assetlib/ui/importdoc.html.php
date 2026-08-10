<?php
/**
 * The importdoc view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('libID', $libID);
jsVar('projectID', $projectID);
jsVar('docLibID', $docLibID);
jsVar('orderBy', $orderBy);
jsVar('objectType', ucfirst($objectType));

$method   = $app->rawMethod;
$backLink = $objectType == 'practice' ? $this->session->practiceList : $this->session->componentList;

featureBar
(
    to::leading
    (
        backBtn(set::icon('back'), set::type('secondary'), set::url($backLink), $lang->goback)
    ),
    inputGroup
    (
        setClass('ml-6'),
        $lang->assetlib->selectProject,
        picker
        (
            set::width(260),
            set::name('fromProject'),
            set::items($allProject),
            set::value($projectID),
            set::required(true),
            on::change('[name=fromProject]')->call('changeProject', jsRaw('event'))
        )
    ),
    inputGroup
    (
        setClass('ml-6'),
        $lang->assetlib->selectDocLib,
        picker
        (
            set::width(260),
            set::name('fromDocLib'),
            set::items($docLibs),
            set::value($docLibID),
            set::required(true),
            on::change('[name=fromDocLib]')->call('changeDocLib', jsRaw('event'))
        )
    )
);

$footToolbar = array();
$footToolbar['items'][] = array('text' => $lang->assetlib->import, 'class' => 'btn btn-caret size-sm', 'btnType' => 'secondary', 'data-formaction' => inlink($method, "libID={$libID}&projectID={$projectID}&docLibID={$docLibID}&orderBy={$orderBy}"));

$cols = $config->assetlib->dtable->importDoc->fieldList;
$cols['project']['map'] = $allProject;
$docs = initTableData($docs, $cols);

dtable
(
    set::id('docs'),
    set::cols(array_values($cols)),
    set::data(array_values($docs)),
    set::fixedLeftWidth('44%'),
    set::checkable(true),
    set::orderBy($orderBy),
    set::sortLink(inlink($method, "libID={$libID}&projectID={$projectID}&docLibID={$docLibID}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager()),
    set::emptyTip($lang->noData)
);
