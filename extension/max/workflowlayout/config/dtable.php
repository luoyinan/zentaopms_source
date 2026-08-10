<?php
global $lang;
$config->workflowlayout->dtable = new stdclass();
$config->workflowlayout->dtable->fieldList['id']['name']     = 'id';
$config->workflowlayout->dtable->fieldList['id']['title']    = $lang->idAB;
$config->workflowlayout->dtable->fieldList['id']['type']     = 'checkID';
$config->workflowlayout->dtable->fieldList['id']['fixed']    = 'left';
$config->workflowlayout->dtable->fieldList['id']['width']    = '80';
$config->workflowlayout->dtable->fieldList['id']['sortType'] = false;

$config->workflowlayout->dtable->fieldList['name']['title']        = $lang->workflowlayout->field;
$config->workflowlayout->dtable->fieldList['name']['type']         = 'nestedTitle';
$config->workflowlayout->dtable->fieldList['name']['nestedToggle'] = true;
$config->workflowlayout->dtable->fieldList['name']['fixed']        = 'left';
$config->workflowlayout->dtable->fieldList['name']['name']         = 'name';
$config->workflowlayout->dtable->fieldList['name']['sortType']     = false;

$config->workflowlayout->dtable->fieldList['layoutRules']['name']         = 'layoutRules';
$config->workflowlayout->dtable->fieldList['layoutRules']['title']        = $lang->workflowlayout->layoutRules;
$config->workflowlayout->dtable->fieldList['layoutRules']['type']         = 'control';
$config->workflowlayout->dtable->fieldList['layoutRules']['control']      = array('type' => 'picker', 'props' => array('multiple' => true));
$config->workflowlayout->dtable->fieldList['layoutRules']['width']        = 160;
$config->workflowlayout->dtable->fieldList['layoutRules']['controlItems'] = array();
$config->workflowlayout->dtable->fieldList['layoutRules']['sortType']     = false;

$config->workflowlayout->dtable->fieldList['defaultValue']['name']         = 'defaultValue';
$config->workflowlayout->dtable->fieldList['defaultValue']['title']        = $lang->workflowlayout->defaultValue;
$config->workflowlayout->dtable->fieldList['defaultValue']['type']         = 'control';
$config->workflowlayout->dtable->fieldList['defaultValue']['control']      = array('type' => 'picker');
$config->workflowlayout->dtable->fieldList['defaultValue']['width']        = 160;
$config->workflowlayout->dtable->fieldList['defaultValue']['controlItems'] = array();
$config->workflowlayout->dtable->fieldList['defaultValue']['sortType']     = false;

$config->workflowlayout->dtable->fieldList['summary']['name']         = 'summary';
$config->workflowlayout->dtable->fieldList['summary']['title']        = $lang->workflowlayout->summary;
$config->workflowlayout->dtable->fieldList['summary']['type']         = 'control';
$config->workflowlayout->dtable->fieldList['summary']['control']      = array('type' => 'picker', 'props' => array('multiple' => true));
$config->workflowlayout->dtable->fieldList['summary']['width']        = 200;
$config->workflowlayout->dtable->fieldList['summary']['controlItems'] = array();
$config->workflowlayout->dtable->fieldList['summary']['sortType']     = false;
$config->workflowlayout->dtable->fieldList['summary']['controlItems'] = $lang->workflowlayout->summaryList;

$config->workflowlayout->dtable->fieldList['position']['name']         = 'position';
$config->workflowlayout->dtable->fieldList['position']['title']        = $lang->workflowlayout->position;
$config->workflowlayout->dtable->fieldList['position']['type']         = 'control';
$config->workflowlayout->dtable->fieldList['position']['control']      = array('type' => 'picker', 'props' => array('required' => true));
$config->workflowlayout->dtable->fieldList['position']['width']        = 160;
$config->workflowlayout->dtable->fieldList['position']['controlItems'] = array();
$config->workflowlayout->dtable->fieldList['position']['sortType']     = false;

$config->workflowlayout->dtable->fieldList['buildin']['name']     = 'buildin';
$config->workflowlayout->dtable->fieldList['buildin']['title']    = $lang->workflowlayout->buildin;
$config->workflowlayout->dtable->fieldList['buildin']['type']     = 'html';
$config->workflowlayout->dtable->fieldList['buildin']['width']    = 60;
$config->workflowlayout->dtable->fieldList['buildin']['fixed']    = 'right';
$config->workflowlayout->dtable->fieldList['buildin']['sortType'] = false;

$config->workflowlayout->dtable->fieldList['ditto']['name']     = 'ditto';
$config->workflowlayout->dtable->fieldList['ditto']['title']    = $lang->workflowlayout->ditto;
$config->workflowlayout->dtable->fieldList['ditto']['type']     = 'control';
$config->workflowlayout->dtable->fieldList['ditto']['control']  = array('type' => 'readonlyCheckbox');
$config->workflowlayout->dtable->fieldList['ditto']['width']    = 60;
$config->workflowlayout->dtable->fieldList['ditto']['fixed']    = 'right';
$config->workflowlayout->dtable->fieldList['ditto']['sortType'] = false;

$config->workflowlayout->dtable->fieldList['readonly']['name']     = 'readonly';
$config->workflowlayout->dtable->fieldList['readonly']['title']    = $lang->workflowlayout->readonly;
$config->workflowlayout->dtable->fieldList['readonly']['type']     = 'control';
$config->workflowlayout->dtable->fieldList['readonly']['control']  = array('type' => 'readonlyCheckbox');
$config->workflowlayout->dtable->fieldList['readonly']['width']    = 60;
$config->workflowlayout->dtable->fieldList['readonly']['fixed']    = 'right';
$config->workflowlayout->dtable->fieldList['readonly']['sortType'] = false;

$config->workflowlayout->dtable->sceneCols = array();
$config->workflowlayout->dtable->sceneCols['browse'] = array('id', 'name', 'summary', 'position', 'buildin');
$config->workflowlayout->dtable->sceneCols['view']   = array('id', 'name', 'position', 'buildin');
