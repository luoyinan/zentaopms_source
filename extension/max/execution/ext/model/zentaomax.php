<?php
/**
 * 创建一个迭代。
 * Create a execution.
 *
 * @param  object    $execution
 * @param  array     $postMembers
 * @access public
 * @return int|false
 */
public function create($execution, $postMembers)
{
    return $this->loadExtension('zentaomax')->create($execution, $postMembers);
}

/**
 * 更新一个迭代。
 * Update a execution.
 *
 * @param  int    $executionID
 * @param  object $postData
 * @access public
 * @return array|false
 */
public function update($executionID, $postData)
{
    return $this->loadExtension('zentaomax')->update($executionID, $postData);
}

/**
 * 关闭迭代。
 * Close execution.
 *
 * @param  int       $executionID
 * @param  object    $postData
 * @access public
 * @return int|false
 */
public function close($executionID, $postData)
{
    return $this->loadExtension('zentaomax')->close($executionID, $postData);
}

/**
 * 检查迭代是否有已上传的交付物。
 * Check if the execution has uploaded deliverable.
 *
 * @param  object  $execution
 * @access public
 * @return bool
 */
public function hasUploadedDeliverable($execution)
{
    return $this->loadExtension('zentaomax')->hasUploadedDeliverable($execution);
}

/**
 * 检查执行和任务的时间是否有冲突。
 * Check date conflict.
 *
 * @param  array  $executions
 * @access public
 * @return array
 */
public function checkDateConflict($executions = array())
{
    return $this->loadExtension('zentaomax')->checkDateConflict($executions);
}

/**
 * 获取执行的排期。
 * Get executions' schedule.
 *
 * @param  int    $projectID
 * @param  string $status
 * @param  string $orderBy
 * @access public
 * @return array
 */
public function getExecutionsForSchedule($projectID = 0, $status = 'wait,doing', $orderBy = 'grade_asc,begin_asc')
{
    return $this->loadExtension('zentaomax')->getExecutionsForSchedule($projectID, $status, $orderBy);
}

/**
 * 保存执行的排期。
 * Save executions' schedule.
 *
 * @param  array  $executions
 * @access public
 * @return bool
 */
public function saveSchedule($executions)
{
    return $this->loadExtension('zentaomax')->saveSchedule($executions);
}

/**
 * 自动排期。
 * Auto schedule.
 *
 * @param  int    $projectID
 * @param  string $changeObjectType
 * @param  int    $changeObjectID
 * @param  array  $executions
 * @param  int    $minBuffering
 * @access public
 * @return array
 */
public function autoSchedule($projectID, $changeObjectType, $changeObjectID, $executions, $minBuffering = 0)
{
    return $this->loadExtension('zentaomax')->autoSchedule($projectID, $changeObjectType, $changeObjectID, $executions, $minBuffering);
}

/**
 * 节点递归平移。
 * Move in parallel.
 *
 * @param  int    $objectID
 * @param  array  $executions
 * @param  int    $days
 * @param  array  $relations
 * @param  object $project
 * @param  string $type       manual|auto
 * @access public
 * @return array
 */
public function moveInParallel($objectID, $executions, $days, $relations, $project, $type = 'manual')
{
    return $this->loadExtension('zentaomax')->moveInParallel($objectID, $executions, $days, $relations, $project, $type);
}

/**
 * 节点递归压缩。
 * Compress stage.
 *
 * @param  int    $objectID
 * @param  array  $executions
 * @param  array  $relations
 * @param  object $project
 * @param  int    $minBuffering
 * @param  string $type         manual|auto
 * @access public
 * @return array
 */
public function compressStage($objectID, $executions, $relations, $project, $minBuffering = 0, $type = 'manual')
{
    return $this->loadExtension('zentaomax')->compressStage($objectID, $executions, $relations, $project, $minBuffering, $type);
}

/**
 * 计算剩余可用工作日。
 * Compute left days.
 *
 * @param  array  $schedule
 * @param  string $endDate
 * @access public
 * @return int
 */
public function computeLeftDays($schedule, $endDate)
{
    return $this->loadExtension('zentaomax')->computeLeftDays($schedule, $endDate);
}

/**
 * 根据排期日历计算计划结束日期。
 * Compute end date.
 *
 * @param  string $begin
 * @param  int    $days
 * @param  array  $executionSchedule
 * @param  array  $projectSchedule
 * @access public
 * @return string
 */
public function computeEndDate($begin, $days, $executionSchedule, $projectSchedule)
{
    return $this->loadExtension('zentaomax')->computeEndDate($begin, $days, $executionSchedule, $projectSchedule);
}

/**
 * 自动计算迭代的结束日期和剩余工作日。
 * Process execution data.
 *
 * @param  object $execution
 * @param  object $project
 * @access public
 * @return object
 */
public function processExecutionData($execution, $project)
{
    return $this->loadExtension('zentaomax')->processExecutionData($execution, $project);
}

/**
 * 检查执行的规划是否超出项目起止日期。
 * Check execution planning.
 *
 * @param  object $execution
 * @param  object $project
 * @access public
 * @return bool
 */
public function checkExecutionDate($execution, $project)
{
    return $this->loadExtension('zentaomax')->checkExecutionDate($execution, $project);
}

/**
 * 获取项目的串联节点图。
 * Get stage relations.
 *
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getStageRelations($projectID)
{
    return $this->loadExtension('zentaomax')->getStageRelations($projectID);
}

/**
 * 获取项目的顶级阶段列表。
 * Get top stage list.
 *
 * @param  int    $projectID
 * @access public
 * @return array
 */
public function getTopStageList($projectID = 0)
{
    return $this->loadExtension('zentaomax')->getTopStageList($projectID);
}

/**
 * 获取日期范围。
 * Get date ranger.
 *
 * @param  array  $executions
 * @param  object $execution
 * @param  object $project
 * @param  array  $topStageList
 * @access public
 * @return array
 */
public function getDateRanger($executions, $execution, $project, $topStageList)
{
    return $this->loadExtension('zentaomax')->getDateRanger($executions, $execution, $project, $topStageList);
}

/**
 * 检查循环依赖关系是否存在。
 * Check circular dependencies.
 *
 * @param  int    $executionID
 * @access public
 * @return array
 */
public function checkCircularDependencies($executionID = 0)
{
    return $this->loadExtension('zentaomax')->checkCircularDependencies($executionID);
}

/**
 * 给任务进行自动排期。
 * Set auto schedule for tasks.
 *
 * @param  array  $tasks
 * @access public
 * @return bool
 */
public function setAutoScheduleForTasks($tasks)
{
    return $this->loadExtension('zentaomax')->setAutoScheduleForTasks($tasks);
}
