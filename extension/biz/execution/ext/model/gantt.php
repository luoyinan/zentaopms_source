<?php
/**
 * The control file of execution module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     business(商业软件)
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     execution
 * @version     $Id$
 * @link        http://www.zentao.net
 */
public function mergeRelations($relations = array())
{
    return $this->loadExtension('gantt')->mergeRelations($relations);
}

public function getRelationTasks($taskList, $projectID, $executionID, $appendTasks = array())
{
    return $this->loadExtension('gantt')->getRelationTasks($taskList, $projectID, $executionID, $appendTasks);
}

public function getDisabledTasks($taskRelations, $taskID, $taskType)
{
    return $this->loadExtension('gantt')->getDisabledTasks($taskRelations, $taskID, $taskType);
}

public function checkRelation($relations = array(), $projectID = 0, $tasks = array())
{
    return $this->loadExtension('gantt')->checkRelation($relations, $projectID, $tasks);
}

public function createRelationOfTasks($projectID, $executionID)
{
    return $this->loadExtension('gantt')->createRelationOfTasks($projectID, $executionID);
}

public function updateRelationOfTask($relationID, $projectID)
{
    return $this->loadExtension('gantt')->updateRelationOfTask($relationID, $projectID);
}

public function editRelationOfTasks($projectID)
{
    return $this->loadExtension('gantt')->editRelationOfTasks($projectID);
}

public function getRelationsOfTasks($projectID, $executionID, $pager = null)
{
    return $this->loadExtension('gantt')->getRelationsOfTasks($projectID, $executionID, $pager);
}

public function getDataForGantt($executionID, $type, $orderBy, $productID = 0, $bysearch = false, $queryID = 0, $versionID = '0')
{
    return $this->loadExtension('gantt')->getDataForGantt($executionID, $type, $orderBy, $productID, $bysearch, $queryID, $versionID);
}

public function deleteRelation($relationID)
{
    return $this->loadExtension('gantt')->deleteRelation($relationID);
}

public function parseOrderBy($orderBy)
{
    return $this->loadExtension('gantt')->parseOrderBy($orderBy);
}

public function buildKanbanOrderBy($field, $currentOrder, $currentDirect)
{
    return $this->loadExtension('gantt')->buildKanbanOrderBy($field, $currentOrder, $currentDirect);
}

public function checkTaskRelation($relations, $projectID)
{
    return $this->loadExtension('gantt')->checkTaskRelation($relations, $projectID);
}

public function getHolidays($project, $begin = '', $end = '')
{
    return $this->loadExtension('gantt')->getHolidays($project, $begin, $end);
}
