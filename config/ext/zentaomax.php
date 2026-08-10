<?php
$config->maxVersion = '8.4';

if(!defined('TABLE_AUDITCL'))            define('TABLE_AUDITCL', '`' . $config->db->prefix . 'auditcl`');
if(!defined('TABLE_AUDITPLAN'))          define('TABLE_AUDITPLAN', '`' . $config->db->prefix . 'auditplan`');
if(!defined('TABLE_AUDITRESULT'))        define('TABLE_AUDITRESULT', '`' . $config->db->prefix . 'auditresult`');
if(!defined('TABLE_ACTIVITY'))           define('TABLE_ACTIVITY', '`' . $config->db->prefix . 'activity`');
if(!defined('TABLE_BUDGET'))             define('TABLE_BUDGET', '`' . $config->db->prefix . 'budget`');
if(!defined('TABLE_BASICMEAS'))          define('TABLE_BASICMEAS', '`' . $config->db->prefix . 'basicmeas`');
if(!defined('TABLE_CMCL'))               define('TABLE_CMCL', '`' . $config->db->prefix . 'cmcl`');
if(!defined('TABLE_DESIGN'))             define('TABLE_DESIGN', '`' . $config->db->prefix . 'design`');
if(!defined('TABLE_DESIGNSPEC'))         define('TABLE_DESIGNSPEC', '`' . $config->db->prefix . 'designspec`');
if(!defined('TABLE_DERIVEMEAS'))         define('TABLE_DERIVEMEAS', '`' . $config->db->prefix . 'derivemeas`');
if(!defined('TABLE_DURATIONESTIMATION')) define('TABLE_DURATIONESTIMATION', '`' . $config->db->prefix . 'durationestimation`');
if(!defined('TABLE_EFFORT'))             define('TABLE_EFFORT', '`' . $config->db->prefix . 'effort`');
if(!defined('TABLE_GAPANALYSIS'))        define('TABLE_GAPANALYSIS', '`' . $config->db->prefix . 'gapanalysis`');
if(!defined('TABLE_ISSUE'))              define('TABLE_ISSUE', '`' . $config->db->prefix . 'issue`');
if(!defined('TABLE_INTERVENTION'))       define('TABLE_INTERVENTION', '`' . $config->db->prefix . 'intervention`');
if(!defined('TABLE_MEASRECORDS'))        define('TABLE_MEASRECORDS', '`' . $config->db->prefix . 'measrecords`');
if(!defined('TABLE_MEASQUEUE'))          define('TABLE_MEASQUEUE', '`' . $config->db->prefix . 'measqueue`');
if(!defined('TABLE_MEASTEMPLATE'))       define('TABLE_MEASTEMPLATE', '`' . $config->db->prefix . 'meastemplate`');
if(!defined('TABLE_MEETING'))            define('TABLE_MEETING', '`' . $config->db->prefix . 'meeting`');
if(!defined('TABLE_MEETINGROOM'))        define('TABLE_MEETINGROOM', '`' . $config->db->prefix . 'meetingroom`');
if(!defined('TABLE_NC'))                 define('TABLE_NC', '`' . $config->db->prefix . 'nc`');
if(!defined('TABLE_OBJECT'))             define('TABLE_OBJECT', '`' . $config->db->prefix . 'object`');
if(!defined('TABLE_OPPORTUNITY'))        define('TABLE_OPPORTUNITY', '`' . $config->db->prefix . 'opportunity`');
if(!defined('TABLE_PROGRAMPROCESS'))     define('TABLE_PROGRAMPROCESS', '`' . $config->db->prefix . 'programprocess`');
if(!defined('TABLE_PROGRAMACTIVITY'))    define('TABLE_PROGRAMACTIVITY', '`' . $config->db->prefix . 'programactivity`');
if(!defined('TABLE_PROGRAMOUTPUT'))      define('TABLE_PROGRAMOUTPUT', '`' . $config->db->prefix . 'programoutput`');
if(!defined('TABLE_PROGRAMPLAN'))        define('TABLE_PROGRAMPLAN', '`'   . $config->db->prefix . 'programplan`');
if(!defined('TABLE_PROJECT'))            define('TABLE_PROJECT', '`' . $config->db->prefix . 'project`');
if(!defined('TABLE_PROCESS'))            define('TABLE_PROCESS', '`' . $config->db->prefix . 'process`');
if(!defined('TABLE_PROGRAMREPORT'))      define('TABLE_PROGRAMREPORT', '`' . $config->db->prefix . 'programreport`');
if(!defined('TABLE_RELATION'))           define('TABLE_RELATION', '`' . $config->db->prefix . 'relation`');
if(!defined('TABLE_REVIEW'))             define('TABLE_REVIEW', '`' . $config->db->prefix . 'review`');
if(!defined('TABLE_REVIEWCL'))           define('TABLE_REVIEWCL', '`' . $config->db->prefix . 'reviewcl`');
if(!defined('TABLE_REVIEWRESULT'))       define('TABLE_REVIEWRESULT', '`' . $config->db->prefix . 'reviewresult`');
if(!defined('TABLE_REVIEWISSUE'))        define('TABLE_REVIEWISSUE', '`' . $config->db->prefix . 'reviewissue`');
if(!defined('TABLE_RELATIONOFTASKS'))    define('TABLE_RELATIONOFTASKS', '`' . $config->db->prefix . 'relationoftasks`');
if(!defined('TABLE_RISK'))               define('TABLE_RISK', '`' . $config->db->prefix . 'risk`');
if(!defined('TABLE_STAGE'))              define('TABLE_STAGE', '`' . $config->db->prefix . 'stage`');
if(!defined('TABLE_SOLUTIONS'))          define('TABLE_SOLUTIONS', '`' . $config->db->prefix . 'solutions`');
if(!defined('TABLE_TASK'))               define('TABLE_TASK', '`' . $config->db->prefix . 'task`');
if(!defined('TABLE_TASKSPEC'))           define('TABLE_TASKSPEC', '`' . $config->db->prefix . 'taskspec`');
if(!defined('TABLE_TRAINPLAN'))          define('TABLE_TRAINPLAN', '`' . $config->db->prefix . 'trainplan`');
if(!defined('TABLE_WORKESTIMATION'))     define('TABLE_WORKESTIMATION', '`' . $config->db->prefix . 'workestimation`');
if(!defined('TABLE_ZOUTPUT'))            define('TABLE_ZOUTPUT', '`' . $config->db->prefix . 'zoutput`');
if(!defined('TABLE_RESEARCHPLAN'))       define('TABLE_RESEARCHPLAN', '`' . $config->db->prefix . 'researchplan`');
if(!defined('TABLE_RESEARCHREPORT'))     define('TABLE_RESEARCHREPORT', '`' . $config->db->prefix . 'researchreport`');
if(!defined('TABLE_ASSETLIB'))           define('TABLE_ASSETLIB', '`' . $config->db->prefix . 'assetlib`');
if(!defined('TABLE_APPROVAL'))           define('TABLE_APPROVAL', '`' . $config->db->prefix . 'approval`');
if(!defined('TABLE_APPROVALFLOW'))       define('TABLE_APPROVALFLOW', '`' . $config->db->prefix . 'approvalflow`');
if(!defined('TABLE_APPROVALFLOWSPEC'))   define('TABLE_APPROVALFLOWSPEC', '`' . $config->db->prefix . 'approvalflowspec`');
if(!defined('TABLE_APPROVALFLOWOBJECT')) define('TABLE_APPROVALFLOWOBJECT', '`' . $config->db->prefix . 'approvalflowobject`');
if(!defined('TABLE_APPROVALOBJECT'))     define('TABLE_APPROVALOBJECT', '`' . $config->db->prefix . 'approvalobject`');
if(!defined('TABLE_APPROVALNODE'))       define('TABLE_APPROVALNODE', '`' . $config->db->prefix . 'approvalnode`');
if(!defined('TABLE_APPROVALROLE'))       define('TABLE_APPROVALROLE', '`' . $config->db->prefix . 'approvalrole`');
if(!defined('TABLE_RISKISSUE'))          define('TABLE_RISKISSUE', '`' . $config->db->prefix . 'riskissue`');
if(!defined('TABLE_RULE'))               define('TABLE_RULE', '`' . $config->db->prefix . 'rule`');
if(!defined('TABLE_RULEQUEUE'))          define('TABLE_RULEQUEUE', '`' . $config->db->prefix . 'rulequeue`');
if(!defined('TABLE_TESTTASKPRODUCT'))    define('TABLE_TESTTASKPRODUCT', '`' . $config->db->prefix . 'testtaskproduct`');

