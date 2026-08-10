<?php
public function create($testtask)
{
    return $this->loadExtension('zentaomax')->create($testtask);
}

public function update($task, $oldTask)
{
    return $this->loadExtension('zentaomax')->update($task, $oldTask);
}

public function getProductTasks($productID, $branch = 'all', $type = '', $begin = '', $end = '', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getProductTasks($productID, $branch, $type, $begin, $end, $orderBy, $pager);
}

public function getProjectTasks($projectID, $productID = 0, $orderBy = 'id_desc', $pager = null, $status = '')
{
    return $this->loadExtension('zentaomax')->getProjectTasks($projectID, $productID, $orderBy, $pager, $status);
}

public function getExecutionTasks($executionID, $productID = 0, $objectType = 'execution', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaomax')->getExecutionTasks($executionID, $productID, $objectType, $orderBy, $pager);
}

public function getByUser($account, $pager = null, $orderBy = 'id_desc', $type = '')
{
    return $this->loadExtension('zentaomax')->getByUser($account, $pager, $orderBy, $type);
}

public function getLinkableCases($productID, $task, $type = 'all', $param = 0, $pager = null)
{
    return $this->loadExtension('zentaomax')->getLinkableCases($productID, $task, $type, $param, $pager);
}

public function getTaskProducts($taskID)
{
    return $this->loadExtension('zentaomax')->getTaskProducts($taskID);
}

public function appendProductGroup($tasks)
{
    return $this->loadExtension('zentaomax')->appendProductGroup($tasks);
}

public static function createTestTaskLink($type, $module, $parent, $extra)
{
    $taskID = $extra['taskID'];

    $data = new stdclass();
    $data->id     = $module->id;
    $data->parent = $module->parent ? $module->parent : $parent;
    $data->name   = $module->name;
    $data->url    = helper::createLink('testtask', 'cases', "taskID=$taskID&type=byModule&module={$module->id}");
    return $data;
}
