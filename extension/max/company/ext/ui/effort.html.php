<?php
/**
 * The effort view file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     company
 * @link        https://www.zentao.net
 */
namespace zin;

$currentDate = $date == 'custom' ? 'all' : $date;
$featureItems = array();
foreach($lang->company->featureBar['calendar'] as $key => $label)
{
    $featureItems[] = array
    (
        'text'   => $label,
        'url'    => $key == 'calendar' ? createLink('company', 'calendar') : createLink('company', 'effort', "date={$key}"),
        'active' => $key == $currentDate
    );
}
featureBar(set::items($featureItems));

if(hasPriv('effort', 'export'))
{
    toolbar
    (
        set::items(array(array
        (
            'className'   => 'ghost export',
            'text'        => $lang->export,
            'icon'        => 'export',
            'url'         => createLink('effort', 'export', 'userID=' . ($user ? $user->id : '') . '&orderBy=date_asc'),
            'data-toggle' => 'modal'
        )))
    );
}

$deptPairs = $mainDepts;
if(empty($deptPairs)) $deptPairs = array(0 => '/');
unset($deptPairs['all']);

sidebar
(
    setClass('bg-white p-4'),
    set::width('300'),
    h4($lang->company->searchParams),
    formbase
    (
        set::target(''),
        set::method('post'),
        set::url(createLink('company', 'effort', "date=custom&orderBy={$orderBy}")),
        set::layout('grid'),
        set::actions(array('submit')),
        set::submitBtnText($lang->company->effort->view),
        formGroup
        (
            set::label($lang->company->userType),
            picker
            (
                setID('userType'),
                set::name('userType'),
                set::items($lang->company->userTypes),
                set::value($userType)
            )
        ),
        formGroup
        (
            set::label($lang->company->dept),
            picker
            (
                setID('dept'),
                set::name('dept'),
                set::items($mainDepts ?: array(0 => '/')),
                set::value($dept),
                on::change('loadDeptUsers')
            )
        ),
        formGroup
        (
            set::label($lang->company->dateRange),
            inputGroup
            (
                datePicker
                (
                    set::name('begin'),
                    set::value($begin),
                ),
                '~',
                datePicker
                (
                    set::name('end'),
                    set::value($end),
                )
            ),
        ),
        formGroup
        (
            set::label($lang->company->product),
            picker
            (
                setID('product'),
                set::name('product'),
                set::items($products),
                set::value($product),
                on::change($config->vision == 'lite' ? 'loadProductExecutions' : 'loadProductProject')
            )
        ),
        $config->vision != 'lite' ? formGroup
        (
            set::label($lang->company->project),
            picker
            (
                set::name('project'),
                set::items($projects),
                set::value($project),
                on::change('loadProductExecutions')
            )
        ) : null,
        formGroup
        (
            set::label($lang->company->execution),
            picker
            (
                set::name('execution'),
                set::items($executions),
                set::value($execution)
            )
        ),
        formGroup
        (
            set::label($lang->company->user),
            picker
            (
                set::name('user'),
                set::items($users),
                set::value($account)
            )
        )
    )
);

$canViewList = array();
foreach(array_unique(array_column($efforts, 'objectType')) as $objectType)
{
    $method = $objectType == 'feedback' && $config->vision != 'lite' ? 'adminView' : 'view';
    $canViewList[$objectType] = common::hasPriv($objectType, $method);
}

$totalConsumed = 0;
foreach($efforts as $effort)
{
    $totalConsumed      += (float)$effort->consumed;
    $effort->product     = trim((string)$effort->product, ',');
    $effort->consumed    = helper::formatHours($effort->consumed);
    $effort->left        = $effort->objectType == 'task' ? helper::formatHours($effort->left) : '';
    $effort->objectTitle = $effort->objectType == 'custom'
        ? ''
        : zget($lang->effort->objectTypeList, $effort->objectType, strtoupper($effort->objectType)) . " #{$effort->objectID} {$effort->objectTitle}";
}

$config->company->effort->dtable->fieldList['dept']['map']      = $deptPairs;
$config->company->effort->dtable->fieldList['account']['map']   = $users;
$config->company->effort->dtable->fieldList['product']['map']   = $products;
$config->company->effort->dtable->fieldList['project']['map']   = $projects;
$config->company->effort->dtable->fieldList['execution']['map'] = $executions;

$summary = sprintf($lang->company->effort->timeStat, round($totalConsumed, 2));

jsVar('summary', $summary);
jsVar('companyEffortCanViewList', $canViewList);
jsVar('companyEffortTypeAppList', $config->effort->typeAppList ?? array());
jsVar('companyEffortVision', $config->vision);

dtable
(
    setID('companyEffortList'),
    set::cols($config->company->effort->dtable->fieldList),
    set::data($efforts),
    set::userMap($users),
    set::orderBy($orderBy),
    set::sortLink(createLink('company', 'effort', "date={$date}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::onRenderCell(jsRaw('window.renderCell')),
    set::footPager(usePager()),
    set::footer(array(array('html' => $summary), 'flex', 'pager'))
);
