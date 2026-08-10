<?php
/**
 * Process a task, judge it's status.
 * Extend for php warning.
 *
 * @param  object $task
 * @param  bool   $convertParent
 * @param  array  $workingDays
 * @access public
 * @return object
 */
public function processTask($task, $convertParent = true, $workingDays = array())
{
    $task = parent::processTask($task, $convertParent, $workingDays);

    $design = $task->design > 0 ? $this->loadModel('design')->fetchById($task->design) : '';
    $task->designName = !empty($design->name) ? $design->name : '';

    if($convertParent)
    {
        $task->parent = array();
        foreach(explode(',', trim((string)$task->path, ',')) as $parentID)
        {
            if(!$parentID) continue;
            if($parentID == $task->id) continue;
            $task->parent[] = (int)$parentID;
        }
    }

    return $task;
}

public function printCell($col, $task, $users, $browseType, $branchGroups, $modulePairs = array(), $mode = 'datatable', $child = false, $showBranch = false, $privs = array())
{
    if(!empty($privs))
    {
        $canBatchEdit         = $privs['canBatchEdit'];
        $canBatchClose        = $privs['canBatchClose'];
        $canBatchCancel       = $privs['canBatchCancel'];
        $canBatchChangeModule = $privs['canBatchChangeModule'];
        $canBatchAssignTo     = $privs['canBatchAssignTo'];
    }
    else
    {
        $canBatchEdit         = common::hasPriv('task', 'batchEdit', !empty($task) ? $task : null);
        $canBatchClose        = (common::hasPriv('task', 'batchClose', !empty($task) ? $task : null) && strtolower($browseType) != 'closedBy');
        $canBatchCancel       = common::hasPriv('task', 'batchCancel', !empty($task) ? $task : null);
        $canBatchChangeModule = common::hasPriv('task', 'batchChangeModule', !empty($task) ? $task : null);
        $canBatchAssignTo     = common::hasPriv('task', 'batchAssignTo', !empty($task) ? $task : null);
    }

    $canBatchAction = ($canBatchEdit or $canBatchClose or $canBatchCancel or $canBatchChangeModule or $canBatchAssignTo);
    $storyChanged   = (!empty($task->storyStatus) and $task->storyStatus == 'active' and $task->latestStoryVersion > $task->storyVersion and !in_array($task->status, array('cancel', 'closed')));

    $designChange = ($task->designName && $task->latestDesignVersion > $task->designVersion);
    $canView      = common::hasPriv('task', 'view');

    if($this->config->vision == 'lite')
    {
        $taskLink  = helper::createLink('task', 'view', "taskID=$task->id", '', true);
        $linkClass = 'class="iframe"';
    }
    else
    {
        $taskLink  = helper::createLink('task', 'view', "taskID=$task->id");
        $linkClass = '';
    }
    $account      = $this->app->user->account;
    $id           = $col->id;
    if($col->show)
    {
        $class = "c-{$id}";
        if($id == 'status') $class .= ' task-' . $task->status;
        if($id == 'id')     $class .= ' cell-id';
        if($id == 'name')   $class .= ' text-left';
        if($id == 'deadline' and isset($task->delay)) $class .= ' text-center delayed';
        if($id == 'assignedTo') $class .= ' has-btn text-left';
        if($id == 'lane') $class .= ' text-left';
        if(strpos('progress', $id) !== false) $class .= ' text-right';

        $title = '';
        if($id == 'name')
        {
            $title = " title='{$task->name}'";
            if(!empty($task->children)) $class .= ' has-child';
        }
        if($id == 'story') $title = " title='{$task->storyTitle}'";
        if($id == 'estimate' || $id == 'consumed' || $id == 'left')
        {
            $value = round($task->$id, 1);
            $title = " title='{$value} {$this->lang->execution->workHour}'";
        }
        if($id == 'lane') $title = " title='{$task->lane}'";

        echo "<td class='" . $class . "'" . $title . ">";
        if($this->config->edition != 'open') $this->loadModel('flow')->printFlowCell('task', $task, $id);
        switch($id)
        {
        case 'id':
            if($canBatchAction)
            {
                echo html::checkbox('taskIDList', array($task->id => '')) . html::a(helper::createLink('task', 'view', "taskID=$task->id"), sprintf('%03d', $task->id));
            }
            else
            {
                printf('%03d', $task->id);
            }
            break;
        case 'pri':
            echo "<span class='label-pri label-pri-" . $task->pri . "' title='" . zget($this->lang->task->priList, $task->pri, $task->pri) . "'>";
            echo zget($this->lang->task->priList, $task->pri, $task->pri);
            echo "</span>";
            break;
        case 'name':
            if($showBranch) $showBranch = isset($this->config->execution->task->showBranch) ? $this->config->execution->task->showBranch : 1;
            if($task->parent > 0 and isset($task->parentName)) $task->name = "{$task->parentName} / {$task->name}";
            if(!empty($task->product) and isset($branchGroups[$task->product][$task->branch]) and $showBranch) echo "<span class='label label-badge label-outline'>" . $branchGroups[$task->product][$task->branch] . '</span> ';
            if($task->module and isset($modulePairs[$task->module])) echo "<span class='label label-gray label-badge'>" . $modulePairs[$task->module] . '</span> ';
            if($task->parent > 0) echo '<span class="label label-badge label-light" title="' . $this->lang->task->children . '">' . $this->lang->task->childrenAB . '</span> ';
            if(!empty($task->team)) echo '<span class="label label-badge label-light" title="' . $this->lang->task->multiple . '">' . $this->lang->task->multipleAB . '</span> ';
            echo $canView ? html::a($taskLink, $task->name, null, "$linkClass style='color: $task->color' title='$task->name'") : "<span style='color: $task->color'>$task->name</span>";
            if(!empty($task->children)) echo '<a class="task-toggle" data-id="' . $task->id . '"><i class="icon icon-angle-right"></i></a>';
            if($task->fromBug) echo html::a(helper::createLink('bug', 'view', "id=$task->fromBug"), "[BUG#$task->fromBug]", '', "class='bug'");
            break;
        case 'type':
            echo zget($this->lang->task->typeList, $task->type, $task->type);
            break;
        case 'status':
            if($storyChanged)
            {
                print("<span class='status-story status-changed' title='{$this->lang->story->changed}'>{$this->lang->story->changed}</span>");
            }
            elseif($designChange)
            {
                print("<span class='status-design status-changed' title='{$this->lang->task->designChanged}'>{$this->lang->task->designChanged}</span>");
            }
            else
            {
                $statusLabel = $this->processStatus('task', $task);
                print("<span class='status-task status-{$task->status}' title='{$statusLabel}'> " . $statusLabel . "</span>");
            }
            break;
        case 'estimate':
            echo round($task->estimate, 1) . ' ' . $this->lang->execution->workHourUnit;
            break;
        case 'consumed':
            echo round($task->consumed, 1) . ' ' . $this->lang->execution->workHourUnit;
            break;
        case 'left':
            echo round($task->left, 1)     . ' ' . $this->lang->execution->workHourUnit;
            break;
        case 'design':
            echo $task->designName ? html::a(helper::createLink('design', 'view', "id=$task->design"), $task->designName) : '';
            break;
        case 'progress':
            echo "{$task->progress}%";
            break;
        case 'deadline':
            if(!helper::isZeroDate($task->deadline)) echo '<span>' . substr($task->deadline, 5, 6). '</span>';
            break;
        case 'openedBy':
            echo zget($users, $task->openedBy);
            break;
        case 'openedDate':
            echo substr($task->openedDate, 5, 11);
            break;
        case 'estStarted':
            echo helper::isZeroDate($task->estStarted) ? '' : substr($task->estStarted, 5, 11);
            break;
        case 'realStarted':
            echo helper::isZeroDate($task->realStarted) ? '' : substr($task->realStarted, 5, 11);
            break;
        case 'assignedTo':
            $this->printAssignedHtml($task, $users);
            break;
        case 'lane':
            echo mb_substr($task->lane, 0, 8);
            break;
        case 'assignedDate':
            echo helper::isZeroDate($task->assignedDate) ? '' : substr($task->assignedDate, 5, 11);
            break;
        case 'finishedBy':
            echo zget($users, $task->finishedBy);
            break;
        case 'finishedDate':
            echo helper::isZeroDate($task->finishedDate) ? '' : substr($task->finishedDate, 5, 11);
            break;
        case 'canceledBy':
            echo zget($users, $task->canceledBy);
            break;
        case 'canceledDate':
            echo helper::isZeroDate($task->canceledDate) ? '' : substr($task->canceledDate, 5, 11);
            break;
        case 'closedBy':
            echo zget($users, $task->closedBy);
            break;
        case 'closedDate':
            echo helper::isZeroDate($task->closedDate) ? '' : substr($task->closedDate, 5, 11);
            break;
        case 'closedReason':
            echo $this->lang->task->reasonList[$task->closedReason];
            break;
        case 'story':
            if(!empty($task->storyID))
            {
                if(common::hasPriv('story', 'view'))
                {
                    echo html::a(helper::createLink('story', 'view', "storyid=$task->storyID", 'html', true), "<i class='icon icon-{$this->lang->icons['story']}'></i>", '', "class='iframe' title='{$task->storyTitle}'");
                }
                else
                {
                    echo "<i class='icon icon-{$this->lang->icons['story']}' title='{$task->storyTitle}'></i>";
                }
            }
            break;
        case 'mailto':
            $mailto = explode(',', $task->mailto);
            foreach($mailto as $account)
            {
                $account = trim($account);
                if(empty($account)) continue;
                echo zget($users, $account) . ' &nbsp;';
            }
            break;
        case 'lastEditedBy':
            echo zget($users, $task->lastEditedBy);
            break;
        case 'lastEditedDate':
            echo helper::isZeroDate($task->lastEditedDate) ? '' : substr($task->lastEditedDate, 5, 11);
            break;
        case 'actions':
            echo $this->buildOperateMenu($task, 'browse');
            break;
        }
        echo '</td>';
    }
}

