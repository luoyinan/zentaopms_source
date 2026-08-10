<?php
public function getBasicMetrics($storyList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getBasicMetrics($storyList, $data, $type);
}
public function buildBasicChartConfig($storyList, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildBasicChartConfig($storyList, $data, $type);
}
public function getProgressMetrics($storyList)
{
    return $this->loadExtension('report')->getProgressMetrics($storyList);
}
public function buildProgressChartConfig($storyList)
{
    return $this->loadExtension('report')->buildProgressChartConfig($storyList);
}
public function getChangedStory($storyID, $begin, $end)
{
    return $this->loadExtension('report')->getChangedStory($storyID, $begin, $end);
}

public function getMetricsCount($storyList, $data = null, $items = array())
{
    return $this->loadExtension('report')->getMetricsCount($storyList, $data, $items);
}

public function getMetricsChart($storyList, $items = array())
{
    return $this->loadExtension('report')->getMetricsChart($storyList, $items);
}
