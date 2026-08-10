<?php
public function getBasicMetrics($taskList)
{
    return $this->loadExtension('report')->getBasicMetrics($taskList);
}

public function buildBasicChartConfig($taskList)
{
    return $this->loadExtension('report')->buildBasicChartConfig($taskList);
}

public function getProgressMetrics($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getProgressMetrics($taskList, $data, $type);
}

public function buildProgressChartConfig($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildProgressChartConfig($taskList, $data, $type);
}

public function getResourceMetrics($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getResourceMetrics($taskList, $data, $type);
}

public function buildResourceChartConfig($taskList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildResourceChartConfig($taskList, $data, $type);
}

public function getMetricsCount($taskList, $items)
{
    return $this->loadExtension('report')->getMetricsCount($taskList, $items);
}

public function getMetricsChart($taskList, $items, $objectID = 0, $type = 'execution')
{
    return $this->loadExtension('report')->getMetricsChart($taskList, $items, $objectID, $type);
}

public function getMetricsTable($taskList, $items, $data = null, $type = 'execution')
{
    return $this->loadExtension('report')->getMetricsTable($taskList, $items, $data, $type);
}

public function processDateLimitForTasks($taskList, $data, $type)
{
    return $this->loadExtension('report')->processDateLimitForTasks($taskList, $data, $type);
}

public function getEffortMetrics($taskList, $items, $objectID = 0, $type = 'execution')
{
    return $this->loadExtension('report')->getEffortMetrics($taskList, $items, $objectID, $type);
}
