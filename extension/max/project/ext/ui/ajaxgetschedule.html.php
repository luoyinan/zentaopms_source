<?php
/**
 * The ajaxgetschedule view file of project module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     project
 * @link        https://www.zentao.net
 */
namespace zin;

if($projectID)
{
    $lang->project->schedule    = str_replace($lang->projectCommon, ucfirst($lang->execution->common), $lang->project->schedule);
    $lang->project->workingDays = str_replace($lang->projectCommon, $lang->execution->common, $lang->project->workingDays);
    $lang->project->setWorking  = str_replace($lang->projectCommon, $lang->execution->common, $lang->project->setWorking);
}

$workDaysList = $this->project->getWorkingDays($begin, $end);
$calendar     = '';
$years        = array();
$months       = array();
$weeks        = $lang->project->weeks;
$outSideDays  = array();
$workingDays  = array();
for($startMonth = date('Y-m', strtotime($begin)); $startMonth <= date('Y-m', strtotime($end)); $startMonth = date('Y-m', strtotime('+1 month', strtotime($startMonth))))
{
    $year  = date('Y', strtotime($startMonth));
    $month = date('m', strtotime($startMonth));
    $days  = date('t', strtotime($startMonth));

    $years[$year] = array('text' => $year,  'className' => 'years', 'data-on' => 'click', 'data-call' => 'queryYear', 'data-params' => 'event', 'data-year' => $year ,'active' => date('Y', strtotime($begin)) == $year);
    $months[]     = array('text' => $month, 'className' => date('Y', strtotime($begin)) == $year ? 'months' : 'months hidden', 'data-on' => 'click', 'data-call' => 'queryMonth', 'data-params' => 'event', 'data-date' => $startMonth, 'active' => date('Y', strtotime($begin)) == $year && date('m', strtotime($begin)) == $month);

    $header = '';
    $body   = '';
    $td     = '';
    $index  = 0;
    foreach($weeks as $week => $label)
    {
        $header .= "<th>{$label}</th>";

        $firstWeek = $app->clientLang == 'zh-cn' || $app->clientLang == 'zh-tw' ? 'monday this week' : 'sunday this week';
        $correct   = $app->clientLang == 'zh-cn' || $app->clientLang == 'zh-tw' ? '+0 day' : '-6 day';
        $date      = date('Y-m-d', strtotime("+{$index} day", strtotime($firstWeek, strtotime($correct, strtotime("$year-$month-1")))));
        if($date < "$year-$month-01")
        {
            $active   = '';
            $disabled = $date < $begin ? 'disabled' : '';
            if(!$disabled)
            {
                if(!empty($schedule['begin']) && !empty($schedule['end']) && $date >= $schedule['begin'] && $date <= $schedule['end'])
                {
                    if(isset($schedule['calendar'][$date])) $active = 'active';
                }
                else if(!empty($projectSchedule['begin']) && !empty($projectSchedule['end']) && $date >= $projectSchedule['begin'] && $date <= $projectSchedule['end'])
                {
                    if(isset($projectSchedule['calendar'][$date])) $active = 'active';
                }
                else if(isset($workDaysList[$date]))
                {
                    $active = 'active';
                }
            }

            if($active)                $workingDays[$date] = $date;
            if(!$active && !$disabled) $outSideDays[$date] = $date;

            $dateLabel = date('j', strtotime($date));
            $td .= "<td class='other bg-gray-100 cursor-pointer {$disabled} {$active}' data-on='click' data-call='clickDate' data-params='event' data-date='{$date}' data-week='{$week}'><span class='px-3 py-2 text-gray-400'>{$dateLabel}</span></td>";
        }
        $index ++;
    }

    for($i = 1; $i <= $days; $i ++)
    {
        $date     = date('Y-m-d', strtotime("$year-$month-$i"));
        $active   = '';
        $disabled = $date < $begin || $date > $end ? 'disabled' : '';
        if(!$disabled)
        {
            if(!empty($schedule['begin']) && !empty($schedule['end']) && $date >= $schedule['begin'] && $date <= $schedule['end'])
            {
                if(isset($schedule['calendar'][$date])) $active = 'active';
            }
            else if(!empty($projectSchedule['begin']) && !empty($projectSchedule['end']) && $date >= $projectSchedule['begin'] && $date <= $projectSchedule['end'])
            {
                if(isset($projectSchedule['calendar'][$date])) $active = 'active';
            }
            else if(isset($workDaysList[$date]))
            {
                $active = 'active';
            }
        }

        if($active)                $workingDays[$date] = $date;
        if(!$active && !$disabled) $outSideDays[$date] = $date;
        $currentClass = date('Y-m-d') == $date ? 'bg-primary-200 circle text-primary' : '';
        $week         = date('w', strtotime("$year-$month-$i"));
        $td .= "<td class='main cursor-pointer {$disabled} {$active}' data-on='click' data-call='clickDate' data-params='event' data-date='{$date}' data-week='{$week}'><span class='px-3 py-2 $currentClass'>{$i}</span></td>";

        $lastDay = $app->clientLang == 'zh-cn' || $app->clientLang == 'zh-tw' ? '0': '6';
        if($week == $lastDay)
        {
            $body .= "<tr>{$td}</tr>";
            $td = '';
        }
    }

    $index = 0;
    foreach($weeks as $week => $label)
    {
        $firstWeek = $app->clientLang == 'zh-cn' || $app->clientLang == 'zh-tw' ? 'monday this week' : 'sunday this week';
        $correct   = $app->clientLang == 'zh-cn' || $app->clientLang == 'zh-tw' ? '+0 day' : '-6 day';
        $date      = date('Y-m-d', strtotime("+{$index} day", strtotime($firstWeek, strtotime($correct, strtotime("$year-$month-$days")))));
        if($date > "$year-$month-$days")
        {
            $active   = '';
            $disabled = $date > $end ? 'disabled' : '';
            if(!$disabled)
            {
                if(!empty($schedule['begin']) && !empty($schedule['end']) && $date >= $schedule['begin'] && $date <= $schedule['end'])
                {
                    if(isset($schedule['calendar'][$date])) $active = 'active';
                }
                else if(!empty($projectSchedule['begin']) && !empty($projectSchedule['end']) && $date >= $projectSchedule['begin'] && $date <= $projectSchedule['end'])
                {
                    if(isset($projectSchedule['calendar'][$date])) $active = 'active';
                }
                else if(isset($workDaysList[$date]))
                {
                    $active = 'active';
                }
            }

            if($active)                $workingDays[$date] = $date;
            if(!$active && !$disabled) $outSideDays[$date] = $date;
            $dateLabel = date('j', strtotime($date));
            $td .= "<td class='other bg-gray-100 cursor-pointer {$disabled} {$active}' data-on='click' data-call='clickDate' data-params='event' data-date='{$date}' data-week='{$week}'><span class='px-3 py-2 text-gray-400'>{$dateLabel}</span></td>";
        }
        $index ++;
    }
    if($td) $body .= "<tr>{$td}</tr>";

    $tableClass = date('Y-m', strtotime($begin)) == $startMonth ? 'active' : '';
    $calendar  .= "<table class='table text-center {$tableClass}' data-date='{$startMonth}'><tbody><tr>{$header}</tr>{$body}</tbody></table>";
}