/**
 * Build task browse action menu.
 *
 * @param  object $task
 * @param  string $execution
 * @access public
 * @return void
 */
public function buildOperateBrowseMenu($task, $execution = '')
{
    $menu   = '';
    $params = "taskID=$task->id";

    $storyChanged = !empty($task->storyStatus) && $task->storyStatus == 'active' && $task->latestStoryVersion > $task->storyVersion && !in_array($task->status, array('cancel', 'closed'));
    $designChange = isset($task->designName) ? $task->designName && $task->latestDesignVersion > $task->designVersion : false;

    if($storyChanged) return $this->buildMenu('task', 'confirmStoryChange', $params, $task, 'browse', '', 'hiddenwin');
    if($designChange) return $this->buildMenu('task', 'confirmDesignChange', $params, $task, 'browse', 'search', 'hiddenwin');

    $canStart          = ($task->status != 'pause' and common::hasPriv('task', 'start'));
    $canRestart        = ($task->status == 'pause' and common::hasPriv('task', 'restart'));
    $canFinish         = common::hasPriv('task', 'finish');
    $canClose          = common::hasPriv('task', 'close');
    $canRecordEstimate = common::hasPriv('task', 'recordEstimate');
    $canEdit           = common::hasPriv('task', 'edit');
    $canBatchCreate    = ($this->config->vision != 'lite' and common::hasPriv('task', 'batchCreate'));

    $this->app->loadLang('stage');
    $disabled      = '';
    $taskStartTip  = '';
    $taskFinishTip = '';
    $taskRecordTip = '';

    if(!empty($execution) and !$execution->parallel and $execution->status == 'wait' and $this->config->systemMode == 'PLM' and isset($execution->ipdStage) and !$execution->ipdStage['canStart'])
    {
        if(in_array($execution->attribute, array_keys($this->lang->stage->ipdTypeList)))
        {
            $disabled = 'disabled';
            if(!$execution->ipdStage['isFirst']) $taskStartTip  = sprintf($this->lang->execution->disabledTip->taskStartTip, $this->lang->stage->ipdTypeList[$execution->ipdStage['preAttribute']], $this->lang->stage->ipdTypeList[$execution->attribute]);
            if(!$execution->ipdStage['isFirst']) $taskFinishTip = sprintf($this->lang->execution->disabledTip->taskFinishTip, $this->lang->stage->ipdTypeList[$execution->ipdStage['preAttribute']], $this->lang->stage->ipdTypeList[$execution->attribute]);
            if(!$execution->ipdStage['isFirst']) $taskRecordTip = sprintf($this->lang->execution->disabledTip->taskRecordTip, $this->lang->stage->ipdTypeList[$execution->ipdStage['preAttribute']], $this->lang->stage->ipdTypeList[$execution->attribute]);
        }
    }

    if(isset($task->ipdStage->canStart) and empty($task->ipdStage->canStart))
    {
        $disabled = 'disabled';
        if(isset($execution->ipdStage) and !$execution->ipdStage['isFirst']) $taskStartTip  = $task->ipdStage->taskStartTip;
        if(isset($execution->ipdStage) and !$execution->ipdStage['isFirst']) $taskFinishTip = $task->ipdStage->taskFinishTip;
        if(isset($execution->ipdStage) and !$execution->ipdStage['isFirst']) $taskRecordTip = $task->ipdStage->taskRecordTip;
    }

    if($task->status != 'pause') $menu .= $this->buildMenu('task', 'start',   $params, $task, 'browse', '', '', "iframe $disabled", true, $disabled ? 'disabled data-toggle=""' : '', $taskStartTip);
    if($task->status == 'pause') $menu .= $this->buildMenu('task', 'restart', $params, $task, 'browse', '', '', 'iframe', true);

    $menu .= $this->buildMenu('task', 'finish',         $params, $task, 'browse', '', '', "iframe $disabled", true, $disabled ? 'disabled data-toggle=""' : '', $taskFinishTip);
    $menu .= $this->buildMenu('task', 'close',          $params, $task, 'browse', '', '', 'iframe', true);

    if(($canStart or $canRestart or $canFinish or $canClose) and ($canRecordEstimate or $canEdit or $canBatchCreate) and $this->app->rawModule == 'task')
    {
        $menu .= "<div class='dividing-line'></div>";
    }

    $menu .= $this->buildMenu('task', 'recordEstimate', $params, $task, 'browse', 'time', '', "iframe $disabled", true, $disabled ? 'disabled data-toggle=""' : '', $taskRecordTip);
    $menu .= $this->buildMenu('task', 'edit',           $params, $task, 'browse', 'edit', '', '', false);
    if($this->config->vision != 'lite')
    {
        $menu .= $this->buildMenu('task', 'batchCreate', "execution=$task->execution&storyID=$task->story&moduleID=$task->module&taskID=$task->id&ifame=0", $task, 'browse', 'split', '', '', '', '', $this->lang->task->children);
    }

    return $menu;
}

