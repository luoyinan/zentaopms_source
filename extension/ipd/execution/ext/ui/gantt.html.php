<?php
/**
 * The gantt view file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@chandao.com>
 * @package     execution
 * @version     $Id: editrelation.html.php 935 2024-08-08 15:14:24Z $
 * @link        https://www.zentao.net
 */
namespace zin;

if($config->vision == 'lite') include 'header.html.php';

jsVar('executionID', $executionID);

$ganttLang = new stdclass();
$ganttLang->exporting           = $lang->programplan->exporting;
$ganttLang->exportFail          = $lang->programplan->exportFail;
$ganttLang->zooming             = $lang->execution->gantt->zooming;
$ganttLang->hideCriticalPath    = $lang->programplan->hideCriticalPath;
$ganttLang->showCriticalPath    = $lang->programplan->showCriticalPath;
$ganttLang->fullScreen          = $lang->execution->gantt->fullScreen;
$ganttLang->taskStatusList      = $lang->task->statusList;
$ganttLang->ganttSetting        = $lang->execution->ganttSetting;
$ganttLang->edit                = $lang->programplan->edit;
$ganttLang->submit              = $lang->programplan->submit;
$ganttLang->today               = $lang->programplan->today;
$ganttLang->scrollToToday       = $lang->execution->gantt->scrollToToday;
$ganttLang->deleteRelation      = $lang->execution->gantt->confirmDelete;
$ganttLang->errorTaskDrag       = $lang->programplan->error->taskDrag;
$ganttLang->errorPlanDrag       = $lang->programplan->error->planDrag;
$ganttLang->warningNoToday      = $lang->execution->gantt->warning->noTodayMarker;
$ganttLang->wrongRelation       = $lang->execution->error->wrongGanttRelation;
$ganttLang->wrongRelationSource = $lang->execution->error->wrongGanttRelationSource;
$ganttLang->wrongRelationTarget = $lang->execution->error->wrongGanttRelationTarget;
$ganttLang->wrongKanbanTasks    = $lang->execution->error->wrongKanbanTasks;
$ganttLang->warningNoToday      = $lang->execution->gantt->warning->noTodayMarker;
$ganttLang->deadline            = $lang->programplan->end;

$fileName = ($execution->type == 'stage' ? "$project->name-" : '') . $executionName . '-' . $lang->execution->ganttchart;

$typeHtml  = '<span class="toggle-all-icon"><i class="icon-expand-alt"></i></span><a data-toggle="dropdown" href="#browseTypeList"><span class="text">' . $lang->execution->gantt->browseType[$ganttType] . '</span><span class="caret"></span></a>';
$typeHtml .= '<menu class="dropdown-menu menu" id="browseTypeList">';
foreach($lang->execution->gantt->browseType as $ganttBrowseType => $typeName)
{
    $link = createLink('execution', 'gantt', "executionID=$executionID&type=$ganttBrowseType&orderBy={$orderBy}&productID={$productID}&bysearch={$bysearch}&param={$param}&versionID={$versionID}");
    $typeHtml .= '<li class="menu-item' . ($ganttType == $ganttBrowseType ? " active" : '') . '">' . html::a($link, $typeName, '', "class='item-content'") . '</li>';
}
$typeHtml .= '</menu>';

$notSort = array('delay', 'delayDays');
$ganttFields = [];
$ganttFields['column_text']       = $typeHtml;
$ganttFields['column_percent']    = $lang->execution->ganttCustom['progress'];
$ganttFields['column_start_date'] = array('text' => $lang->execution->ganttCustom['begin']);
$ganttFields['column_end_date']   = array('text' => $lang->execution->gantt->endDate);
foreach($lang->execution->ganttCustom as $field => $name)
{
    if($field == 'progress') continue;

    $ganttField = "column_{$field}";
    if(isset($ganttFields[$ganttField])) continue;
    $ganttFields[$ganttField] = in_array($field, $notSort) ? $name : array('text' => $name);
}

list($orderField, $orderDirect) = $this->execution->parseOrderBy($orderBy);
foreach($ganttFields as $colName => $value)
{
    $field = str_replace('column_', '', $colName);
    if(is_null($value) || is_array($value))
    {
        list($fieldOrderBy, $fieldClass) = $this->execution->buildKanbanOrderBy($field, $orderField, $orderDirect);
        $text  = (is_array($value) && !empty($value['text'])) ? $value['text'] : $lang->execution->ganttCustom[$field];
        $value = \html::a(createLink('execution', 'gantt', "executionID=$executionID&type=$ganttType&orderBy=$fieldOrderBy&productID=$productID&bysearch=$bysearch&param=$param"), $text, '', "class='$fieldClass'");
        if($versionID != 0) $value = $text;
    }

    $ganttFields[$colName] = $value;
}