$buildOutSideTable = function() use($outSideDays)
{
    global $lang;

    $outSideTable  = '';
    $outSideTable .= "<div class='border p-2 outside-header'>" . sprintf($lang->project->outSideDays, count($outSideDays)) . "</div>";
    foreach($outSideDays as $date)
    {
        $week      = date('w', strtotime($date));
        $weekLabel = zget($lang->project->fullWeeks, $week);
        $outSideTable .= "<div class='flex cursor-pointer outside' data-on='click' data-call='clickOutSide' data-params='event' data-date='{$date}' data-week='{$week}'><div class='cell setWorking border p-2 flex-1'>{$lang->project->setWorking}</div><div class='cell flex-1 border p-2 label-date'>{$date}</div><div class='cell w-12 center border p-2 label-week'>{$weekLabel}</div></div>";
    }
    return $outSideTable;
};

$weekend  = zget($config->execution, 'weekend', '2');
$restDay  = zget($config->execution, 'restDay', '0');

$workDays = '';
if($weekend == 1 && $restDay == '6') $workDays = '2';
if($weekend == 1 && $restDay == '0') $workDays = '1';
if(isset($schedule['workDays'])) $workDays = $schedule['workDays'];

$minWorkHours = sprintf('%.1f', $config->execution->defaultWorkhours);
$maxWorkHours = sprintf('%.1f', $config->execution->defaultWorkhours + 1);
if(isset($schedule['minWorkHours'])) $minWorkHours = $schedule['minWorkHours'];
if(isset($schedule['maxWorkHours'])) $maxWorkHours = $schedule['maxWorkHours'];