$config->objectTables['auditcl']                = TABLE_AUDITCL;
$config->objectTables['review']                 = TABLE_REVIEW;
$config->objectTables['budget']                 = TABLE_BUDGET;
$config->objectTables['risk']                   = TABLE_RISK;
$config->objectTables['issue']                  = TABLE_ISSUE;
$config->objectTables['design']                 = TABLE_DESIGN;
$config->objectTables['opportunity']            = TABLE_OPPORTUNITY;
$config->objectTables['trainplan']              = TABLE_TRAINPLAN;
$config->objectTables['gapanalysis']            = TABLE_GAPANALYSIS;
$config->objectTables['reviewissue']            = TABLE_REVIEWISSUE;
$config->objectTables['researchplan']           = TABLE_RESEARCHPLAN;
$config->objectTables['researchreport']         = TABLE_RESEARCHREPORT;
$config->objectTables['meeting']                = TABLE_MEETING;
$config->objectTables['meetingroom']            = TABLE_MEETINGROOM;
$config->objectTables['assetlib']               = TABLE_ASSETLIB;
$config->objectTables['auditplan']              = TABLE_AUDITPLAN;
$config->objectTables['auditresult']            = TABLE_AUDITRESULT;
$config->objectTables['nc']                     = TABLE_NC;
$config->objectTables['pssp']                   = TABLE_PROJECT;
$config->objectTables['reviewcl']               = TABLE_REVIEWCL;
$config->objectTables['cmcl']                   = TABLE_CMCL;
$config->objectTables['process']                = TABLE_PROCESS;
$config->objectTables['activity']               = TABLE_ACTIVITY;
$config->objectTables['zoutput']                = TABLE_ZOUTPUT;
$config->objectTables['basicmeas']              = TABLE_BASICMEAS;
$config->objectTables['measurement']            = TABLE_BASICMEAS;
$config->objectTables['sqlview']                = TABLE_SQLVIEW;
$config->objectTables['approvalnode']           = TABLE_APPROVALNODE;
$config->objectTables['rule']                   = TABLE_RULE;
$config->objectTables['baseline']               = TABLE_OBJECT;
$config->objectTables['reporttemplate']         = TABLE_DOC;
$config->objectTables['reporttemplatecategory'] = TABLE_MODULE;
$config->objectTables['weekly']                 = TABLE_DOC;
$config->objectTables['reportcategory']         = TABLE_MODULE;
$config->objectTables['projectdeliverable']     = TABLE_PROJECTDELIVERABLE;

