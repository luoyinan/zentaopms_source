<?php
$lang->moduleOrder[114] = 'dataview';
$lang->moduleOrder[115] = 'dimension';
$lang->moduleOrder[116] = 'metriclib';

global $app, $config;
/* Feedback */
$lang->resource->feedback = new stdclass();
$lang->resource->feedback->create            = 'create';
$lang->resource->feedback->batchCreate       = 'batchCreate';
$lang->resource->feedback->edit              = 'edit';
$lang->resource->feedback->editOthers        = 'editOthers';
if($config->vision == 'lite') $lang->resource->feedback->view   = 'view';
if($config->vision == 'lite') $lang->resource->feedback->browse = 'browse';
if($config->vision == 'rnd') $lang->resource->feedback->adminView = 'adminView';
if($config->vision == 'rnd') $lang->resource->feedback->admin     = 'admin';
$lang->resource->feedback->assignTo          = 'assignAction';
$lang->resource->feedback->toTask            = 'toTask';
$lang->resource->feedback->toTodo            = 'toTodo';
$lang->resource->feedback->toBug             = 'toBug';
$lang->resource->feedback->toStory           = 'toStory';
$lang->resource->feedback->toTicket          = 'toTicket';
if($config->URAndSR)  $lang->resource->feedback->toUserStory = 'toUserStory';
if($config->enableER) $lang->resource->feedback->toEpic      = 'toEpic';
$lang->resource->feedback->review            = 'reviewAction';
$lang->resource->feedback->comment           = 'comment';
$lang->resource->feedback->reply             = 'reply';
$lang->resource->feedback->ask               = 'ask';
$lang->resource->feedback->close             = 'closeAction';
$lang->resource->feedback->delete            = 'delete';
$lang->resource->feedback->activate          = 'activate';
$lang->resource->feedback->export            = 'exportAction';
$lang->resource->feedback->batchEdit         = 'batchEdit';
$lang->resource->feedback->batchClose        = 'batchClose';
$lang->resource->feedback->batchReview       = 'batchReview';
$lang->resource->feedback->batchAssignTo     = 'batchAssignTo';
$lang->resource->feedback->products          = 'products';
$lang->resource->feedback->manageProduct     = 'manageProduct';
$lang->resource->feedback->import            = 'import';
$lang->resource->feedback->exportTemplate    = 'exportTemplate';
$lang->resource->feedback->syncProduct       = 'syncProduct';
$lang->resource->feedback->productSetting    = 'productSetting';

/* Faq. */
$lang->resource->faq = new stdclass();
$lang->resource->faq->browse = 'browse';
$lang->resource->faq->create = 'create';
$lang->resource->faq->edit   = 'edit';
$lang->resource->faq->delete = 'delete';

$lang->resource->ticket = new stdclass();
$lang->resource->ticket->create         = 'create';
$lang->resource->ticket->edit           = 'edit';
$lang->resource->ticket->view           = 'view';
$lang->resource->ticket->browse         = 'browse';
$lang->resource->ticket->assignTo       = 'assign';
$lang->resource->ticket->createBug      = 'createBug';
$lang->resource->ticket->createStory    = 'createStory';
$lang->resource->ticket->start          = 'start';
$lang->resource->ticket->finish         = 'finish';
$lang->resource->ticket->close          = 'close';
$lang->resource->ticket->activate       = 'activate';
$lang->resource->ticket->delete         = 'delete';
$lang->resource->ticket->exportTemplate = 'exportTemplate';
$lang->resource->ticket->import         = 'import';
$lang->resource->ticket->export         = 'exportAction';
$lang->resource->ticket->batchCreate    = 'batchCreate';
$lang->resource->ticket->batchEdit      = 'batchEdit';
$lang->resource->ticket->batchActivate  = 'batchActivate';
$lang->resource->ticket->batchFinish    = 'batchFinish';
$lang->resource->ticket->batchClose     = 'batchClose';
$lang->resource->ticket->batchAssignTo  = 'batchAssignTo';
$lang->resource->ticket->syncProduct    = 'syncProduct';

$lang->resource->feedbackpriv = new stdclass();

$lang->resource->custom->libreoffice = 'libreOffice';

