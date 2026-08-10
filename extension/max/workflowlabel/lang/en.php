<?php
$lang->workflowlabel->common   = 'Workflow Label';
$lang->workflowlabel->browse   = 'Labels';
$lang->workflowlabel->create   = 'Create Label';
$lang->workflowlabel->edit     = 'Edit Label';
$lang->workflowlabel->delete   = 'Delete Label';
$lang->workflowlabel->sort     = 'Sort Label';
$lang->workflowlabel->search   = 'Search';
$lang->workflowlabel->settings = 'List and attribute settings';

$lang->workflowlabel->id          = 'ID';
$lang->workflowlabel->module      = 'Module';
$lang->workflowlabel->label       = 'Label';
$lang->workflowlabel->params      = 'Params';
$lang->workflowlabel->type        = 'Condition Type';
$lang->workflowlabel->sql         = 'SQL Condition';
$lang->workflowlabel->order       = 'Order';
$lang->workflowlabel->orderBy     = 'Data Order';
$lang->workflowlabel->buildin     = 'Build-in';
$lang->workflowlabel->createdBy   = 'Created By';
$lang->workflowlabel->createdDate = 'Created';
$lang->workflowlabel->editedBy    = 'Edited By';
$lang->workflowlabel->editedDate  = 'Edited';

$lang->workflowlabel->operatorList['equal']      = '=';
$lang->workflowlabel->operatorList['notequal']   = '!=';
$lang->workflowlabel->operatorList['gt']         = '>';
$lang->workflowlabel->operatorList['ge']         = '>=';
$lang->workflowlabel->operatorList['lt']         = '<';
$lang->workflowlabel->operatorList['le']         = '<=';
$lang->workflowlabel->operatorList['include']    = 'include';
$lang->workflowlabel->operatorList['notinclude'] = 'exclude';
$lang->workflowlabel->operatorList['between']    = 'between';

$lang->workflowlabel->typeList['data'] = 'Define conditions by data';
$lang->workflowlabel->typeList['sql']  = 'Define conditions by SQL';

$lang->workflowlabel->orderTypeList['asc']  = 'Ascending';
$lang->workflowlabel->orderTypeList['desc'] = 'Descending';

$lang->workflowlabel->buildinList['0'] = 'No';
$lang->workflowlabel->buildinList['1'] = 'Yes';

$lang->workflowlabel->confirmDelete = 'Are you sure you want to perform the deletion operation?';

$lang->workflowlabel->default = new stdclass();
$lang->workflowlabel->default->labels['all'] = 'All';

$lang->workflowlabel->approval = new stdclass();
$lang->workflowlabel->approval->labels['review']     = 'Waiting';
$lang->workflowlabel->approval->labels['reviewedby'] = 'Reviewed by me';

$lang->workflowlabel->error = new stdclass();
$lang->workflowlabel->error->emptyParams = 'Empty params.';
$lang->workflowlabel->error->emptySQL    = 'Please enter a SQL condition.';
$lang->workflowlabel->error->unsafeSQL   = 'The SQL condition contains disallowed syntax. Please check and try again.';
$lang->workflowlabel->error->invalidSQL  = 'The SQL condition is invalid. The field name may have changed, or the SQL condition may be invalid. Please check and try again.';

$lang->workflowlabel->placeholder = new stdclass();
$lang->workflowlabel->placeholder->sql = 'Please enter a SQL condition, for example: status = "doing"';

$lang->workflowlabel->tips = new stdclass();
$lang->workflowlabel->tips->known    = 'Got it';
$lang->workflowlabel->tips->features = 'You can browse data through the tags in the list page.';