$config->projectModules = 'story,product,bug,task,project,flow,repo,productplan,release,testcase,testtask,testreport,testsuite,deploy,doc';

$filter->assetlib = new stdclass();
$filter->assetlib->story = new stdclass();
$filter->assetlib->story->cookie['storyViewType'] = 'code';

$filter->project->burn = new stdclass();
$filter->project->burn->cookie['burnBy'] = 'code';

if(!isset($filter->project->default)) $filter->project->default = new stdclass();
$filter->project->default->cookie['copyData'] = 'reg::any';

$filter->product->burn = new stdclass();
$filter->product->burn->cookie['leftProjects'] = 'code';

$config->excludeFlows = array();

$config->hourPointCommonList['zh-cn'][2] = '功能点';
$config->hourPointCommonList['zh-tw'][2] = '功能點';
$config->hourPointCommonList['en'][2]    = 'function point';
$config->hourPointCommonList['de'][2]    = 'function point';
$config->hourPointCommonList['fr'][2]    = 'function point';

$config->hourPointCommonList['zh-cn'][3] = '代码行';
$config->hourPointCommonList['zh-tw'][3] = '代码行';
$config->hourPointCommonList['en'][3]    = 'loc';
$config->hourPointCommonList['de'][3]    = 'loc';
$config->hourPointCommonList['fr'][3]    = 'loc';

