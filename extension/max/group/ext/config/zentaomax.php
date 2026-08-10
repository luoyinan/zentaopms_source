<?php
$config->group->package->taskAutoSchedule = new stdclass();
$config->group->package->taskAutoSchedule->order  = 20;
$config->group->package->taskAutoSchedule->subset = 'task';
$config->group->package->taskAutoSchedule->privs  = array();
$config->group->package->taskAutoSchedule->privs['task-autoschedule'] = array('edition' => 'max,ipd', 'vision' => 'rnd', 'order' => 1, 'depend' => array('execution-task'), 'recommend' => array());

$config->group->package->executionAutoSchedule = new stdclass();
$config->group->package->executionAutoSchedule->order  = 40;
$config->group->package->executionAutoSchedule->subset = 'executionview';
$config->group->package->executionAutoSchedule->privs  = array();
$config->group->package->executionAutoSchedule->privs['execution-taskAutoSchedule'] = array('edition' => 'max,ipd', 'vision' => 'rnd', 'order' => 1, 'depend' => array('execution-gantt'), 'recommend' => array());

$config->group->package->projectAutoSchedule = new stdclass();
$config->group->package->projectAutoSchedule->order  = 15;
$config->group->package->projectAutoSchedule->subset = 'programplan';
$config->group->package->projectAutoSchedule->privs  = array();
$config->group->package->projectAutoSchedule->privs['programplan-taskAutoSchedule'] = array('edition' => 'max,ipd', 'vision' => 'rnd', 'order' => 1, 'depend' => array('programplan-browse'), 'recommend' => array());
