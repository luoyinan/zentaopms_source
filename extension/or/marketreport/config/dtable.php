<?php
global $app;
$config->marketreport->dtable = new stdclass();

$config->marketreport->dtable->fieldList['id']['title']    = $lang->idAB;
$config->marketreport->dtable->fieldList['id']['type']     = 'checkID';
$config->marketreport->dtable->fieldList['id']['sortType'] = true;
$config->marketreport->dtable->fieldList['id']['checkbox'] = false;
$config->marketreport->dtable->fieldList['id']['required'] = true;

$config->marketreport->dtable->fieldList['name']['title']    = $lang->marketreport->name;
$config->marketreport->dtable->fieldList['name']['fixed']    = 'left';
$config->marketreport->dtable->fieldList['name']['flex']     = 1;
$config->marketreport->dtable->fieldList['name']['type']     = 'nestedTitle';
$config->marketreport->dtable->fieldList['name']['sortType'] = true;
$config->marketreport->dtable->fieldList['name']['link']     = array('url' => array('module' => 'marketreport', 'method' => 'view', 'params' => 'marketreportID={id}'));
$config->marketreport->dtable->fieldList['name']['required'] = true;
$config->marketreport->dtable->fieldList['name']['styleMap'] = array('--color-link' => 'color');
$config->marketreport->dtable->fieldList['name']['data-app'] = $app->tab;

$config->marketreport->dtable->fieldList['status']['title']     = $lang->marketreport->status;
$config->marketreport->dtable->fieldList['status']['type']      = 'status';
$config->marketreport->dtable->fieldList['status']['statusMap'] = $lang->marketreport->statusList;
$config->marketreport->dtable->fieldList['status']['sortType']  = true;
$config->marketreport->dtable->fieldList['status']['show']      = true;
$config->marketreport->dtable->fieldList['status']['group']     = 1;

$config->marketreport->dtable->fieldList['owner']['title']    = $lang->marketreport->owner;
$config->marketreport->dtable->fieldList['owner']['type']     = 'user';
$config->marketreport->dtable->fieldList['owner']['sortType'] = true;
$config->marketreport->dtable->fieldList['owner']['group']    = 2;

$config->marketreport->dtable->fieldList['market']['title']    = $lang->marketreport->market;
$config->marketreport->dtable->fieldList['market']['type']     = 'category';
$config->marketreport->dtable->fieldList['market']['map']      = array();
$config->marketreport->dtable->fieldList['market']['sortType'] = true;

$config->marketreport->dtable->fieldList['research']['title']    = $lang->marketreport->research;
$config->marketreport->dtable->fieldList['research']['type']    = 'category';
$config->marketreport->dtable->fieldList['research']['map']     = array();
$config->marketreport->dtable->fieldList['research']['sortType'] = true;

$config->marketreport->dtable->fieldList['source']['title']    = $lang->marketreport->source;
$config->marketreport->dtable->fieldList['source']['type']    = 'text';
$config->marketreport->dtable->fieldList['source']['sortType'] = true;

$config->marketreport->dtable->fieldList['openedBy']['title']    = $lang->marketreport->openedByAB;
$config->marketreport->dtable->fieldList['openedBy']['type']     = 'user';
$config->marketreport->dtable->fieldList['openedBy']['sortType'] = true;

$config->marketreport->dtable->fieldList['openedDate']['title']    = $lang->marketreport->openedDate;
$config->marketreport->dtable->fieldList['openedDate']['type']     = 'date';
$config->marketreport->dtable->fieldList['openedDate']['sortType'] = true;

$config->marketreport->dtable->fieldList['lastEditedBy']['title']    = $lang->marketreport->lastEditedBy;
$config->marketreport->dtable->fieldList['lastEditedBy']['type']     = 'user';
$config->marketreport->dtable->fieldList['lastEditedBy']['sortType'] = true;

$config->marketreport->dtable->fieldList['lastEditedDate']['title']    = $lang->marketreport->lastEditedDate;
$config->marketreport->dtable->fieldList['lastEditedDate']['type']     = 'date';
$config->marketreport->dtable->fieldList['lastEditedDate']['sortType'] = true;

$config->marketreport->dtable->fieldList['actions']['type']  = 'actions';
$config->marketreport->dtable->fieldList['actions']['width'] = '100';
$config->marketreport->dtable->fieldList['actions']['menu']  = array('publish', 'edit', 'delete');
$config->marketreport->dtable->fieldList['actions']['list']  = $config->marketreport->actionList;