if(!isset($filter->custom)) $filter->custom = new stdclass();
$filter->custom->setcmmi = new stdclass();
$filter->custom->setcmmi->cookie['systemModel'] = 'code';
$filter->custom->setscrum = new stdclass();
$filter->custom->setscrum->cookie['sytemModel'] = 'code';

$filter->risk                = new stdclass();
$filter->opportunity         = new stdclass();
$filter->product->submit     = new stdclass();
$filter->story->submit       = new stdclass();
$filter->testcase->submit    = new stdclass();
$filter->risk->export        = new stdclass();
$filter->opportunity->export = new stdclass();
$filter->default->cookie['hideMenu']                = 'equal::true';
$filter->product->submit->cookie['checkedItem']     = 'reg::checked';
$filter->story->submit->cookie['checkedItem']       = 'reg::checked';
$filter->testcase->submit->cookie['checkedItem']    = 'reg::any';
$filter->risk->export->cookie['checkedItem']        = 'reg::checked';
$filter->opportunity->export->cookie['checkedItem'] = 'reg::checked';

$filter->issue = new stdclass();
$filter->issue->export = new stdclass();
$filter->issue->export->cookie['checkedItem'] = 'reg::checked';

$filter->activity = new stdclass();
$filter->activity->create      = new stdclass();
$filter->activity->batchcreate = new stdclass();
$filter->activity->create->cookie['pagerActivityBrowse']      = 'int';
$filter->activity->batchcreate->cookie['pagerActivityBrowse'] = 'int';

$filter->my->work->cookie['pagerMyIssue']     = 'int';
$filter->my->work->cookie['pagerMyRisk']      = 'int';
$filter->my->work->cookie['pagerMyAudit']     = 'int';
$filter->my->work->cookie['pagerMyMymeeting'] = 'int';

$filter->my->contribute->cookie['pagerMyIssue'] = 'int';
$filter->my->contribute->cookie['pagerMyRisk']  = 'int';
$filter->my->contribute->cookie['pagerMyAudit'] = 'int';

$filter->weekly = new stdclass();
$filter->weekly->browse = new stdclass();
$filter->weekly->browse->cookie['weeklyModule'] = 'reg::word';
$filter->weekly->browse->cookie['preProjectID'] = 'int';

/* 登录用户可以访问的方法。The methods that can be accessed by the logged users. */
$config->logonMethods[] = 'project.copyconfirm';
$config->logonMethods[] = 'project.copyproject';
$config->logonMethods[] = 'assetlib.view';
$config->logonMethods[] = 'approval.revert';
$config->logonMethods[] = 'approval.addnode';
$config->logonMethods[] = 'approval.forward';
$config->logonMethods[] = 'review.book';
$config->logonMethods[] = 'doc.selecttemplate';
$config->logonMethods[] = 'rulequeue.run';
$config->logonMethods[] = 'baseline.view';
$config->logonMethods[] = 'weekly.index';
$config->logonMethods[] = 'weekly.addcategory';
$config->logonMethods[] = 'weekly.editcategory';
$config->logonMethods[] = 'weekly.deletecategory';
$config->logonMethods[] = 'weekly.exportweeklyreport';

