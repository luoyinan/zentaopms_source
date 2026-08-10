<?php
public function start($oldTask, $task)
{
    return $this->loadExtension('gantt')->start($oldTask, $task);
}

public function finish($oldTask, $task)
{
    return $this->loadExtension('gantt')->finish($oldTask, $task);
}

public function checkDepend($taskID, $action = 'begin')
{
    return $this->loadExtension('gantt')->checkDepend($taskID, $action);
}

public function checkWorkhour($task, $workhour)
{
    return $this->loadExtension('gantt')->checkWorkhour($task, $workhour);
}

public function cancel($oldTask, $task, $output = array())
{
    return $this->loadExtension('gantt')->cancel($oldTask, $task, $output);
}

public function afterBatchUpdate($tasks, $oldTasks = array())
{
    return $this->loadExtension('gantt')->afterBatchUpdate($tasks, $oldTasks);
}