$lang->resource->custom->browserelation    = 'browseRelation';
$lang->resource->custom->createrelation    = 'createRelation';
$lang->resource->custom->editrelation      = 'editRelation';
$lang->resource->custom->deleterelation    = 'deleteRelation';
$lang->resource->custom->relateObject      = 'relateObject';
$lang->resource->custom->removeObjects     = 'removeObjects';
$lang->resource->custom->showRelationGraph = 'relationGraph';
$lang->resource->custom->setCharterInfo    = 'setCharterInfo';
$lang->resource->custom->resetCharterInfo  = 'resetCharterInfo';

$lang->custom->methodOrder[120] = 'browseRelation';
$lang->custom->methodOrder[121] = 'createRelation';
$lang->custom->methodOrder[122] = 'editRelation';
$lang->custom->methodOrder[123] = 'deleteRelation';
$lang->custom->methodOrder[124] = 'relateObject';
$lang->custom->methodOrder[125] = 'removeObjects';
$lang->custom->methodOrder[126] = 'showRelationGraph';
$lang->custom->methodOrder[127] = 'setCharterInfo';
$lang->custom->methodOrder[128] = 'resetCharterInfo';

$lang->group->package->relateObject = $lang->relateObject->common;
$lang->group->package->relation     = $lang->relation->common;
$lang->group->package->charter      = $lang->charter->common;

/* User */
$lang->resource->user->export         = 'export';
$lang->resource->user->exportTemplate = 'exportTemplate';

$lang->user->methodOrder[90] = 'export';
$lang->user->methodOrder[95] = 'exportTemplate';

$lang->resource->officeapproval = new stdclass();
$lang->resource->officesetting  = new stdclass();
$lang->resource->datapermission = new stdclass();
$lang->resource->officeexport   = new stdclass();

/* Ops */
$lang->resource->tree->browsegroup = 'browsegroup';

$lang->resource->project->workflowGroup = 'workflowGroup';
$lang->resource->project->exportChart   = 'exportChart';

$lang->resource->task->exportChart = 'exportChart';

$lang->resource->testtask->runDeployCase     = 'runDeployCase';
$lang->resource->testtask->deployCaseResults = 'deployCaseResults';

//$lang->resource->doc->diff             = 'diffAction';
$lang->resource->doc->mine2export      = 'mine2export';
$lang->resource->doc->product2export   = 'product2export';
$lang->resource->doc->project2export   = 'project2export';
$lang->resource->doc->custom2export    = 'custom2export';
$lang->resource->doc->execution2export = 'execution2export';

$lang->resource->conference = new stdclass();
$lang->resource->conference->admin = 'admin';

$lang->resource->watermark = new stdclass();
$lang->resource->watermark->index = 'index';

/* Train Course. */
$lang->resource->traincourse = new stdclass();
$lang->resource->traincourse->browse      = 'browseAction';
$lang->resource->traincourse->viewCourse  = 'viewCourse';
$lang->resource->traincourse->viewChapter = 'viewChapter';
$lang->resource->traincourse->admin       = 'adminAction';
/*
$lang->resource->traincourse->browseCategory = 'browseCategory';
$lang->resource->traincourse->categoryChildren = 'categoryChildren';
$lang->resource->traincourse->editCategory = 'editCategory';
$lang->resource->traincourse->deleteCategory = 'deleteCategory';
$lang->resource->traincourse->createCourse = 'createCourse';
$lang->resource->traincourse->editCourse = 'editCourse';
$lang->resource->traincourse->manageCourse = 'manageCourse';
 */

$lang->resource->traincourse->deleteCourse = 'deleteCourse';
$lang->resource->traincourse->changeStatus = 'changeStatus';

/*
$lang->resource->traincourse->manageChapter = 'manageChapter';
$lang->resource->traincourse->editChapter = 'editChapter';
$lang->resource->traincourse->deleteChapter = 'deleteChapter';
 */

$lang->resource->traincourse->uploadCourse = 'uploadCourse';
$lang->resource->traincourse->batchImport  = 'batchImport';
$lang->resource->traincourse->cloudImport  = 'cloudImport';

$lang->resource->traincourse->practice       = 'practiceAction';
$lang->resource->traincourse->practiceBrowse = 'practiceBrowse';
$lang->resource->traincourse->practiceView   = 'practiceView';
$lang->resource->traincourse->updatePractice = 'updatePractice';

