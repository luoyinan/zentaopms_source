<?php
global $app;
$app->loadLang('effort');

$config->user->effort = new stdclass();
$config->user->effort->dtable = new stdclass();

$config->user->effort->dtable->fieldList['id']['name']  = 'id';
$config->user->effort->dtable->fieldList['id']['title'] = $lang->idAB;
$config->user->effort->dtable->fieldList['id']['type']  = 'id';

$config->user->effort->dtable->fieldList['date']['name']     = 'date';
$config->user->effort->dtable->fieldList['date']['title']    = $lang->effort->date;
$config->user->effort->dtable->fieldList['date']['type']     = 'date';

$config->user->effort->dtable->fieldList['consumed']['name']  = 'consumed';
$config->user->effort->dtable->fieldList['consumed']['title'] = $lang->effort->consumed;
$config->user->effort->dtable->fieldList['consumed']['type']  = 'number';

$config->user->effort->dtable->fieldList['objectTitle']['name']        = 'objectTitle';
$config->user->effort->dtable->fieldList['objectTitle']['title']       = $lang->effort->objectType;
$config->user->effort->dtable->fieldList['objectTitle']['type']        = 'text';
$config->user->effort->dtable->fieldList['objectTitle']['link']        = helper::createLink('{objectType}', 'view', 'id={objectID}');
$config->user->effort->dtable->fieldList['objectTitle']['data-toggle'] = 'modal';
$config->user->effort->dtable->fieldList['objectTitle']['data-size']   = 'lg';

$config->user->effort->dtable->fieldList['work']['name']        = 'work';
$config->user->effort->dtable->fieldList['work']['title']       = $lang->effort->work;
$config->user->effort->dtable->fieldList['work']['type']        = 'title';
$config->user->effort->dtable->fieldList['work']['link']        = array('module' => 'effort', 'method' => 'view', 'params' => 'id={id}');
$config->user->effort->dtable->fieldList['work']['data-toggle'] = 'modal';