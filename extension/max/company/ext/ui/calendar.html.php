<?php
/**
 * The calendar file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangmin Sun <sunguangmin@chandao.com>
 * @package     company
 * @version     $Id: calendar.html.php 2026-05-14 05:34:36Z sunguangmin@chandao.com $
 * @link        https://www.zentao.net
 */
namespace zin;

$items = [];
foreach($lang->company->featureBar['calendar'] as $key => $value)
{
    $active = $key == 'calendar' ? 'active' : '';
    $items[] = li
    (
        setClass('nav-item item'),
        a
        (
            $value,
            set::href($key == 'calendar' ? createLink('company', 'calendar') : createLink('company', 'effort', "type={$key}")),
            setClass('nav-item ' . $active)
        )
    );
}

unset($lang->company->featureBar['calendar']);
featureBar($items);

if(hasPriv('effort', 'export'))
{
    toolbar
    (
        set::items
        (
            array
            (
                array
                (
                    'className'   => 'ghost export',
                    'text'        => $lang->export,
                    'icon'        => 'export',
                    'url'         => createLink('effort', 'export', "userID=0&orderBy=date_asc"),
                    'data-toggle' => 'modal'
                )
            )
        )
    );
}

sidebar
(
    setClass('bg-white p-4'),
    set::width('300'),
    h4($lang->company->searchParams),
    formbase
    (
        set::target(''),
        set::layout('grid'),
        set::actions(array('submit')),
        set::submitBtnText($lang->company->effort->view),
        formGroup
        (
            set::label($lang->company->userType),
            picker
            (
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
                set::name('dept'),
                set::items($depts),
                set::value($dept),
                set::required(true),
                on::change('loadDeptUsers')
            )
        ),
        formGroup
        (
            set::label($lang->company->user),
            picker
            (
                set::name('account'),
                set::items($users),
                set::value($account)
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
                set::name('product'),
                set::items($products),
                set::value($product),
                $config->vision == 'lite' ? on::change('loadProductExecutions') : on::change('loadProductProject')
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
                set::value($execution),
            )
        ),
        formGroup
        (
            set::label($lang->company->show),
            picker
            (
                set::name('showUser'),
                set::items($lang->company->showUsers),
                set::required(true),
                set::value($showUser),
            )
        )
    )
);

$headerHtml = '<tr>';
$headerHtml .= '<th class="company-calendar-sticky company-calendar-col-dept">' . $lang->company->dept . '</th>';
$headerHtml .= '<th class="company-calendar-sticky company-calendar-col-user">' . $lang->company->user . '</th>';
foreach($days as $day) $headerHtml .= '<th class="company-calendar-col-date">' . $day . '</th>';
$headerHtml .= '</tr>';

$bodyHtml = '';
$canView  = common::hasPriv('effort', 'view');

foreach($datas as $deptID => $deptData)
{
    foreach($deptData as $account => $userData)
    {
        $deptName   = zget($allDepts, $deptID, (string)$deptID);
        $accountTag = zget($allUsers, $account, $account);
        $bodyHtml  .= '<tr class="company-calendar-row">';
        $bodyHtml  .= '<th class="company-calendar-sticky company-calendar-col-dept company-calendar-row-head"><div class="company-calendar-dept">' . $deptName . '</div></th>';
        $bodyHtml  .= '<th class="company-calendar-sticky company-calendar-col-user company-calendar-row-head"><div class="company-calendar-user">' . $accountTag . '</div></th>';

        foreach($days as $day)
        {
            $works = $userData[$day] ?? array();
            if(empty($works))
            {
                $bodyHtml .= '<td class="company-calendar-day-cell is-empty"></td>';
                continue;
            }

            $workListHtml = '<ol class="company-calendar-work-list">';
            foreach($works as $work)
            {
                $consumed  = helper::formatHours($work['consumed']);
                $title     = "{$work['work']} ({$consumed}h)";
                $href      = createLink('effort', 'view', "id={$work['id']}");
                $content   = $canView
                    ? '<a href="' . $href . '" data-toggle="modal" class="company-calendar-work-link">' . $title . '</a>'
                    : '<span class="company-calendar-work-text">' . $title . '</span>';

                $workListHtml .= '<li title="' . $title . '">' . $content . '</li>';
            }
            $workListHtml .= '</ol>';

            $bodyHtml .= '<td class="company-calendar-day-cell">' . $workListHtml . '</td>';
        }
        $bodyHtml .= '</tr>';
    }
}

if($bodyHtml === '')
{
    div
    (
        setClass('shadow rounded ring canvas company-calendar-wrapper'),
        div
        (
            setClass('dtable-empty-tip company-calendar-empty'),
            span(setClass('text-gray'), $lang->noData)
        )
    );
}
else
{
    div
    (
        setClass('shadow rounded ring canvas company-calendar-wrapper'),
        div
        (
            setClass('company-calendar-scroll'),
            html('<table class="table bordered company-calendar-table"><thead>' . $headerHtml . '</thead><tbody>' . $bodyHtml . '</tbody></table>')
        )
    );
}
