<?php
namespace zin;

$lang      = data('lang');
$project   = data('project');
$projectID = data('projectID');
$productID = data('productID');
$plans     = data('plans');
$hasSearch = data('hasSearch');

jsVar('projectID', $projectID);
jsVar('productID', $productID);

$canModifyProject = common::canModify('project', $project);

global $app;
$executionID = $app->control->dao->select('id')->from(TABLE_PROJECT)->where('type')->in('stage,sprint,kanban')->andWhere('deleted')->eq('0')->andWhere('project')->eq($projectID)->orderBy('id')->fetch('id');

$hasFrozenStage = false;
foreach($plans['data'] as $plan)
{
    if(!empty($plan->frozen)) $hasFrozenStage = true;
}

$manageTaskItems = array();
if(!empty($executionID) && common::hasPriv('task', 'create')) $manageTaskItems[] = array('text' => $lang->execution->createTask, 'url' => createLink('task', 'create', "execution={$executionID}"), 'data-toggle' => 'modal', 'data-size' => 'lg');
if(common::hasPriv('programplan', 'relation')) $manageTaskItems[] = array('text' => $lang->programplan->relation, 'url' => createLink('programplan', 'relation', "projectID={$projectID}"));

global $config;
$scheduleBox = null;
if(empty($project->isTpl) && in_array($config->edition, array('max', 'ipd')) && common::hasPriv('programplan', 'taskAutoSchedule') && $hasSearch)
{
    $scheduleBox = div
    (
        setClass('scheduleBox'),
        btn(setClass('btn-link no-underline'), setData('toggle', 'dropdown'), $lang->project->autoSchedule, span(setClass('caret'))),
        menu
        (
            setClass('dropdown-menu'),
            li
            (
                checkbox
                (
                    set::name('minBufferingBtn'),
                    span($lang->task->minBuffering),
                    input(setClass('minBufferingInput'), set::type('number'), set::name('minBuffering'), set::min('0'), set::oninput("validity.valid || (value='');"), set::disabled(true)),
                    span($lang->execution->day),
                    on::click('setMinBuffering')
                ),
            ),
            li(checkbox(setClass('manualScheduleBox'), set::name('auto'), set::text($lang->task->schedule->autoMode)), on::click('setManualSchedule')),
            li(checkbox(setClass('globalScheduleBox'), set::name('global'), set::text($lang->task->schedule->globalMode)), on::click('setGlobalSchedule'))
        )
    );
}

$ganttBaseline   = data('ganttBaseline');
$ganttVersion    = data('versionID');
$isLatestVersion = empty($ganttVersion) && $ganttBaseline === null;
$canExportGantt  = hasPriv('programplan', 'ganttExport');
$exportItems     = array();
if($canExportGantt) $exportItems[] = array('text' => $lang->execution->gantt->exportImg, 'url' => 'javascript:exportGantt()');
if($canExportGantt) $exportItems[] = array('text' => $lang->execution->gantt->exportPDF, 'url' => 'javascript:exportGantt("pdf")');
if($canModifyProject && hasPriv('programplan', 'exportTemplate')) $exportItems[] = array('text' => $lang->programplan->exportTemplate, 'data-toggle' => 'modal', 'data-size' => 'sm', 'url' => createLink('programplan', 'exportTemplate', "projectID={$projectID}"));

$toolbar = toolbar
(
    btnGroup
    (
        btn(setClass('square switchBtn text-primary'), set::title($lang->programplan->gantt), icon('gantt-alt')),
        btn(setClass('square switchBtn'), set::title($lang->project->bylist), set::url(createLink('project', 'execution', "status=all&projectID=$projectID")), icon('list'))
    ),
    $exportItems ? dropdown
    (
        btn(set::type('link'), setClass('no-underline'), set::icon('export'), $lang->export),
        set::items($exportItems)
    ) : null,
    $canModifyProject && hasPriv('programplan', 'import') && $isLatestVersion ? item(set(array
    (
        'icon'        => 'import',
        'text'        => $lang->programplan->importTask,
        'class'       => "no-underline btn btn-link",
        'data-toggle' => 'modal',
        'data-size'   => 'sm',
        'url'         => createLink('programplan', 'import', "projectID={$projectID}")
    ))) : null,

    $isLatestVersion ? $scheduleBox : null,
    !empty($manageTaskItems) && $isLatestVersion ? dropdown
    (
        btn(set::type('link'), setClass('no-underline'), set::icon('list-alt'), $lang->programplan->manageTask),
        set::items($manageTaskItems)
    ) : null,
    ($canModifyProject && $isLatestVersion && common::hasPriv('programplan', 'create') && empty($product->deleted)) ? btn
    (
        set::url(createLink('programplan', 'create', "projectID=$projectID&productID=$productID")),
        set::icon('plus'),
        $lang->programplan->create,
        setClass('primary programplan-create-btn'),
        set::disabled($hasFrozenStage),
        set::hint($hasFrozenStage ? sprintf($lang->execution->stageFrozenTip, $lang->programplan->create) : '')
    ) : null
);

query('#actionBar')->replaceWith($toolbar);
pageJS('$(function(){$("#mainMenu .toolbar").prop("id", "actionBar"); });');
