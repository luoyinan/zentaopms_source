<?php
/**
 * The importissue view file of assetlib module of ZenTaoPMS.
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
jsVar('browseType', $browseType);
jsVar('queryID', $queryID);
jsVar('orderBy', $orderBy);

featureBar
(
    to::leading
    (
        backBtn(set::icon('back'), set::type('secondary'), set::url($this->session->issueList), $lang->goback)
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
    )
);

searchForm
(
    set::module('assetIssue'),
    set::simple(true),
    set::show(true)
);

$footToolbar = array();
$footToolbar['items'][] = array('text' => $lang->assetlib->import, 'class' => 'btn btn-caret size-sm', 'btnType' => 'secondary', 'data-formaction' => inlink('importIssue', "libID={$libID}&projectID={$projectID}&orderBy={$orderBy}&browseType={$browseType}&queryID={$queryID}"));

$cols = $config->assetlib->dtable->importIssue->fieldList;
$cols['project']['map'] = $allProject;
$issues = initTableData($issues, $cols);

dtable
(
    set::id('issues'),
    set::cols(array_values($cols)),
    set::data(array_values($issues)),
    set::fixedLeftWidth('44%'),
    set::checkable(true),
    set::orderBy($orderBy),
    set::sortLink(inlink('importIssue', "libID={$libID}&projectID={$projectID}&orderBy={name}_{sortType}&browseType={$browseType}&queryID={$queryID}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager()),
    set::emptyTip($lang->noData)
);
