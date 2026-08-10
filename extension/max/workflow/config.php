<?php
$config->workflow->typeList = ['flow', 'table'];

$config->workflow->require = new stdclass();
$config->workflow->require->create      = 'module,name';
$config->workflow->require->copy        = 'module,name';
$config->workflow->require->edit        = 'module,name';
$config->workflow->require->release     = 'module,name,app';
$config->workflow->require->setapproval = 'approval';

$config->workflowtable = new stdclass();
$config->workflowtable->require = new stdclass();
$config->workflowtable->require->create = 'module';
$config->workflowtable->require->edit   = 'module';

$config->workflow->apps = array('crm', 'proj', 'doc', 'cash', 'team', 'welfare', 'hr', 'psi', 'flow', 'ameba');
$config->workflow->icons = array('flow', 'time', 'trigger', 'ver', 'thumbs-up', 'unlink', 'target', 'manager', 'meh', 'smile', 'manual', 'person', 'private', 'publish', 'report-list', 'resume', 'star-empty', 'theme', 'cube', 'lang', 'menu-backend');

$config->workflow->uniqueFields   = 'module';
$config->workflow->virtualParams  = ',currentUser,currentDept,deptManager,actor,today,now,';
$config->workflow->noExportModule = ',build,caselib,testsuite,testtask,charter,program,release,';

global $lang;
$config->workflow->search['module'] = 'workflow';

/* If not set alias t1 for table there occurs an error caused by search them from both  TABLE_CUSTOMER and TABLE_DATING by left-join expression when search some fields such as createdBy or createdDate. */
$config->workflow->search['fields']['name']        = $lang->workflow->name;
$config->workflow->search['fields']['app']         = $lang->workflow->app;
$config->workflow->search['fields']['desc']        = $lang->workflow->desc;
$config->workflow->search['fields']['createdBy']   = $lang->workflow->createdBy;
$config->workflow->search['fields']['createdDate'] = $lang->workflow->createdDate;
$config->workflow->search['fields']['id']          = $lang->workflow->id;

$config->workflow->search['params']['name']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->workflow->search['params']['app']         = array('operator' => '=',       'control' => 'select', 'values' => 'set in control');
$config->workflow->search['params']['desc']        = array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->workflow->search['params']['createdBy']   = array('operator' => '=',       'control' => 'select', 'values' => 'users');
$config->workflow->search['params']['createdDate'] = array('operator' => '>=',      'control' => 'input',  'values' => '', 'class' => 'date');
$config->workflow->search['params']['id']          = array('operator' => '=',       'control' => 'input',  'values' => '');

$config->workflow->buildin = new stdclass();
$config->workflow->buildin->modules = new stdclass();
$config->workflow->buildin->modules->product = new stdclass();
$config->workflow->buildin->modules->product->product     = array('table' => TABLE_PRODUCT,     'navigator' => 'primary');
$config->workflow->buildin->modules->product->productplan = array('table' => TABLE_PRODUCTPLAN, 'navigator' => 'secondary');
$config->workflow->buildin->modules->product->release     = array('table' => TABLE_RELEASE,     'navigator' => 'secondary');
$config->workflow->buildin->modules->product->story       = array('table' => TABLE_STORY,       'navigator' => 'secondary');
$config->workflow->buildin->modules->product->requirement = array('table' => TABLE_STORY,       'navigator' => 'secondary');
$config->workflow->buildin->modules->product->epic        = array('table' => TABLE_STORY,       'navigator' => 'secondary');

$config->workflow->buildin->modules->program = new stdclass();
$config->workflow->buildin->modules->program->program = array('table' => TABLE_PROJECT, 'navigator' => 'primary');
$config->workflow->buildin->modules->program->charter = array('table' => TABLE_CHARTER, 'navigator' => 'secondary');

$config->workflow->buildin->modules->project = new stdclass();
$config->workflow->buildin->modules->project->project       = array('table' => TABLE_PROJECT,       'navigator' => 'primary');
$config->workflow->buildin->modules->project->cm            = array('table' => TABLE_OBJECT,        'navigator' => 'secondary');
$config->workflow->buildin->modules->project->projectchange = array('table' => TABLE_PROJECTCHANGE, 'navigator' => 'secondary');
$config->workflow->buildin->modules->project->risk          = array('table' => TABLE_RISK,          'navigator' => 'secondary');
$config->workflow->buildin->modules->project->issue         = array('table' => TABLE_ISSUE,         'navigator' => 'secondary');
$config->workflow->buildin->modules->project->opportunity   = array('table' => TABLE_OPPORTUNITY,   'navigator' => 'secondary');