$lang->traincourse->methodOrder[5]   = 'browse';
$lang->traincourse->methodOrder[10]  = 'viewcourse';
$lang->traincourse->methodOrder[15]  = 'viewchapter';
$lang->traincourse->methodOrder[20]  = 'practice';
$lang->traincourse->methodOrder[25]  = 'practiceBrowse';
$lang->traincourse->methodOrder[30]  = 'practiceView';
$lang->traincourse->methodOrder[35]  = 'updatePractice';
$lang->traincourse->methodOrder[40]  = 'admin';
$lang->traincourse->methodOrder[45]  = 'browseCategory';
$lang->traincourse->methodOrder[50]  = 'categoryChildren';
$lang->traincourse->methodOrder[55]  = 'editCategory';
$lang->traincourse->methodOrder[60]  = 'deleteCategory';
$lang->traincourse->methodOrder[65]  = 'createCourse';
$lang->traincourse->methodOrder[70]  = 'editCourse';
$lang->traincourse->methodOrder[75]  = 'manageCourse';
$lang->traincourse->methodOrder[80]  = 'deleteCourse';
$lang->traincourse->methodOrder[85]  = 'changeStatus';
$lang->traincourse->methodOrder[90]  = 'manageChapter';
$lang->traincourse->methodOrder[95]  = 'editChapter';
$lang->traincourse->methodOrder[100] = 'deleteChapter';
$lang->traincourse->methodOrder[105] = 'uploadCourse';
$lang->traincourse->methodOrder[110] = 'batchImport';
$lang->traincourse->methodOrder[115] = 'cloudImport';

$lang->resource->api->export = 'export';

$lang->resource->dimension = new stdclass();
$lang->resource->dimension->browse = 'browse';
$lang->resource->dimension->create = 'create';
$lang->resource->dimension->edit   = 'edit';
$lang->resource->dimension->delete = 'delete';

$lang->dimension->methodOrder[0]  = 'browse';
$lang->dimension->methodOrder[5]  = 'create';
$lang->dimension->methodOrder[10] = 'edit';
$lang->dimension->methodOrder[15] = 'delete';

