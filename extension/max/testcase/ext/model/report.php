<?php
public function getBasicMetrics($cases, $data = null, $stories = array())
{
    return $this->loadExtension('report')->getBasicMetrics($cases, $data, $stories);
}
public function buildBasicConfig($cases, $data)
{
    return $this->loadExtension('report')->buildBasicConfig($cases, $data);
}

public function getMetricsCount($cases, $data = null)
{
    return $this->loadExtension('report')->getMetricsCount($cases, $data);
}

public function getMetricsChart($cases, $data = null, $items = array())
{
    return $this->loadExtension('report')->getMetricsChart($cases, $data, $items);
}
