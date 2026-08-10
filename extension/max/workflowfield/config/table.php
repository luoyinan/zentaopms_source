<?php
$config->workflowfield->actionList['edit']['icon']        = 'edit';
$config->workflowfield->actionList['edit']['hint']        = $lang->edit;
$config->workflowfield->actionList['edit']['url']         = array('module' => 'workflowfield', 'method' => 'edit', 'params' => 'module={module}&id={id}');
$config->workflowfield->actionList['edit']['data-toggle'] = 'modal';

$config->workflowfield->actionList['delete']['icon']         = 'trash';
$config->workflowfield->actionList['delete']['hint']         = $lang->delete;
$config->workflowfield->actionList['delete']['url']          = array('module' => 'workflowfield', 'method' => 'delete', 'params' => 'id={id}');
$config->workflowfield->actionList['delete']['data-confirm'] = $lang->confirmDelete;
$config->workflowfield->actionList['delete']['className']    = 'ajax-submit';

$config->workflowfield->dtable = new stdclass();
$config->workflowfield->dtable->fieldList['sort']['name']     = 'sort';
$config->workflowfield->dtable->fieldList['sort']['title']    = $lang->sort;
$config->workflowfield->dtable->fieldList['sort']['type']     = 'html';
$config->workflowfield->dtable->fieldList['sort']['fixed']    = 'left';
$config->workflowfield->dtable->fieldList['sort']['width']    = '60';
$config->workflowfield->dtable->fieldList['sort']['sortType'] = false;

$config->workflowfield->dtable->fieldList['name']['title']    = $lang->workflowfield->name;
$config->workflowfield->dtable->fieldList['name']['type']     = 'title';
$config->workflowfield->dtable->fieldList['name']['fixed']    = 'left';
$config->workflowfield->dtable->fieldList['name']['name']     = 'name';
$config->workflowfield->dtable->fieldList['name']['sortType'] = false;

$config->workflowfield->dtable->fieldList['fieldCode']['name']     = 'fieldCode';
$config->workflowfield->dtable->fieldList['fieldCode']['title']    = $lang->workflowfield->field;
$config->workflowfield->dtable->fieldList['fieldCode']['type']     = 'text';
$config->workflowfield->dtable->fieldList['fieldCode']['sortType'] = false;

$config->workflowfield->dtable->fieldList['control']['name']     = 'control';
$config->workflowfield->dtable->fieldList['control']['title']    = $lang->workflowfield->control;
$config->workflowfield->dtable->fieldList['control']['type']     = 'text';
$config->workflowfield->dtable->fieldList['control']['sortType'] = false;

$config->workflowfield->dtable->fieldList['actions']['name']     = 'actions';
$config->workflowfield->dtable->fieldList['actions']['title']    = $lang->actions;
$config->workflowfield->dtable->fieldList['actions']['type']     = 'actions';
$config->workflowfield->dtable->fieldList['actions']['fixed']    = 'right';
$config->workflowfield->dtable->fieldList['actions']['menu']     = array('edit', 'delete');
$config->workflowfield->dtable->fieldList['actions']['list']     = $config->workflowfield->actionList;
$config->workflowfield->dtable->fieldList['actions']['sortType'] = false;