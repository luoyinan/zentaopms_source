<?php
global $lang;

$config->market->dtable = new stdclass();

$config->market->dtable->fieldList['id']['title']    = $lang->idAB;
$config->market->dtable->fieldList['id']['name']     = 'id';
$config->market->dtable->fieldList['id']['type']     = 'id';
$config->market->dtable->fieldList['id']['sortType'] = true;
$config->market->dtable->fieldList['id']['width']    = '60';

$config->market->dtable->fieldList['name']['title']    = $lang->market->name;
$config->market->dtable->fieldList['name']['name']     = 'name';
$config->market->dtable->fieldList['name']['type']     = 'title';
$config->market->dtable->fieldList['name']['sortType'] = true;
$config->market->dtable->fieldList['name']['fixed']    = 'left';
$config->market->dtable->fieldList['name']['flex']     = 2;
$config->market->dtable->fieldList['name']['hint']     = true;
$config->market->dtable->fieldList['name']['link']     = array('module' => 'market', 'method' => 'view', 'params' => 'marketID={id}');

$config->market->dtable->fieldList['industry']['title']    = $lang->market->industry;
$config->market->dtable->fieldList['industry']['name']     = 'industry';
$config->market->dtable->fieldList['industry']['type']     = 'text';
$config->market->dtable->fieldList['industry']['sortType'] = true;
$config->market->dtable->fieldList['industry']['width']    = '160';
$config->market->dtable->fieldList['industry']['hint']     = true;

$config->market->dtable->fieldList['scaleText']['title']    = $lang->market->scale;
$config->market->dtable->fieldList['scaleText']['name']     = 'scale';
$config->market->dtable->fieldList['scaleText']['type']     = 'text';
$config->market->dtable->fieldList['scaleText']['sortType'] = true;
$config->market->dtable->fieldList['scaleText']['width']    = '110';

$config->market->dtable->fieldList['maturity']['title']    = $lang->market->maturity;
$config->market->dtable->fieldList['maturity']['name']     = 'maturity';
$config->market->dtable->fieldList['maturity']['type']     = 'category';
$config->market->dtable->fieldList['maturity']['map']      = $lang->market->maturityList;
$config->market->dtable->fieldList['maturity']['sortType'] = true;
$config->market->dtable->fieldList['maturity']['width']    = '80';

$config->market->dtable->fieldList['speed']['title']    = $lang->market->speed;
$config->market->dtable->fieldList['speed']['name']     = 'speed';
$config->market->dtable->fieldList['speed']['type']     = 'category';
$config->market->dtable->fieldList['speed']['map']      = $lang->market->speedList;
$config->market->dtable->fieldList['speed']['sortType'] = true;
$config->market->dtable->fieldList['speed']['width']    = '90';

$config->market->dtable->fieldList['competition']['title']    = $lang->market->competition;
$config->market->dtable->fieldList['competition']['name']     = 'competition';
$config->market->dtable->fieldList['competition']['type']     = 'category';
$config->market->dtable->fieldList['competition']['map']      = $lang->market->competitionList;
$config->market->dtable->fieldList['competition']['sortType'] = true;
$config->market->dtable->fieldList['competition']['width']    = '80';

$config->market->dtable->fieldList['ppm']['title']    = $lang->market->ppm;
$config->market->dtable->fieldList['ppm']['name']     = 'ppm';
$config->market->dtable->fieldList['ppm']['type']     = 'category';
$config->market->dtable->fieldList['ppm']['map']      = $lang->market->ppmList;
$config->market->dtable->fieldList['ppm']['sortType'] = true;
$config->market->dtable->fieldList['ppm']['width']    = '90';

$config->market->dtable->fieldList['strategy']['title']    = $lang->market->strategy;
$config->market->dtable->fieldList['strategy']['name']     = 'strategy';
$config->market->dtable->fieldList['strategy']['type']     = 'category';
$config->market->dtable->fieldList['strategy']['map']      = $lang->market->strategyList;
$config->market->dtable->fieldList['strategy']['sortType'] = true;
$config->market->dtable->fieldList['strategy']['width']    = '90';

$config->market->dtable->fieldList['openedDateText']['title']    = $lang->market->openedDate;
$config->market->dtable->fieldList['openedDateText']['name']     = 'openedDate';
$config->market->dtable->fieldList['openedDateText']['type']     = 'text';
$config->market->dtable->fieldList['openedDateText']['sortType'] = true;
$config->market->dtable->fieldList['openedDateText']['width']    = '120';

$config->market->actionList = array();
$config->market->actionList['report']['icon'] = 'list-alt';
$config->market->actionList['report']['text'] = $lang->market->report;
$config->market->actionList['report']['hint'] = $lang->market->report;
$config->market->actionList['report']['url']  = array('module' => 'marketreport', 'method' => 'browse', 'params' => 'marketID={id}');

$config->market->actionList['edit']['icon'] = 'edit';
$config->market->actionList['edit']['text'] = $lang->edit;
$config->market->actionList['edit']['hint'] = $lang->edit;
$config->market->actionList['edit']['url']  = array('module' => 'market', 'method' => 'edit', 'params' => 'marketID={id}');

$config->market->actionList['delete']['icon']         = 'trash';
$config->market->actionList['delete']['text']         = $lang->delete;
$config->market->actionList['delete']['hint']         = $lang->delete;
$config->market->actionList['delete']['url']          = array('module' => 'market', 'method' => 'delete', 'params' => 'marketID={id}');
$config->market->actionList['delete']['className']    = 'ajax-submit';
$config->market->actionList['delete']['data-confirm'] = array('message' => $lang->market->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');

$config->market->dtable->fieldList['actions']['name']     = 'actions';
$config->market->dtable->fieldList['actions']['title']    = $lang->actions;
$config->market->dtable->fieldList['actions']['type']     = 'actions';
$config->market->dtable->fieldList['actions']['sortType'] = false;
$config->market->dtable->fieldList['actions']['fixed']    = 'right';
$config->market->dtable->fieldList['actions']['width']    = '110';
$config->market->dtable->fieldList['actions']['list']     = $config->market->actionList;
$config->market->dtable->fieldList['actions']['menu']     = array_keys($config->market->actionList);