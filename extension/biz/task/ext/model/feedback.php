<?php
public function afterCreate($task, $taskIdList, $bugID, $todoID)
{
    return $this->loadExtension('feedback')->afterCreate($task, $taskIdList, $bugID, $todoID);
}

public function afterUpdate($oldTask, $task)
{
    $this->loadExtension('feedback')->afterUpdate($oldTask, $task);
}

public static function isClickable($task, $action)
{
    $action = strtolower($action);
    if($action == 'batchcreate' && empty($task->team) && empty($task->mode) && !in_array($task->status, array('closed', 'cancel'))) return true;

    return parent::isClickable($task, $action);
}

public function getParentTaskPairs($executionID, $appendIdList = '', $taskID = 0)
{
    return $this->loadExtension('feedback')->getParentTaskPairs($executionID, $appendIdList, $taskID);
}