$productDropdown = null;
if(!empty($productList) && count($productList) > 1 && !empty($execution->hasProduct))
{
    $viewName = $productID != 0 ? zget($productList, $productID) : $lang->product->allProduct;
    $items    = array(array('text' => $lang->product->allProduct, 'url' => $this->createLink('execution', 'gantt', "executionID={$executionID}&type={$ganttType}&orderBy={$orderBy}&productID=0"), 'active' => $productID == 'all' || $productID == '0'));
    foreach($productList as $key => $productName) $items[] = array('text' => $productName, 'url' => $this->createLink('execution', 'gantt', "executionID={$executionID}&type={$ganttType}&orderBy={$orderBy}&productID={$key}"), 'active' => $productID == $key);
    $productDropdown = dropdown
    (
        btn(setClass('ghost mr-2', ($productID != 0 ? 'active' : '')), $viewName),
        set::items($items)
    );
}

/* Build versions for dropdown. */
$isDiffMode     = isset($ganttBaseline);
$versionItems   = array();
$currentVersion = $lang->project->version;
foreach($versions as $version)
{
    $item = array('title' => $version->version, 'value' => $version->id, 'hint' => $version->version);
    $item['hint']    = $version->items;
    $item['actions'] = array();
    if(hasPriv('execution', 'editGanttVersion'))   $item['actions'][] = array('icon' => 'edit',  'hint' => $lang->edit,   'url' => createLink('execution', 'editGanttVersion', "versionID={$version->id}"), 'data-toggle' => 'modal');
    if(hasPriv('execution', 'deleteGanttVersion')) $item['actions'][] = array('icon' => 'trash', 'hint' => $lang->delete, 'url' => createLink('execution', 'deleteGanttVersion', "versionID={$version->id}"), 'class' => 'ajax-submit', 'data-confirm' => $lang->confirmDelete);

    if($version->id == $versionID)
    {
        $currentVersion = $version->version;
        $item['class']  = 'selected';
    }
    $versionItems[$version->id] = $item;
}

$item = array('title' => $lang->project->latestVersion, 'value' => 0, 'class' =>  $versionID == '0' ? 'selected' : '', 'className' => 'sticky canvas', 'style' => array('bottom' => '-8px', 'height' => '32px'));
if(hasPriv('execution', 'createGanttVersion') && $versionID == '0') $item['actions'] = array(array('text' => $lang->project->saveVersion, 'class' => 'btn size-sm danger-outline rounded-full border border-gray', 'url' => createLink('execution', 'createGanttVersion', "executionID={$executionID}&productID={$productID}&type={$ganttType}"), 'data-toggle' => 'modal'));
$versionItems['nowait'] = array('title' => $lang->project->realProgress, 'value' => 'nowait', 'class' =>  $versionID == 'nowait' ? 'selected' : '', 'className' => 'sticky canvas border-t', 'style' => array('bottom' => '24px', 'height' => '32px'));
$versionItems['0']      = $item;
if($versionID == 'nowait') $currentVersion = $lang->project->realProgress;
if($versionID == '0' && $isDiffMode) $currentVersion = $lang->project->latestVersion;

$langData = [];
$langData['allVersions'] = $lang->project->allVersions;
$langData['compare']     = $lang->project->diffVersion;
$langData['confirm']     = $lang->confirm;
$langData['cancel']      = $lang->cancel;

$isLatestVersion = empty($versionID) && !$isDiffMode;
$versionList     = null;
if(in_array($config->edition, array('max', 'ipd')) && $config->vision != 'lite' && empty($execution->isTpl))
{
    $versionList = li
    (
        setID('versionList'),
        setClass('ml-2'),
        setStyle(array('order' => '10010')),
        versiondiff
        (
            setClass('inline-block'),
            set::appendClass('fixed-item'),
            set::versionID($versionID),
            set::currentVersion($currentVersion),
            set::canDiffVersion(hasPriv('execution', 'diffGanttVersion')),
            set::diffMode($isDiffMode),
            set::versionItems($versionItems),
            set::diffLang($langData),
            set::browseTemplate(createLink('execution', 'gantt', "executionID={$executionID}&type={$ganttType}&orderBy={$orderBy}&productID={$productID}&bysearch={$bysearch}&param={$param}&versionID=%s")),
            set::baseline($isDiffMode ? $ganttBaseline : null)
        ),
        icon
        (
            'help',
            setID('diffNotice'),
            setClass($isDiffMode ? '' : 'hidden'),
            set::title($lang->programplan->noticeDiffVersion)
        )
    );
}

