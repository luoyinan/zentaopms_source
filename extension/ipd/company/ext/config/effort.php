<?php
global $app;
$app->loadLang('effort');

$config->company->effort = new stdclass();
$config->company->effort->dtable = new stdclass();

$config->company->effort->dtable->fieldList['id']['name']     = 'id';
$config->company->effort->dtable->fieldList['id']['title']    = $lang->idAB;
$config->company->effort->dtable->fieldList['id']['type']     = 'id';
$config->company->effort->dtable->fieldList['id']['fixed']    = 'left';
$config->company->effort->dtable->fieldList['id']['show']     = true;
$config->company->effort->dtable->fieldList['id']['required'] = true;

$config->company->effort->dtable->fieldList['date']['name']     = 'date';
$config->company->effort->dtable->fieldList['date']['title']    = $lang->effort->date;
$config->company->effort->dtable->fieldList['date']['type']     = 'date';
$config->company->effort->dtable->fieldList['date']['fixed']    = 'left';
$config->company->effort->dtable->fieldList['date']['show']     = true;
$config->company->effort->dtable->fieldList['date']['required'] = true;

$config->company->effort->dtable->fieldList['dept']['name']  = 'dept';
$config->company->effort->dtable->fieldList['dept']['title'] = $lang->effort->dept;
$config->company->effort->dtable->fieldList['dept']['type']  = 'category';
$config->company->effort->dtable->fieldList['dept']['align'] = 'left';
$config->company->effort->dtable->fieldList['dept']['show']  = true;

$config->company->effort->dtable->fieldList['account']['name']  = 'account';
$config->company->effort->dtable->fieldList['account']['title'] = $lang->effort->account;
$config->company->effort->dtable->fieldList['account']['type']  = 'user';
$config->company->effort->dtable->fieldList['account']['show']  = true;

$config->company->effort->dtable->fieldList['work']['name']        = 'work';
$config->company->effort->dtable->fieldList['work']['title']       = $lang->effort->work;
$config->company->effort->dtable->fieldList['work']['type']        = 'title';
$config->company->effort->dtable->fieldList['work']['link']        = array('module' => 'effort', 'method' => 'view', 'params' => 'id={id}&from=my');
$config->company->effort->dtable->fieldList['work']['data-toggle'] = 'modal';
$config->company->effort->dtable->fieldList['work']['data-size']   = 'lg';
$config->company->effort->dtable->fieldList['work']['width']       = '300';

$config->company->effort->dtable->fieldList['consumed']['name']  = 'consumed';
$config->company->effort->dtable->fieldList['consumed']['title'] = $lang->effort->consumed;
$config->company->effort->dtable->fieldList['consumed']['type']  = 'number';
$config->company->effort->dtable->fieldList['consumed']['show']  = true;

$config->company->effort->dtable->fieldList['left']['name']  = 'left';
$config->company->effort->dtable->fieldList['left']['title'] = $lang->effort->left;
$config->company->effort->dtable->fieldList['left']['type']  = 'number';
$config->company->effort->dtable->fieldList['left']['show']  = true;

$config->company->effort->dtable->fieldList['objectTitle']['name']  = 'objectTitle';
$config->company->effort->dtable->fieldList['objectTitle']['title'] = $lang->effort->objectType;
$config->company->effort->dtable->fieldList['objectTitle']['type']  = 'text';
$config->company->effort->dtable->fieldList['objectTitle']['align'] = 'left';
$config->company->effort->dtable->fieldList['objectTitle']['show']  = true;

$config->company->effort->dtable->fieldList['product']['name']    = 'product';
$config->company->effort->dtable->fieldList['product']['title']   = $lang->effort->product;
$config->company->effort->dtable->fieldList['product']['type']    = 'category';
$config->company->effort->dtable->fieldList['product']['control'] = 'multiple';
$config->company->effort->dtable->fieldList['product']['align']   = 'left';
$config->company->effort->dtable->fieldList['product']['show']    = true;

$config->company->effort->dtable->fieldList['project']['name']  = 'project';
$config->company->effort->dtable->fieldList['project']['title'] = $lang->effort->project;
$config->company->effort->dtable->fieldList['project']['type']  = 'category';
$config->company->effort->dtable->fieldList['project']['align'] = 'left';
$config->company->effort->dtable->fieldList['project']['show']  = true;

$config->company->effort->dtable->fieldList['execution']['name']  = 'execution';
$config->company->effort->dtable->fieldList['execution']['title'] = $lang->effort->execution;
$config->company->effort->dtable->fieldList['execution']['type']  = 'category';
$config->company->effort->dtable->fieldList['execution']['align'] = 'left';
$config->company->effort->dtable->fieldList['execution']['show']  = true;
