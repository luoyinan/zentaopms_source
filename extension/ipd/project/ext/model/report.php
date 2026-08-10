<?php
public function getMetricsCount($executionList, $items = array())
{
    return $this->loadExtension('report')->getMetricsCount($executionList, $items);
}

public function getMetricsChart($executionList, $items = array())
{
    return $this->loadExtension('report')->getMetricsChart($executionList, $items);
}

public function getMetricsTable($executionList, $project, $items = array())
{
    return $this->loadExtension('report')->getMetricsTable($executionList, $project, $items);
}
