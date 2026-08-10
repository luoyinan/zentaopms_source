<?php
global $lang;
$config->workflowlinkage->actionList['edit']['icon']        = 'edit';
$config->workflowlinkage->actionList['edit']['hint']        = $lang->edit;
$config->workflowlinkage->actionList['edit']['url']         = array('module' => 'workflowlinkage', 'method' => 'edit', 'params' => 'action={action}&key={key}&ui={ui}');
$config->workflowlinkage->actionList['edit']['data-toggle'] = 'modal';

$config->workflowlinkage->actionList['delete']['icon']         = 'trash';
$config->workflowlinkage->actionList['delete']['hint']         = $lang->delete;
$config->workflowlinkage->actionList['delete']['url']          = array('module' => 'workflowlinkage', 'method' => 'delete', 'params' => 'action={action}&key={key}&ui={ui}');
$config->workflowlinkage->actionList['delete']['data-confirm'] = $lang->confirmDelete;
$config->workflowlinkage->actionList['delete']['className']    = 'ajax-submit';

$config->workflowlinkage->dtable = new stdclass();
$config->workflowlinkage->dtable->fieldList['source']['name']     = 'source';
$config->workflowlinkage->dtable->fieldList['source']['title']    = $lang->workflowlinkage->source;
$config->workflowlinkage->dtable->fieldList['source']['type']     = 'text';
$config->workflowlinkage->dtable->fieldList['source']['fixed']    = 'left';
$config->workflowlinkage->dtable->fieldList['source']['width']    = '120';
$config->workflowlinkage->dtable->fieldList['source']['sortType'] = false;

$config->workflowlinkage->dtable->fieldList['target']['name']     = 'target';
$config->workflowlinkage->dtable->fieldList['target']['title']    = $lang->workflowlinkage->target;
$config->workflowlinkage->dtable->fieldList['target']['type']     = 'text';
$config->workflowlinkage->dtable->fieldList['target']['sortType'] = false;

$config->workflowlinkage->dtable->fieldList['actions']['name']     = 'actions';
$config->workflowlinkage->dtable->fieldList['actions']['title']    = $lang->actions;
$config->workflowlinkage->dtable->fieldList['actions']['type']     = 'actions';
$config->workflowlinkage->dtable->fieldList['actions']['fixed']    = 'right';
$config->workflowlinkage->dtable->fieldList['actions']['width']    = '120';
$config->workflowlinkage->dtable->fieldList['actions']['menu']     = array('edit', 'delete');
$config->workflowlinkage->dtable->fieldList['actions']['list']     = $config->workflowlinkage->actionList;
$config->workflowlinkage->dtable->fieldList['actions']['sortType'] = false;