if(helper::hasFeature('BI'))
{
    $lang->resource->screen->create  = 'create';
    $lang->resource->screen->edit    = 'editScreen';
    $lang->resource->screen->design  = 'designScreen';
    $lang->resource->screen->publish = 'publishScreen';
    $lang->resource->screen->delete  = 'deleteScreen';

    $lang->screen->methodOrder[6]  = 'create';
    $lang->screen->methodOrder[7]  = 'edit';
    $lang->screen->methodOrder[8]  = 'design';
    $lang->screen->methodOrder[9]  = 'publish';
    $lang->screen->methodOrder[10] = 'delete';

    $lang->resource->pivot->browse            = 'browseAction';
    $lang->resource->pivot->preview           = 'preview';
    $lang->resource->pivot->create            = 'create';
    $lang->resource->pivot->edit              = 'edit';
    $lang->resource->pivot->design            = 'design';
    $lang->resource->pivot->delete            = 'delete';
    $lang->resource->pivot->export            = 'export';
    $lang->resource->pivot->showProduct       = 'showProduct';
    $lang->resource->pivot->showProject       = 'showProject';
    $lang->resource->pivot->projectDeviation  = 'projectDeviation';
    $lang->resource->pivot->productSummary    = 'productSummary';
    $lang->resource->pivot->bugCreate         = 'bugCreate';
    $lang->resource->pivot->bugAssign         = 'bugAssign';
    $lang->resource->pivot->workload          = 'workload';
    $lang->resource->pivot->casesrun          = 'casesrun';
    $lang->resource->pivot->storyLinkedBug    = 'storyLinkedBug';
    $lang->resource->pivot->testcase          = 'testcase';
    $lang->resource->pivot->build             = 'build';
    $lang->resource->pivot->workSummary       = 'workSummary';
    $lang->resource->pivot->roadmap           = 'roadmap';
    $lang->resource->pivot->productInvest     = 'productInvest';
    $lang->resource->pivot->bugSummary        = 'bugSummary';
    $lang->resource->pivot->bugAssignSummary  = 'bugAssignSummary';
    $lang->resource->pivot->workAssignSummary = 'workAssignSummary';
    if(!helper::hasFeature('product_roadmap')) unset($lang->resource->pivot->roadmap);

    $lang->pivot->methodOrder[1]  = 'browse';
    $lang->pivot->methodOrder[2]  = 'preview';
    $lang->pivot->methodOrder[3]  = 'create';
    $lang->pivot->methodOrder[4]  = 'edit';
    $lang->pivot->methodOrder[5]  = 'design';
    $lang->pivot->methodOrder[6]  = 'delete';
    $lang->pivot->methodOrder[7]  = 'export';
    $lang->pivot->methodOrder[8]  = 'showProduct';
    $lang->pivot->methodOrder[9]  = 'showProject';
    $lang->pivot->methodOrder[10] = 'projectDeviation';
    $lang->pivot->methodOrder[11] = 'productSummary';
    $lang->pivot->methodOrder[12] = 'bugCreate';
    $lang->pivot->methodOrder[13] = 'bugAssign';
    $lang->pivot->methodOrder[14] = 'workload';
    $lang->pivot->methodOrder[15] = 'casesrun';
    $lang->pivot->methodOrder[16] = 'storyLinkedBug';
    $lang->pivot->methodOrder[17] = 'testcase';
    $lang->pivot->methodOrder[18] = 'build';
    $lang->pivot->methodOrder[19] = 'workSummary';
    $lang->pivot->methodOrder[20] = 'roadmap';
    $lang->pivot->methodOrder[21] = 'productInvest';
    $lang->pivot->methodOrder[22] = 'bugSummary';
    $lang->pivot->methodOrder[23] = 'bugAssignSummary';
    $lang->pivot->methodOrder[24] = 'workAssignSummary';
    $lang->pivot->methodOrder[25] = 'roadmap';

    $lang->resource->chart->browse  = 'browseAction';
    $lang->resource->chart->preview = 'preview';
    $lang->resource->chart->create  = 'create';
    $lang->resource->chart->edit    = 'edit';
    $lang->resource->chart->design  = 'design';
    $lang->resource->chart->delete  = 'delete';
    $lang->resource->chart->export  = 'export';

    $lang->chart->methodOrder[0]  = 'browse';
    $lang->chart->methodOrder[5]  = 'preview';
    $lang->chart->methodOrder[10] = 'create';
    $lang->chart->methodOrder[15] = 'edit';
    $lang->chart->methodOrder[20] = 'design';
    $lang->chart->methodOrder[25] = 'delete';
    $lang->chart->methodOrder[30] = 'export';

    $lang->resource->dataview = new stdclass();
    $lang->resource->dataview->browse = 'browsePriv';
    $lang->resource->dataview->create = 'createPriv';
    $lang->resource->dataview->edit   = 'editPriv';
    $lang->resource->dataview->query  = 'designPriv';
    $lang->resource->dataview->delete = 'deletePriv';
    $lang->resource->dataview->export = 'export';

    $lang->resource->metriclib = new stdclass();
    $lang->resource->metriclib->browse  = 'browse';
    $lang->resource->metriclib->details = 'libraryDetails';

    $lang->metriclib->methodOrder[10] = 'browse';

    $lang->resource->metric->browse      = 'browse';
    $lang->resource->metric->create      = 'create';
    $lang->resource->metric->edit        = 'edit';
    $lang->resource->metric->view        = 'view';
    $lang->resource->metric->implement   = 'implementAction';
    $lang->resource->metric->delist      = 'delistAction';
    $lang->resource->metric->delete      = 'deleteAction';
    $lang->resource->metric->details     = 'detailsAction';
    $lang->resource->metric->recalculate = 'recalculateAction';

    $lang->metric->methodOrder[10] = 'browse';
    $lang->metric->methodOrder[15] = 'create';
    $lang->metric->methodOrder[20] = 'edit';
    $lang->metric->methodOrder[25] = 'view';
    $lang->metric->methodOrder[30] = 'implement';
    $lang->metric->methodOrder[35] = 'delist';
    $lang->metric->methodOrder[40] = 'delete';
    $lang->metric->methodOrder[40] = 'recalculate';
}

$lang->resource->product->exportTrack = 'exportTrack';
$lang->product->methodOrder[] = 'exportTrack';

