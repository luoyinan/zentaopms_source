<?php
$config->workflowlayout->noTotalFields = 'id,parent,program,project,product,execution';

$config->workflowlayout->disabledFields['view']        = 'parent,deleted';
$config->workflowlayout->disabledFields['browse']      = 'parent,deleted,files';
$config->workflowlayout->disabledFields['create']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['batchcreate'] = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['batchedit']   = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['batchassign'] = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['edit']        = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['assign']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['delete']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate,actions,files';
$config->workflowlayout->disabledFields['custom']      = 'id,parent,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate';
$config->workflowlayout->disabledFields['subTables']   = 'id,parent,status,subStatus,assignedTo,createdBy,createdDate,editedBy,editedDate,deleted,assignedBy,assignedDate,actions,files';

$config->workflowlayout->default = new stdclass();
$config->workflowlayout->default->required = array();
$config->workflowlayout->default->required['browse'] = array('actions');

$config->workflowlayout->approval = new stdclass();
$config->workflowlayout->approval->required = array();
$config->workflowlayout->approval->required['approvalreview'] = array('reviewResult', 'reviewOpinion');

$config->workflowlayout->approval->layouts = array();
$config->workflowlayout->approval->layouts['approvalreview'] = array();
$config->workflowlayout->approval->layouts['approvalreview']['reviewResult']  = array('default' => 'pass');
$config->workflowlayout->approval->layouts['approvalreview']['reviewOpinion'] = array();