/**
 * Gets the version record of the task.
 *
 * @param $taskID
 * @param $version
 * @access public
 * @return void
 */
public function getTaskSpec($taskID, $version)
{
    return $this->dao->select('*')->from(TABLE_TASKSPEC)
        ->where('task')->eq($taskID)
        ->andWhere('version')->eq($version)
        ->fetch();
}

public function activate($task, $comment, $teamData, $drag = array())
{
    $changes = parent::activate($task, $comment, $teamData, $drag);
    $now     = helper::now();

    $this->dao->update(TABLE_TASK)->set('activatedDate')->eq($now)->where('id')->eq($task->id)->exec();
    return $changes;
}

public function update($task, $teamData = null)
{
    $result = parent::update($task, $teamData);

    /* Update planDuration. */
    if($result)
    {
        $estStarted   = $this->post->estStarted;
        $deadline     = $this->post->deadline;
        $planDuration = $this->loadModel('holiday')->getActualWorkingDays($estStarted, $deadline);
        $planDuration = count($planDuration);

        $this->dao->update(TABLE_TASK)->set('planDuration')->eq($planDuration)->where('id')->eq($task->id)->exec();
    }

    return $result;
}

/**
 * 获取需要排期的任务。
 * Get tasks for schedule.
 *
 * @param  int|array $executionIdList
 * @param  string $orderBy
 * @access public
 * @return array
 */
