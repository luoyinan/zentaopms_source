<?php
$config->ipdVersion     = '5.4';
$config->showStoryGrade = true;

$filter->charter = new stdclass();
$filter->charter->default = new stdclass();
$filter->charter->default->cookie['browseType'] = 'reg::word';

$filter->marketreport = new stdclass();
$filter->marketreport->browse = new stdclass();
$filter->marketreport->all    = new stdclass();
$filter->marketreport->browse->cookie['involvedReport'] = 'code';
$filter->marketreport->all->cookie['involvedReport']    = 'code';

$filter->marketresearch = new stdclass();
$filter->marketresearch->browse  = new stdclass();
$filter->marketresearch->all     = new stdclass();
$filter->marketresearch->reports = new stdclass();
$filter->marketresearch->browse->cookie['involvedResearch'] = 'code';
$filter->marketresearch->all->cookie['involvedResearch']    = 'code';
$filter->marketresearch->reports->cookie['involvedReport']  = 'code';

$filter->demand = new stdclass();

$filter->demand->browse = new stdclass();
$filter->demand->export = new stdclass();

$filter->demand->browse->cookie['involvedReport']    = 'int';
$filter->demand->browse->cookie['requirementModule'] = 'int';
$filter->demand->export->cookie['checkedItem']       = 'reg::checked';

/* 登录用户可以访问的方法。The methods that can be accessed by the logged users. */
$config->logonMethods[] = 'demand.showimport';
$config->logonMethods[] = 'story.showimport';
$config->logonMethods[] = 'market.ajaxgetdropmenu';
$config->logonMethods[] = 'demandpool.ajaxgetdropmenu';
$config->logonMethods[] = 'demandpool.ajaxgetolddropmenu';

/* Ajax 方法依赖的方法。The methods that Ajax methods depend on. */
$config->ajaxDependencies['baseline.ajaxgetdocs']             = 'review.create';
$config->ajaxDependencies['demand.ajaxgetassignedto']         = 'demand.create';
$config->ajaxDependencies['demand.ajaxgetbranches']           = 'demand.distribute';
$config->ajaxDependencies['demand.ajaxgetoptions']            = ['demand.create', 'demand.edit', 'demand.change'];
$config->ajaxDependencies['demand.ajaxgetparentdemands']      = 'demand.create';
$config->ajaxDependencies['demand.ajaxgetproducts']           = ['demand.create', 'demand.edit', 'demand.change'];
$config->ajaxDependencies['demand.ajaxgetroadmapplans']       = 'demand.distribute';
$config->ajaxDependencies['demand.ajaxgetroadmaps']           = ['demand.distribute', 'story.create', 'story.edit', 'project.create', 'project.edit', 'execution.create', 'execution.edit', 'charter.create', 'charter.edit'];
$config->ajaxDependencies['demand.ajaxgetstorygrade']         = 'demand.distribute';
$config->ajaxDependencies['demand.ajaxgetuserdemands']        = ['todo.create', 'todo.edit', 'todo.batchcreate'];
$config->ajaxDependencies['demandpool.ajaxcheckreviewer']     = 'demandpool.edit';
$config->ajaxDependencies['demandpool.ajaxgetdropmenu']       = '';
$config->ajaxDependencies['demandpool.ajaxgetolddropmenu']    = 'demandpool.browse';
$config->ajaxDependencies['execution.ajaxgettypes']           = 'execution.create';
$config->ajaxDependencies['market.ajaxgetdropmenu']           = 'market.browse';
$config->ajaxDependencies['marketreport.ajaxgetmarketlist']   = ['marketreport.create', 'marketreport.edit'];
$config->ajaxDependencies['marketreport.ajaxgetresearchlist'] = ['marketreport.create', 'marketreport.edit'];
$config->ajaxDependencies['review.ajaxchangetrdeadline']      = ['project.execution', 'programplan.browse', 'execution.gantt'];
$config->ajaxDependencies['roadmap.ajaxgetchangeroadmaps']    = 'roadmap.view';
$config->ajaxDependencies['roadmap.ajaxgetnotice']            = 'roadmap.edit';
$config->ajaxDependencies['roadmap.ajaxstorysort']            = 'roadmap.view';

if($config->edition == 'ipd') $config->featureGroup->product = array('roadmap', 'track', 'ER');

$config->hasDropmenuApps[]     = 'market';
$config->excludeDropmenuList[] = 'marketresearch-all';
$config->excludeDropmenuList[] = 'demandpool-browse';
$config->excludeDropmenuList[] = 'demandpool-create';
