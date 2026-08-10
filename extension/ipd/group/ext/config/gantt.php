<?php
$config->group->package->executionGantt = new stdclass();
$config->group->package->executionGantt->order  = 5;
$config->group->package->executionGantt->subset = 'executionview';
$config->group->package->executionGantt->privs  = array();
$config->group->package->executionGantt->privs['execution-gantt']        = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd,lite', 'order' => 0, 'depend' => array(), 'recommend' => array('execution-calendar', 'execution-ganttEdit', 'execution-ganttsetting', 'execution-grouptask', 'execution-taskEffort', 'execution-tree'));
$config->group->package->executionGantt->privs['execution-ganttsetting'] = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd', 'order' => 2, 'depend' => array('execution-gantt'), 'recommend' => array());
$config->group->package->executionGantt->privs['execution-ganttEdit']    = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd', 'order' => 3, 'depend' => array('execution-gantt'), 'recommend' => array());

$config->group->package->executionExportGantt = new stdclass();
$config->group->package->executionExportGantt->order  = 5;
$config->group->package->executionExportGantt->subset = 'executionview';
$config->group->package->executionExportGantt->privs  = array();
$config->group->package->executionExportGantt->privs['execution-ganttExport'] = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd', 'order' => 4, 'depend' => array('execution-gantt'), 'recommend' => array());

$config->group->package->executionGanttVersion = new stdclass();
$config->group->package->executionGanttVersion->order  = 5;
$config->group->package->executionGanttVersion->subset = 'executionview';
$config->group->package->executionGanttVersion->privs  = array();
$config->group->package->executionGanttVersion->privs['execution-createGanttVersion'] = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd,lite', 'order' => 0,  'depend' => array('execution-gantt'), 'recommend' => array('execution-diffGanttVersion', 'execution-editGanttVersion', 'execution-deleteGanttVersion'));
$config->group->package->executionGanttVersion->privs['execution-editGanttVersion']   = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd,lite', 'order' => 5,  'depend' => array('execution-gantt'), 'recommend' => array('execution-diffGanttVersion', 'execution-createGanttVersion', 'execution-deleteGanttVersion'));
$config->group->package->executionGanttVersion->privs['execution-deleteGanttVersion'] = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd,lite', 'order' => 10, 'depend' => array('execution-gantt'), 'recommend' => array('execution-diffGanttVersion', 'execution-editGanttVersion', 'execution-createGanttVersion'));
$config->group->package->executionGanttVersion->privs['execution-diffGanttVersion']   = array('edition' => 'open,biz,max,ipd', 'vision' => 'rnd,lite', 'order' => 15, 'depend' => array('execution-gantt'), 'recommend' => array('execution-createGanttVersion', 'execution-editGanttVersion', 'execution-deleteGanttVersion'));

$config->group->package->executionRelation->privs['execution-relation']['edition']            .= ',open';
$config->group->package->executionRelation->privs['execution-createrelation']['edition']      .= ',open';
$config->group->package->executionRelation->privs['execution-editrelation']['edition']        .= ',open';
$config->group->package->executionRelation->privs['execution-batcheditrelation']['edition']   .= ',open';
$config->group->package->executionRelation->privs['execution-deleterelation']['edition']      .= ',open';
$config->group->package->executionRelation->privs['execution-batchdeleterelation']['edition'] .= ',open';
