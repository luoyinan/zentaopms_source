<?php
public function getBugBasicMetrics($bugs, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getBugBasicMetrics($bugs, $data, $type);
}
public function buildBasicBugConfig($bugs, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildBasicBugConfig($bugs, $data, $type);
}
public function getBugProgressMetrics($bugs, $data, $type = 'execution')
{
    return $this->loadExtension('report')->getBugProgressMetrics($bugs, $data, $type);
}
public function buildProgressBugConfig($bugs, $data, $type = 'execution')
{
    return $this->loadExtension('report')->buildProgressBugConfig($bugs, $data, $type);
}
public function processUserStats($userPairs, $userData)
{
    return $this->loadExtension('report')->processUserStats($userPairs, $userData);
}

public function getBugMetricsCount($bugs, $data = null, $items = array())
{
    return $this->loadExtension('report')->getBugMetricsCount($bugs, $data, $items);
}

public function getBugMetricsChart($bugs, $items = array(), $data = null, $objectType = 'execution')
{
    return $this->loadExtension('report')->getBugMetricsChart($bugs, $items, $data, $objectType);
}