$config->workflow->buildin->modules->execution = new stdclass();
$config->workflow->buildin->modules->execution->execution = array('table' => TABLE_PROJECT, 'navigator' => 'primary');
$config->workflow->buildin->modules->execution->build     = array('table' => TABLE_BUILD,   'navigator' => 'secondary');
$config->workflow->buildin->modules->execution->task      = array('table' => TABLE_TASK,    'navigator' => 'secondary');

$config->workflow->buildin->modules->qa = new stdclass();
$config->workflow->buildin->modules->qa->bug       = array('table' => TABLE_BUG,       'navigator' => 'secondary');
$config->workflow->buildin->modules->qa->testcase  = array('table' => TABLE_CASE,      'navigator' => 'secondary');
$config->workflow->buildin->modules->qa->testtask  = array('table' => TABLE_TESTTASK,  'navigator' => 'secondary');
$config->workflow->buildin->modules->qa->testsuite = array('table' => TABLE_TESTSUITE, 'navigator' => 'secondary');
$config->workflow->buildin->modules->qa->caselib   = array('table' => TABLE_TESTSUITE, 'navigator' => 'secondary');

$config->workflow->buildin->modules->feedback = new stdclass();
$config->workflow->buildin->modules->feedback->feedback = array('table' => TABLE_FEEDBACK, 'navigator' => 'primary');
$config->workflow->buildin->modules->feedback->ticket   = array('table' => TABLE_TICKET,   'navigator' => 'secondary');

$config->workflow->buildin->modules->demandpool = new stdclass();
$config->workflow->buildin->modules->demandpool->demand = array('table' => TABLE_DEMAND, 'navigator' => 'secondary');

$config->workflow->buildin->subStatus = new stdclass();
$config->workflow->buildin->subStatus->modules = array('product', 'release', 'story', 'requirement', 'epic', 'project', 'task', 'bug', 'testcase', 'testtask', 'feedback', 'ticket');

$config->workflow->buildin->noApproval = array('feedback', 'testcase', 'story', 'requirement', 'epic', 'program', 'demand', 'cm', 'projectchange');

$config->workflow->buildin->createdBy = array();
$config->workflow->buildin->createdBy['story']         = 'openedBy';
$config->workflow->buildin->createdBy['requirement']   = 'openedBy';
$config->workflow->buildin->createdBy['epic']          = 'openedBy';
$config->workflow->buildin->createdBy['story']         = 'openedBy';
$config->workflow->buildin->createdBy['project']       = 'openedBy';
$config->workflow->buildin->createdBy['program']       = 'openedBy';
$config->workflow->buildin->createdBy['execution']     = 'openedBy';
$config->workflow->buildin->createdBy['build']         = 'builder';
$config->workflow->buildin->createdBy['task']          = 'openedBy';
$config->workflow->buildin->createdBy['bug']           = 'openedBy';
$config->workflow->buildin->createdBy['testcase']      = 'openedBy';
$config->workflow->buildin->createdBy['testsuite']     = 'addedBy';
$config->workflow->buildin->createdBy['caselib']       = 'addedBy';
$config->workflow->buildin->createdBy['feedback']      = 'openedBy';
$config->workflow->buildin->createdBy['ticket']        = 'openedBy';
$config->workflow->buildin->createdBy['demand']        = 'createdBy';
$config->workflow->buildin->createdBy['charter']       = 'createdBy';
$config->workflow->buildin->createdBy['cm']            = 'createdBy';
$config->workflow->buildin->createdBy['projectchange'] = 'createdBy';
$config->workflow->buildin->createdBy['risk']          = 'createdBy';
$config->workflow->buildin->createdBy['issue']         = 'createdBy';
$config->workflow->buildin->createdBy['opportunity']   = 'createdBy';

$config->workflow->buildin->visions = array('demand' => 'or');

$config->workflow->buildin->liteModules = array('project', 'task', 'feedback', 'ticket');