$lang->resource->projectstory->exportTrack = 'exportTrack';
$lang->projectstory->methodOrder[] = 'exportTrack';

$inUpgrade = (defined('IN_UPGRADE') and IN_UPGRADE);
if(!$inUpgrade)
{
    if(!helper::hasFeature('devops'))
    {
        unset($lang->resource->deploy);
        unset($lang->resource->host);
        unset($lang->resource->vm);
        unset($lang->resource->serverroom);
        unset($lang->resource->account);
        unset($lang->resource->ops);
    }
    if(!helper::hasFeature('traincourse')) unset($lang->resource->traincourse);
}

unset($lang->resource->workflowrule->view);

$lang->resource->charter = new stdclass();
$lang->resource->charter->browse                  = 'browse';
$lang->resource->charter->create                  = 'create';
$lang->resource->charter->edit                    = 'editAction';
$lang->resource->charter->view                    = 'view';
$lang->resource->charter->delete                  = 'deleteAction';
$lang->resource->charter->review                  = 'approval';
$lang->resource->charter->approvalcancel          = 'approvalCancelAction';
$lang->resource->charter->close                   = 'closeAction';
$lang->resource->charter->projectApproval         = 'projectApproval';
$lang->resource->charter->completionApproval      = 'completionApproval';
$lang->resource->charter->cancelProjectApproval   = 'cancelProjectApproval';
$lang->resource->charter->activateProjectApproval = 'activateProjectApproval';
$lang->resource->charter->approvalProgress        = 'approvalProgressAction';

if($config->systemMode == 'light' || ($config->vision == 'rnd' && $config->edition != 'ipd' && !helper::hasFeature('program')))
{
    unset($lang->resource->charter);
    unset($lang->resource->custom->setCharterInfo, $lang->resource->custom->resetCharterInfo);
}

$lang->resource->approvalflow = new stdclass();
$lang->resource->approvalflow->browse     = 'browse';
$lang->resource->approvalflow->view       = 'view';
$lang->resource->approvalflow->design     = 'design';
$lang->resource->approvalflow->role       = 'roleList';
$lang->resource->approvalflow->createRole = 'createRole';
$lang->resource->approvalflow->editRole   = 'editRole';
$lang->resource->approvalflow->deleteRole = 'deleteRole';

$lang->resource->project->executionreport = 'executionReport';
$lang->resource->project->reportBug       = 'reportBug';

$lang->resource->testcase->report = 'reportAction';

$lang->resource->execution->reportBug = 'reportBug';

if(helper::hasFeature('AI'))
{
    $lang->resource->ai->createPrompt           = 'promptCreate';
    $lang->resource->ai->promptEdit             = 'promptEdit';
    $lang->resource->ai->promptDelete           = 'promptDelete';
    $lang->resource->ai->designPrompt           = 'designPrompt';
    $lang->resource->ai->roleTemplates          = 'roleTemplates';
    $lang->resource->ai->myknowledgelib         = 'browseMyknowledgeLib';
    $lang->resource->ai->teamknowledgelib       = 'browseTeamknowledgeLib';
    $lang->resource->ai->createknowledgelib     = 'createKnowledgelibAction';
    $lang->resource->ai->importfromdoc          = 'importFromDocAction';
    $lang->resource->ai->importfromasset        = 'importFromAssetAction';
    $lang->resource->ai->editknowledgelib       = 'editKnowledgelibAction';
    $lang->resource->ai->publishknowledgelib    = 'publishKnowledgelibAction';
    $lang->resource->ai->unpublishknowledgelib  = 'unpublishKnowledgelibAction';
    $lang->resource->ai->deleteknowledgelib     = 'deleteKnowledgelibAction';
    $lang->resource->ai->searchknowledgelib     = 'searchKnowledgelibAction';
    $lang->resource->ai->aichatwithknowledgelib = 'aiChatWithKnowledgeLib';
    $lang->resource->ai->createknowledge        = 'createKnowledgeAction';
    $lang->resource->ai->deleteknowledgeitem    = 'deleteKnowledgeAction';
    $lang->resource->ai->editknowledge          = 'editKnowledgeAction';
}
if(!helper::hasFeature('BI')) unset($lang->resource->tree->browsegroup);