$config->workflowlayout->buildin = new stdclass();
$config->workflowlayout->buildin->layouts = new stdclass();
$config->workflowlayout->buildin->layouts->product = new stdclass();
$config->workflowlayout->buildin->layouts->product->browse['id']      = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['name']    = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['line']    = array('width' => 110,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['type']    = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['status']  = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['desc']    = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['PO']      = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['QD']      = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['RD']      = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->product->browse['actions'] = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->story = new stdclass();
$config->workflowlayout->buildin->layouts->story->browse['id']         = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['pri']        = array('width' => 50,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['title']      = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['plan']       = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['openedBy']   = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['assignedTo'] = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['estimate']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['status']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['stage']      = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->story->browse['actions']    = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->requirement = $config->workflowlayout->buildin->layouts->story;
$config->workflowlayout->buildin->layouts->epic        = $config->workflowlayout->buildin->layouts->story;

$config->workflowlayout->buildin->layouts->productplan = new stdclass();
$config->workflowlayout->buildin->layouts->productplan->browse['id']      = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['product'] = array('width' => 160,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['branch']  = array('width' => 160,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['title']   = array('width' => 160,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['begin']   = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['end']     = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['desc']    = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->productplan->browse['actions'] = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->release = new stdclass();
$config->workflowlayout->buildin->layouts->release->browse['id']      = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->release->browse['name']    = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->release->browse['build']   = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->release->browse['date']    = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->release->browse['status']  = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->release->browse['desc']    = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->release->browse['actions'] = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->project = new stdclass();
$config->workflowlayout->buildin->layouts->project->browse['id']      = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->project->browse['name']    = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->project->browse['code']    = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->project->browse['PM']      = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->project->browse['end']     = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->project->browse['status']  = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->project->browse['actions'] = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->task = new stdclass();
$config->workflowlayout->buildin->layouts->task->browse['id']         = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['pri']        = array('width' => 50,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['name']       = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['status']     = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['assignedTo'] = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['finishedBy'] = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['estimate']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['consumed']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['left']       = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['deadline']   = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->task->browse['actions']    = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->build = new stdclass();
$config->workflowlayout->buildin->layouts->build->browse['product']  = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['id']       = array('width' => 70,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['name']     = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['scmPath']  = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['filePath'] = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['date']     = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['builder']  = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->build->browse['actions']  = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->bug = new stdclass();
$config->workflowlayout->buildin->layouts->bug->browse['id']         = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['severity']   = array('width' => 60,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['pri']        = array('width' => 50,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['title']      = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['status']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['openedBy']   = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['openedDate'] = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['assignedTo'] = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['resolution'] = array('width' => 70,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->bug->browse['actions']    = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->testcase = new stdclass();
$config->workflowlayout->buildin->layouts->testcase->browse['id']            = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['pri']           = array('width' => 40,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['title']         = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['type']          = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['openedBy']      = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['lastRunner']    = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['lastRunDate']   = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['lastRunResult'] = array('width' => 70,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['status']        = array('width' => 70,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testcase->browse['actions']       = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->testtask = new stdclass();
$config->workflowlayout->buildin->layouts->testtask->browse['id']      = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['name']    = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['product'] = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['project'] = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['build']   = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['owner']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['begin']   = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['end']     = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['status']  = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testtask->browse['actions'] = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->testsuite = new stdclass();
$config->workflowlayout->buildin->layouts->testsuite->browse['id']        = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testsuite->browse['name']      = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testsuite->browse['desc']      = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testsuite->browse['addedBy']   = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testsuite->browse['addedDate'] = array('width' => 150,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->testsuite->browse['actions']   = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->caselib = new stdclass();
$config->workflowlayout->buildin->layouts->caselib->browse['id']        = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->caselib->browse['name']      = array('width' => 200,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->caselib->browse['desc']      = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->caselib->browse['addedBy']   = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->caselib->browse['addedDate'] = array('width' => 150,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->caselib->browse['actions']   = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->feedback = new stdclass();
$config->workflowlayout->buildin->layouts->feedback->browse['id']         = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['product']    = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['title']      = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['status']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['openedBy']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['openedDate'] = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['assignedTo'] = array('width' => 120,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->feedback->browse['actions']    = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->cm = new stdclass();
$config->workflowlayout->buildin->layouts->cm->browse['id']          = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['title']       = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['version']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['status']      = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['category']    = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['createdBy']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['createdDate'] = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->cm->browse['actions']     = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->projectchange = new stdclass();
$config->workflowlayout->buildin->layouts->projectchange->browse['id']          = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['name']        = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['urgency']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['type']        = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['deliverable'] = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['owner']       = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['status']      = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['deadline']    = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['createdBy']   = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['createdDate'] = array('width' => 100,    'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->projectchange->browse['actions']     = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->risk = new stdclass();
$config->workflowlayout->buildin->layouts->risk->browse['id']             = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['name']           = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['pri']            = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['rate']           = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['status']         = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['category']       = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['identifiedDate'] = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['assignedTo']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['strategy']       = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->risk->browse['actions']        = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->issue = new stdclass();
$config->workflowlayout->buildin->layouts->issue->browse['id']          = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['title']       = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['pri']         = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['severity']    = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['type']        = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['owner']       = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['createdDate'] = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['assignedTo']  = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['assignedBy']  = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['status']      = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->issue->browse['actions']     = array('width' => 130,    'mobileShow' => 0);

$config->workflowlayout->buildin->layouts->opportunity = new stdclass();
$config->workflowlayout->buildin->layouts->opportunity->browse['id']             = array('width' => 90,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['name']           = array('width' => 'auto', 'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['pri']            = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['ratio']          = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['status']         = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['type']           = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['identifiedDate'] = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['assignedTo']     = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['strategy']       = array('width' => 80,     'mobileShow' => 0);
$config->workflowlayout->buildin->layouts->opportunity->browse['actions']        = array('width' => 130,    'mobileShow' => 0);

/* 检查两个条件，是否可以同时满足，如果可以同时满足，则不能保存或待定，如果不能同时满足，则可以保存. */
/* 0:待定/不可，1：可以，2：互斥。*/
/* =:表示两个条件的值相同，>：表示第一个条件的值大于第二个条件的值，<：表示第一个条件的值小于第二个条件的值。*/
/* 数组前一个键：表示第一个条件，数组后一个键：表示第二个条件。*/
$config->workflowlayout->uniqueRelation = array();
$config->workflowlayout->uniqueRelation['equal']['equal']       = array('=' => 0, '>' => 1, '<' => 1);
$config->workflowlayout->uniqueRelation['equal']['notequal']    = array('=' => 2, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['equal']['gt']          = array('=' => 1, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['equal']['ge']          = array('=' => 0, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['equal']['lt']          = array('=' => 1, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['equal']['le']          = array('=' => 0, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['notequal']['equal']    = array('=' => 2, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['notequal']['notequal'] = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['notequal']['gt']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['notequal']['ge']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['notequal']['lt']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['notequal']['le']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['gt']['equal']          = array('=' => 1, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['gt']['notequal']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['gt']['gt']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['gt']['ge']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['gt']['lt']             = array('=' => 1, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['gt']['le']             = array('=' => 2, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['ge']['equal']          = array('=' => 0, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['ge']['notequal']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['ge']['gt']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['ge']['ge']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['ge']['lt']             = array('=' => 2, '>' => 1, '<' => 0);
$config->workflowlayout->uniqueRelation['ge']['le']             = array('=' => 0, '>' => 1, '<' => 1);
$config->workflowlayout->uniqueRelation['lt']['equal']          = array('=' => 1, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['lt']['notequal']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['lt']['gt']             = array('=' => 1, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['lt']['ge']             = array('=' => 2, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['lt']['lt']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['lt']['le']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['le']['equal']          = array('=' => 0, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['le']['notequal']       = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['le']['gt']             = array('=' => 2, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['le']['ge']             = array('=' => 0, '>' => 0, '<' => 1);
$config->workflowlayout->uniqueRelation['le']['lt']             = array('=' => 0, '>' => 0, '<' => 0);
$config->workflowlayout->uniqueRelation['le']['le']             = array('=' => 0, '>' => 0, '<' => 0);