public function getTasksForSchedule($executionIdList = 0, $orderBy = 'level_asc,estStarted_asc,id_asc')
{
    return $this->loadExtension('zentaomax')->getTasksForSchedule($executionIdList, $orderBy);
}

/**
 * 保存任务的排期数据。
 * Save task schedule.
 *
 * @param  array  $tasks
 * @access public
 * @return bool
 */
public function saveSchedule($tasks)
{
    return $this->loadExtension('zentaomax')->saveSchedule($tasks);
}

/**
 * 自动排期。
 * Auto schedule.
 *
 * @param  int    $executionID
 * @param  array  $tasks
 * @param  string $type         manual|auto
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function autoSchedule($executionID, $tasks, $type = 'manual', $minBuffering = 0)
{
    return $this->loadExtension('zentaomax')->autoSchedule($executionID, $tasks, $type, $minBuffering);
}

/**
 * 检查当前任务的开始结束日期是否有改变。
 * Check task date diff.
 *
 * @param  object $task
 * @param  array  $tasks
 * @param  array  $relations
 * @param  object $execution
 * @param  string $type           manual|auto
 * @param  array  $processedTasks
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function checkTaskDateDiff($task, $tasks, $relations, $execution, $type, $processedTasks, $minBuffering)
{
    return $this->loadExtension('zentaomax')->checkTaskDateDiff($task, $tasks, $relations, $execution, $type, $processedTasks, $minBuffering);
}

/**
 * 平移当前节点。
 * Move in parallel.
 *
 * @param  array  $tasks
 * @param  int    $days
 * @param  object $relation
 * @param  array  $relations
 * @param  object $execution
 * @param  string $type
 * @param  array  $processedTasks
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function moveInParallel($tasks, $days, $relation, $relations, $execution, $type, $processedTasks, $minBuffering)
{
    return $this->loadExtension('zentaomax')->moveInParallel($tasks, $days, $relation, $relations, $execution, $type, $processedTasks, $minBuffering);
}

/**
 * 压缩当前节点。
 * Compress stage.
 *
 * @param  array  $tasks
 * @param  object $relation
 * @param  array  $relations
 * @param  object $execution
 * @param  string $type
 * @param  array  $processedTasks
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function compressStage($tasks, $relation, $relations, $execution, $type, $processedTasks, $minBuffering = 0)
{
    return $this->loadExtension('zentaomax')->compressStage($tasks, $relation, $relations, $execution, $type, $processedTasks, $minBuffering);
}

/**
 * 检查父任务的日期范围。
 * Check parent task date.
 *
 * @param  int    $taskID
 * @param  array  $tasks
 * @param  array  $relations
 * @param  object $execution
 * @param  string $type
 * @param  array  $processedTasks
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function checkParentTaskDate($taskID, $tasks, $relations, $execution, $type, $processedTasks, $minBuffering)
{
    return $this->loadExtension('zentaomax')->checkParentTaskDate($taskID, $tasks, $relations, $execution, $type, $processedTasks, $minBuffering);
}

/**
 * 根据排期日历计算任务开始结束日期。
 * compute date.
 *
 * @param  string $begin
 * @param  int    $days
 * @param  array  $executionSchedule
 * @access public
 * @return string
 */