jsVar('callback',       $callback);
jsVar('begin',          $begin);
jsVar('end',            $end);
jsVar('WorkHoursError', $lang->project->WorkHoursError);
jsVar('outSideDays',    $lang->project->outSideDays);
jsVar('workingDays',    $lang->project->workingDays);
jsVar('fullWeeks',      $lang->project->fullWeeks);
jsVar('setWorking',     $lang->project->setWorking);
formPanel
(
    setID('panel-schedule'),
    set::title($lang->project->schedule),
    set::actions(array()),
    div
    (
        div
        (
            setClass('flex items-center'),
            cell
            (
                setClass('pr-4'),
                checkList
                (
                    set::name('workDays'),
                    set::items($lang->project->workDaysList),
                    set::value($workDays),
                    set::inline(true),
                    setData(array('on' => 'click', 'call' => 'changeWorkDays', 'params' => 'event'))
                )
            ),
            cell(setClass('px-1 hidden'), $lang->project->workingHours),
            cell(setClass('px-1 hidden'), input(set::name('minWorkHours'), set::type('number'), setClass('w-16'), set::min(0), set::max(24), set::step('0.1'), set::value($minWorkHours))),
            cell(setClass('px-1 hidden'), '-'),
            cell(setClass('px-1 hidden'), input(set::name('maxWorkHours'), set::type('number'), setClass('w-16'), set::min(0), set::max(24), set::step('0.1'), set::value($maxWorkHours))),
            cell(setClass('px-1 hidden'), $lang->hour)
        ),
        div
        (
            setClass('flex pt-2'),
            cell
            (
                setClass('h-72 overflow-hidden'),
                div
                (
                    setClass('calendar-header flex  pb-2 pt-1'),
                    cell
                    (
                        set::width('60px'),
                        btn
                        (
                            setClass('btn ghost'),
                            setData(array('toggle' => 'dropdown')),
                            span(setClass('query-year'), date('Y', strtotime($begin))),
                            span(setClass('caret'))
                        ),
                        menu(setClass('dropdown-menu menu overflow-auto'), set::items(array_values($years)))
                    ),
                    cell
                    (
                        setClass('flex-1'),
                        btn
                        (
                            setClass('btn ghost'),
                            setData(array('toggle' => 'dropdown')),
                            span(setClass('query-month'), date('m', strtotime($begin))),
                            span(setClass('caret'))
                        ),
                        menu(setClass('dropdown-menu menu overflow-auto'), set::items($months))
                    ),
                    cell
                    (
                        btn(setClass('ghost disabled prev'), icon('angle-left', setClass('text-2xl')), setData(array('on' => 'click', 'call' => 'clickPrevMonth', 'params' => 'event'))),
                        btn(setClass('ghost next', count($months) <= 1 ? 'disabled' : ''), icon('angle-right', setClass('text-2xl')), setData(array('on' => 'click', 'call' => 'clickNextMonth', 'params' => 'event')))
                    )
                ),
                html($calendar)
            ),
            cell
            (
                setID('outSideBox'),
                setClass('flex-1 overflow-auto h-72'),
                html($buildOutSideTable())
            )
        )
    ),
    div
    (
        setClass('flex items-center'),
        btn(setClass('primary'), setData(array('on' => 'click', 'call' => 'saveCalendar', 'params' => 'event')), $lang->save),
        div(setID('workingDays'), setClass('ml-4'), sprintf($lang->project->workingDays, count($workingDays)))
    )
);
