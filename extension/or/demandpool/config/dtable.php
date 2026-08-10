<?php
global $app;
$config->demandpool->dtable = new stdclass();

$config->demandpool->dtable->fieldList['id']['title']    = $lang->idAB;
$config->demandpool->dtable->fieldList['id']['type']     = 'checkID';
$config->demandpool->dtable->fieldList['id']['sortType'] = true;
$config->demandpool->dtable->fieldList['id']['checkbox'] = false;
$config->demandpool->dtable->fieldList['id']['required'] = true;

$config->demandpool->dtable->fieldList['name']['title']    = $lang->demandpool->name;
$config->demandpool->dtable->fieldList['name']['fixed']    = 'left';
$config->demandpool->dtable->fieldList['name']['flex']     = 1;
$config->demandpool->dtable->fieldList['name']['type']     = 'nestedTitle';
$config->demandpool->dtable->fieldList['name']['sortType'] = true;
$config->demandpool->dtable->fieldList['name']['link']     = array('url' => array('module' => 'demandpool', 'method' => 'view', 'params' => 'demandpoolID={id}'));
$config->demandpool->dtable->fieldList['name']['required'] = true;
$config->demandpool->dtable->fieldList['name']['styleMap'] = array('--color-link' => 'color');
$config->demandpool->dtable->fieldList['name']['data-app'] = $app->tab;

$config->demandpool->dtable->fieldList['owner']['title']       = $lang->demandpool->owner;
$config->demandpool->dtable->fieldList['owner']['type']        = 'text';
$config->demandpool->dtable->fieldList['owner']['sortType']    = true;
$config->demandpool->dtable->fieldList['owner']['show']        = true;
$config->demandpool->dtable->fieldList['owner']['group']       = 1;

$config->demandpool->dtable->fieldList['draft']['title']    = $lang->demandpool->colList['draft'];
$config->demandpool->dtable->fieldList['draft']['type']     = 'number';
$config->demandpool->dtable->fieldList['draft']['sortType'] = false;
$config->demandpool->dtable->fieldList['draft']['show']     = true;
$config->demandpool->dtable->fieldList['draft']['group']    = 5;

$config->demandpool->dtable->fieldList['reviewing']['title']    = $lang->demandpool->colList['reviewing'];
$config->demandpool->dtable->fieldList['reviewing']['type']     = 'number';
$config->demandpool->dtable->fieldList['reviewing']['sortType'] = false;
$config->demandpool->dtable->fieldList['reviewing']['show']     = true;
$config->demandpool->dtable->fieldList['reviewing']['group']    = 5;

$config->demandpool->dtable->fieldList['wait']['title']    = $lang->demandpool->colList['wait'];
$config->demandpool->dtable->fieldList['wait']['type']     = 'number';
$config->demandpool->dtable->fieldList['wait']['sortType'] = false;
$config->demandpool->dtable->fieldList['wait']['show']     = true;
$config->demandpool->dtable->fieldList['wait']['group']    = 5;

$config->demandpool->dtable->fieldList['willCharter']['title']    = $lang->demandpool->colList['willCharter'];
$config->demandpool->dtable->fieldList['willCharter']['type']     = 'number';
$config->demandpool->dtable->fieldList['willCharter']['sortType'] = false;
$config->demandpool->dtable->fieldList['willCharter']['show']     = true;
$config->demandpool->dtable->fieldList['willCharter']['group']    = 5;

$config->demandpool->dtable->fieldList['inCharter']['title']    = $lang->demandpool->colList['inCharter'];
$config->demandpool->dtable->fieldList['inCharter']['type']     = 'number';
$config->demandpool->dtable->fieldList['inCharter']['sortType'] = false;
$config->demandpool->dtable->fieldList['inCharter']['width']    = 80;
$config->demandpool->dtable->fieldList['inCharter']['show']     = true;
$config->demandpool->dtable->fieldList['inCharter']['group']    = 5;

$config->demandpool->dtable->fieldList['actions']['type']  = 'actions';
$config->demandpool->dtable->fieldList['actions']['width'] = '100';
$config->demandpool->dtable->fieldList['actions']['menu']  = array('edit', 'close|activate', 'delete');
$config->demandpool->dtable->fieldList['actions']['list']  = $config->demandpool->actionList;