featureBar
(
    btn(setClass('ghost mr-2', ($productID == 0 ? 'active' : '')), $lang->execution->featureBar['task']['all'], set::url('execution', 'gantt', "executionID={$executionID}")),
    $productDropdown,
    $isLatestVersion ? li(searchToggle(set::module('executionTask'), set::open($bysearch))) : null,
    $versionList
);

$toolbarItems = [];
if(hasPriv('execution', 'relation') && $config->vision != 'lite' && $isLatestVersion) $toolbarItems[] = ['type' => 'ghost', 'text' => $lang->execution->maintainRelation, 'icon' => 'list-alt muted', 'url' => createLink('execution', 'relation', "executionID=$executionID")];
if($this->app->rawMethod != 'relation' and $this->app->rawMethod != 'maintainrelation')
{
    $exportItems   = [];
    $exportItems[] = ['text' => $lang->execution->gantt->exportImg, 'url' => 'javascript:exportGantt()'];
    $exportItems[] = ['text' => $lang->execution->gantt->exportPDF, 'url' => 'javascript:exportGantt("pdf")'];
    if(common::hasPriv('execution', 'ganttExport')) $toolbarItems[] = ['text' => $lang->export, 'icon' => 'export muted', 'type' => 'dropdown', 'items' => $exportItems];
}
elseif(hasPriv('execution', 'maintainRelation') && $isLatestVersion)
{
    $toolbarItems[] = ['type' => 'secondary', 'text' => $lang->execution->gantt->editRelationOfTasks, 'icon' => 'plus', 'url' => createLink('execution', 'maintainRelation', "executionID=$executionID")];
}

$checkObject = new stdclass();
$checkObject->execution = $executionID;
$canCreateTask = hasPriv('task', 'create', $checkObject);
if($isLatestVersion) $toolbarItems[] = ['type' => 'primary', 'disabled' => !$canCreateTask, 'text' => $lang->task->create, 'icon' => 'plus', 'url' => $canCreateTask ? createLink('task', 'create', "execution=$executionID" . (isset($moduleID) ? "&storyID=&moduleID=$moduleID" : '')) : null, 'data-toggle' => 'modal', 'data-size' => 'lg'];

toolbar
(
    $config->vision == 'rnd' && empty($project->isTpl) && in_array($config->edition, array('max', 'ipd')) && $isLatestVersion && common::hasPriv('execution', 'taskAutoSchedule') ? to::before(div
    (
        setClass('scheduleBox'),
        btn(setClass('ghost'), setData('toggle', 'dropdown'), $lang->project->autoSchedule, span(setClass('caret'))),
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
    )) : null,
    set::items($toolbarItems)
);

h::css("#browseTypeList .menu-item .item-content{height:30px;}");
h::css("#browseTypeList .menu-item.active .item-content{color: var(--menu-selected-color); font-weight: 700;}");
h::css("#browseTypeList .menu-item.active .item-content:hover{color: #fff;}");
h::css("#featureBar .btn.active{background-color: rgba(48, 57, 74, 0.1);}");
h::css("#featureBar .btn.active::before{background-color: unset;}");

$toolbarButton = array();
if($config->vision == 'rnd') $toolbarButton[] = 'criticalPath';
$toolbarButton[] = 'fullscreen';
if(hasPriv('execution', 'ganttsetting')) $toolbarButton[] = 'setting';

gantt
(
    set('ganttLang', $ganttLang),
    set('ganttFields', $ganttFields),
    set('canEdit', $isLatestVersion ? hasPriv('execution', 'ganttEdit') : false),
    set('zooming', !empty($zooming) ? $zooming : 'day'),
    set('users', $users),
    set('showFields', $config->execution->ganttCustom->ganttFields),
    set::root($executionID),
    set::settingLink(createLink('execution', 'ganttSetting', "executionID=$executionID")),
    set::toolbar($toolbarButton),
    set::exportFileName($fileName),
    set::weekend(array('weekend' => zget($config->execution, 'weekend', 2), 'restDay' => zget($config->execution, 'restDay', 0))),
    set::holidays($holidays),
    set::workingDays($workingDays),
    set('options', $executionData)
);