public function computeDate($date, $days, $executionSchedule)
{
    return $this->loadExtension('zentaomax')->computeDate($date, $days, $executionSchedule);
}

/**
 * 获取关联关系顶部的任务。
 * Get top task of relations.
 *
 * @param  int    $executionID
 * @access public
 * @return array
 */
public function getTopTaskOfRelations($executionID)
{
    return $this->loadExtension('zentaomax')->getTopTaskOfRelations($executionID);
}

/**
 * 获取任务的关联关系。
 * Get task relations.
 *
 * @param  int    $executionID
 * @param  array  $tasks
 * @param  string $groupBy
 * @access public
 * @return array
 */
public function getTaskRelations($executionID, $tasks, $groupBy = 'pretask')
{
    return $this->loadExtension('zentaomax')->getTaskRelations($executionID, $tasks, $groupBy);
}

/**
 * 检查任务的规划是否超出执行起止日期。
 * Check execution planning.
 *
 * @param  object $task
 * @param  object $execution
 * @access public
 * @return bool
 */
public function checkTaskDate($task, $execution)
{
    return $this->loadExtension('zentaomax')->checkTaskDate($task, $execution);
}

/**
 * 获取锚点日期。
 * Get anchor date.
 *
 * @param  array  $tasks
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function getAnchorDate($tasks, $minBuffering = 0)
{
    return $this->loadExtension('zentaomax')->getAnchorDate($tasks, $minBuffering);
}

/**
 * 计算最小所需人天。
 * Compute min work days.
 *
 * @param  array  $tasks
 * @param  object $execution
 * @access public
 * @return array
 */