/* Ajax 方法依赖的方法。The methods that Ajax methods depend on. */
$config->ajaxDependencies['activity.ajaxupdateorder']                        = 'activity.browse';
$config->ajaxDependencies['auditcl.ajaxgetactivities']                       = 'auditcl.edit';
$config->ajaxDependencies['auditplan.ajaxcreatecycleauditplan']              = '';
$config->ajaxDependencies['baseline.ajaxgetcontent']                         = 'doc.create';
$config->ajaxDependencies['baseline.ajaxgetdocs']                            = 'review.create';
$config->ajaxDependencies['baseline.ajaxgettemplates']                       = ['review.create', 'doc.create'];
$config->ajaxDependencies['cm.ajaxgetproduct']                               = ['cm.create', 'cm.edit'];
$config->ajaxDependencies['cm.ajaxgetreviews']                               = ['cm.create', 'cm.edit'];
$config->ajaxDependencies['deliverable.ajaxgetactivityoptional']             = ['deliverable.create', 'deliverable.edit'];
$config->ajaxDependencies['deliverable.ajaxgetactivityoptions']              = 'deliverable.create';
$config->ajaxDependencies['doc.ajaxgetdeliverabledocs']                      = ['deliverable.create', 'deliverable.edit'];
$config->ajaxDependencies['doc.ajaxgetdocs']                                 = 'review.create';
$config->ajaxDependencies['doc.ajaxgetlinkedproducts']                       = 'doc.buildzentaoconfig';
$config->ajaxDependencies['doc.ajaxgettemplatedocs']                         = ['deliverable.create', 'deliverable.edit'];
$config->ajaxDependencies['durationestimation.ajaxgetduration']              = 'durationestimation.create';
$config->ajaxDependencies['execution.ajaxautoschedulefortask']               = 'execution.gantt';
$config->ajaxDependencies['execution.ajaxgetattribute']                      = 'task.edit';
$config->ajaxDependencies['execution.ajaxgetprojectexecutions']              = ['meeting.create', 'meeting.edit'];
$config->ajaxDependencies['issue.ajaxgetexecutions']                         = 'issue.bugform';
$config->ajaxDependencies['issue.ajaxgetprojectissues']                      = 'risk.edit';
$config->ajaxDependencies['issue.ajaxgetresolveform']                        = 'issue.resolve';
$config->ajaxDependencies['issue.ajaxgetuserissues']                         = ['todo.create', 'todo.edit', 'todo.batchcreate'];
$config->ajaxDependencies['measurement.ajaxbuildparamform']                  = 'measurement.paramformmodal';
$config->ajaxDependencies['measurement.ajaxbuildsql']                        = 'measurement.designsql';
$config->ajaxDependencies['measurement.ajaxcheckelementneedparams']          = 'measurement.paramformmodal';
$config->ajaxDependencies['measurement.ajaxgetmoduleactions']                = 'measurement.createcollectconf';
$config->ajaxDependencies['measurement.ajaxgetparamcontrol']                 = ['measurement.design', 'measurement.setsqlparams', 'measurement.setsql'];
$config->ajaxDependencies['measurement.ajaxsetparams']                       = ['measurement.setparams', 'measurement.view'];
$config->ajaxDependencies['meeting.ajaxgetcontactusers']                     = ['meeting.create', 'meeting.edit'];
$config->ajaxDependencies['meeting.ajaxgetobjects']                          = ['meeting.create', 'meeting.edit'];
$config->ajaxDependencies['meeting.ajaxgetteammembers']                      = ['meeting.create', 'meeting.edit'];
$config->ajaxDependencies['milestone.ajaxaddmeasures']                       = ['milestone.rectifying', 'milestone.index'];
$config->ajaxDependencies['milestone.ajaxsaveestimate']                      = 'milestone.index';
$config->ajaxDependencies['my.ajaxgetproject']                               = 'my.review';
$config->ajaxDependencies['nc.ajaxgetauditplan']                             = 'nc.create';
$config->ajaxDependencies['nc.ajaxgetchecklist']                             = 'nc.create';
$config->ajaxDependencies['opportunity.ajaxgetuseropportunities']            = ['todo.create', 'todo.edit', 'todo.batchcreate'];
$config->ajaxDependencies['process.ajaxupdateorder']                         = 'process.browse';
$config->ajaxDependencies['project.ajaxautoschedulefortask']                 = 'programplan.browse';
$config->ajaxDependencies['project.ajaxcheckdataandgetlink']                 = ['project.deliverable', 'project.closuredeliverable'];
$config->ajaxDependencies['project.ajaxgenerateschedule']                    = 'programplan.browse';
$config->ajaxDependencies['project.ajaxgetprojects']                         = 'project.create';
$config->ajaxDependencies['project.ajaxgetschedule']                         = 'programplan.browse';
$config->ajaxDependencies['project.ajaxloadproject']                         = 'project.create';
$config->ajaxDependencies['project.ajaxsavetaskschedule']                    = ['execution.gantt', 'programplan.browse'];
$config->ajaxDependencies['reporttemplate.ajaxbuildzentaochartconfig']       = ['reporttemplate.ajaxzentaochart', 'reporttemplate.browse', 'weekly.docviewer'];
$config->ajaxDependencies['reporttemplate.ajaxbuildzentaolistconfig']        = ['reporttemplate.browse', 'weekly.docviewer'];
$config->ajaxDependencies['reporttemplate.ajaxbuildzentaomeasurementconfig'] = ['reporttemplate.browse', 'weekly.docviewer'];
$config->ajaxDependencies['reporttemplate.ajaxcheckdeletecategory']          = 'reporttemplate.browse';
$config->ajaxDependencies['reporttemplate.ajaxgetdata']                      = 'reporttemplate.browse';
$config->ajaxDependencies['reporttemplate.ajaxgetdoc']                       = 'reporttemplate.browse';
$config->ajaxDependencies['reporttemplate.ajaxsetbasic']                     = 'reporttemplate.browse';
$config->ajaxDependencies['reporttemplate.ajaxzentaochart']                  = ['reporttemplate.browse', 'weekly.docviewer'];
$config->ajaxDependencies['researchplan.ajaxgetplaninfo']                    = ['researchreport.create', 'researchreport.edit'];
$config->ajaxDependencies['review.ajaxcheckreviewinfo']                      = ['review.create', 'review.edit', 'my.audit'];
$config->ajaxDependencies['review.ajaxgetapproval']                          = ['review.createflow', 'review.editflow', 'project.editapproval', 'stage.setpoint'];
$config->ajaxDependencies['review.ajaxgetdeliverables']                      = 'review.create';
$config->ajaxDependencies['review.ajaxgetnodes']                             = ['review.submit', 'review.create'];
$config->ajaxDependencies['review.ajaxgetuserreviews']                       = ['todo.create', 'todo.edit', 'todo.batchcreate'];
$config->ajaxDependencies['reviewissue.ajaxgetcategory']                     = 'reviewissue.create';
$config->ajaxDependencies['reviewissue.ajaxgetcheck']                        = 'reviewissue.create';
$config->ajaxDependencies['reviewissue.ajaxgetinjection']                    = 'reviewissue.create';
$config->ajaxDependencies['reviewissue.ajaxgetreview']                       = 'reviewissue.issue';
$config->ajaxDependencies['risk.ajaxgetprojectrisks']                        = 'issue.edit';
$config->ajaxDependencies['risk.ajaxgetuserrisks']                           = ['todo.create', 'todo.edit', 'todo.batchcreate'];
$config->ajaxDependencies['story.ajaxgetdesign']                             = ['task.create', 'task.edit'];
$config->ajaxDependencies['story.ajaxgetsourcenote']                         = ['story.batchcreate', 'story.batchedit'];
$config->ajaxDependencies['task.ajaxchecktaskdate']                          = 'task.autoschedule';
$config->ajaxDependencies['task.ajaxmanualschedule']                         = 'execution.gantt';
$config->ajaxDependencies['weekly.ajaxcheckdeletecategory']                  = 'weekly.browse';
$config->ajaxDependencies['weekly.ajaxgetmeasurement']                       = 'weekly.docviewer';
$config->ajaxDependencies['weekly.ajaxgetreport']                            = 'weekly.docviewer';
$config->ajaxDependencies['weekly.ajaxrefreshdata']                          = 'weekly.docviewer';
$config->ajaxDependencies['weekly.ajaxselecttemplate']                       = ['weekly.browse', 'weekly.ajaxselecttemplate'];
$config->ajaxDependencies['weekly.ajaxsetbasic']                             = 'weekly.docviewer';
$config->ajaxDependencies['weekly.ajaxsetcontent']                           = 'weekly.docviewer';
$config->ajaxDependencies['workflowgroup.ajaxgetdeliverable']                = 'workflowgroup.deliverable';

if($config->edition == 'max' || $config->edition == 'ipd')
{
    $config->featureGroup->project  = array_merge($config->featureGroup->project,  array('gapanalysis','track', 'deliverable', 'cm', 'change', 'issue', 'risk', 'opportunity', 'process', 'auditplan', 'researchplan', 'meeting', 'workestimation'));
    $config->featureGroup->assetlib = array_merge($config->featureGroup->assetlib, array('storylib', 'issuelib', 'risklib', 'opportunitylib', 'practicelib', 'componentlib'));
}

$config->excludeDropmenuList[] = 'reporttemplate-browse';
$config->excludeDropmenuList[] = 'reporttemplate-edit';
$config->excludeDropmenuList[] = 'reporttemplate-view';
