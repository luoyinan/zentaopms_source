<?php
/**
 * The todo view file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun
 * @package     company
 * @link        https://www.zentao.net
 */
namespace zin;

$deptPairs = $mainDepts ?: array(0 => '/');
$deptValue = $dept ?? $parent;
$parentTip = $deptValue === 'all' ? '/' . $lang->company->allDept : zget($deptPairs, $parent, $lang->company->noDept);

sidebar
(
    setClass('bg-white p-4'),
    set::width('300'),
    h4($lang->company->searchParams),
    formbase
    (
        set::target(''),
        set::method('post'),
        set::layout('grid'),
        set::actions(array('submit')),
        set::submitBtnText($lang->company->effort->view),
        formGroup
        (
            set::label($lang->company->dept),
            picker
            (
                set::name('dept'),
                set::required(true),
                set::items($deptPairs),
                set::value($deptValue)
            )
        ),
        formGroup
        (
            set::label($lang->company->beginDate),
            datePicker
            (
                set::name('begin'),
                set::value($begin),
            )
        ),
        formGroup
        (
            set::label($lang->company->endDate),
            datePicker
            (
                set::name('end'),
                set::value($end),
            )
        )
    )
);

$headerHtml = '<tr>';
$headerHtml .= '<th class="company-todo-sticky company-todo-col-dept">' . $lang->company->dept . '</th>';
$headerHtml .= '<th class="company-todo-sticky company-todo-col-user">' . $lang->company->user . '</th>';
foreach($days as $day) $headerHtml .= '<th class="company-todo-col-date">' . $day . '</th>';
$headerHtml .= '</tr>';

$bodyHtml  = '';
$userCount = 0;
$renderRow = static function($deptID, string $account, array $userData) use (&$userCount, $days, $allDepts, $parentTip, $users): string
{
    $userCount++;
    $deptName  = (string)zget($allDepts, $deptID, $parentTip);
    $userLabel = (string)zget($users, $account, $account);

    $rowHtml  = '<tr class="company-todo-row">';
    $rowHtml .= '<th class="company-todo-sticky company-todo-col-dept company-todo-row-head"><div class="company-todo-dept">' . $deptName . '</div></th>';
    $rowHtml .= '<th class="company-todo-sticky company-todo-col-user company-todo-row-head"><div class="company-todo-user">' . $userLabel . '</div></th>';

    foreach($days as $day)
    {
        $todos = $userData[$day] ?? array();
        if(empty($todos))
        {
            $rowHtml .= '<td class="company-todo-day-cell is-empty"></td>';
            continue;
        }

        $todoListHtml = '<ul class="company-todo-list">';
        foreach($todos as $todo)
        {
            $time  = empty($todo['begin']) ? '' : "{$todo['begin']}~{$todo['end']}";
            $title = trim($time . ' ' . $todo['todo']);

            $todoListHtml .= '<li class="company-todo-item" title="' . $title . '">';
            $todoListHtml .= '<span class="company-todo-time' . ($time === '' ? ' is-empty' : '') . '">' . ($time === '' ? '&nbsp;' : $time) . '</span>';
            $todoListHtml .= '<span class="company-todo-text">' . (string)$todo['todo'] . '</span>';
            $todoListHtml .= '</li>';
        }
        $todoListHtml .= '</ul>';

        $rowHtml .= '<td class="company-todo-day-cell">' . $todoListHtml . '</td>';
    }

    $rowHtml .= '</tr>';

    return $rowHtml;
};

foreach($datas as $deptID => $deptData)
{
    $filledUsers = array_filter($deptData);
    $emptyUsers  = array_diff_key($deptData, $filledUsers);

    foreach($filledUsers as $account => $userData)
    {
        $bodyHtml .= $renderRow($deptID, (string)$account, $userData);
    }

    foreach($emptyUsers as $account => $userData)
    {
        $bodyHtml .= $renderRow($deptID, (string)$account, $userData);
    }
}

if($bodyHtml === '')
{
    div
    (
        setClass('shadow rounded ring canvas company-todo-wrapper'),
        div
        (
            setClass('dtable-empty-tip company-todo-empty'),
            span(setClass('text-gray'), $lang->noData)
        )
    );
}
else
{
    div
    (
        setClass('shadow rounded ring canvas company-todo-wrapper'),
        div
        (
            setClass('company-todo-scroll'),
            html('<table class="table bordered company-todo-table"><thead>' . $headerHtml . '</thead><tbody>' . $bodyHtml . '</tbody></table>')
        ),
        div
        (
            setClass('company-todo-footer flex justify-between'),
            span(sprintf($lang->company->pageUserCount, $userCount)),
            $pager ? pager() : null
        ),
    );
}