public function computeMinWorkdays($tasks, $execution)
{
    return $this->loadExtension('zentaomax')->computeMinWorkdays($tasks, $execution);
}

/**
 * 获取日期范围。
 * Get date range.
 *
 * @param  array  $tasks
 * @param  object $task
 * @param  object $execution
 * @param  array  $anchorDate
 * @access public
 * @return array
 */
public function getDateRanger($tasks, $task, $execution, $anchorDate)
{
    return $this->loadExtension('zentaomax')->getDateRanger($tasks, $task, $execution, $anchorDate);
}

/**
 * 全局排期。
 * global schedule.
 *
 * @param  int    $executionID
 * @param  array  $tasks
 * @param  string $type
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function globalSchedule($executionID, $tasks, $type = 'manual', $minBuffering = 0)
{
    return $this->loadExtension('zentaomax')->globalSchedule($executionID, $tasks, $type, $minBuffering);
}

/**
 * 获取当前任务所属任务关系顶点的任务。
 * Get top task of relations.
 *
 * @param  int    $taskID
 * @param  array  $taskRelations
 * @access public
 * @return int
 */
public function getTopTask($taskID, $taskRelations)
{
    return $this->loadExtension('zentaomax')->getTopTask($taskID, $taskRelations);
}

/**
 * 最简排期。
 * Simple schedule.
 *
 * @param  object $preTask
 * @param  array  $tasks
 * @param  array  $taskRelations
 * @param  object $execution
 * @param  int    $minBuffering
 * @param  string $type
 * @access public
 * @return array
 */
public function simpleSchedule($preTask, $tasks, $taskRelations, $execution, $minBuffering, $type)
{
    return $this->loadExtension('zentaomax')->simpleSchedule($preTask, $tasks, $taskRelations, $execution, $minBuffering, $type);
}

/**
 * 获取前置任务。
 * Get pre tasks.
 *
 * @param  int    $taskID
 * @access public
 * @return array
 */
public function getPreTasks($taskID)
{
    return $this->loadExtension('zentaomax')->getPreTasks($taskID);
}

/**
 * 检查手动排期。
 * Check manual schedule.
 *
 * @param  array $data
 * @param  int   $taskID
 * @access public
 * @return array
 */
public function checkManualSchedule($data, $taskID)
{
    return $this->loadExtension('zentaomax')->checkManualSchedule($data, $taskID);
}
