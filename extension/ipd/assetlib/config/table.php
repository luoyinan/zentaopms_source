<?php
global $lang, $app;
$app->loadLang('story');
$app->loadLang('risk');
$app->loadLang('issue');
$app->loadLang('opportunity');

$isEn = $app->getClientLang() == 'en';

$config->assetlib->dtable = new stdclass();
$config->assetlib->dtable->story       = new stdclass();
$config->assetlib->dtable->importStory = new stdclass();
$config->assetlib->dtable->importIssue = new stdclass();
$config->assetlib->dtable->importRisk  = new stdclass();
$config->assetlib->dtable->importOpportunity = new stdclass();
$config->assetlib->dtable->importDoc   = new stdclass();

$config->assetlib->dtable->story->fieldList['id']['name']     = 'id';
$config->assetlib->dtable->story->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->story->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->story->fieldList['id']['required'] = true;
$config->assetlib->dtable->story->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->story->fieldList['id']['checkbox'] = true;
$config->assetlib->dtable->story->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->story->fieldList['id']['group']    = 1;

$config->assetlib->dtable->story->fieldList['title']['name']         = 'title';
$config->assetlib->dtable->story->fieldList['title']['title']        = $lang->story->title;
$config->assetlib->dtable->story->fieldList['title']['type']         = 'title';
$config->assetlib->dtable->story->fieldList['title']['link']         = array('url' => helper::createLink('assetlib', 'storyView', 'storyID={id}'));
$config->assetlib->dtable->story->fieldList['title']['fixed']        = 'left';
$config->assetlib->dtable->story->fieldList['title']['sortType']     = true;
$config->assetlib->dtable->story->fieldList['title']['minWidth']     = '342';
$config->assetlib->dtable->story->fieldList['title']['required']     = true;
$config->assetlib->dtable->story->fieldList['title']['nestedToggle'] = true;
$config->assetlib->dtable->story->fieldList['title']['group']        = 1;
$config->assetlib->dtable->story->fieldList['title']['data-app']     = $app->tab;
$config->assetlib->dtable->story->fieldList['title']['styleMap']     = array('--color-link' => 'color');

$config->assetlib->dtable->story->fieldList['pri']['name']     = 'pri';
$config->assetlib->dtable->story->fieldList['pri']['title']    = $app->getClientLang() == 'en' ? $lang->story->pri : $lang->priAB;
$config->assetlib->dtable->story->fieldList['pri']['fixed']    = 'left';
$config->assetlib->dtable->story->fieldList['pri']['sortType'] = true;
$config->assetlib->dtable->story->fieldList['pri']['type']     = 'pri';
$config->assetlib->dtable->story->fieldList['pri']['group']    = 2;

$config->assetlib->dtable->story->fieldList['status']['name']      = 'status';
$config->assetlib->dtable->story->fieldList['status']['title']     = $lang->statusAB;
$config->assetlib->dtable->story->fieldList['status']['sortType']  = true;
$config->assetlib->dtable->story->fieldList['status']['type']      = 'status';
$config->assetlib->dtable->story->fieldList['status']['group']     = 3;
$config->assetlib->dtable->story->fieldList['status']['statusMap'] = $lang->assetlib->statusList;

$config->assetlib->dtable->story->fieldList['openedBy']['name']     = 'openedBy';
$config->assetlib->dtable->story->fieldList['openedBy']['title']    = $lang->story->openedByAB;
$config->assetlib->dtable->story->fieldList['openedBy']['sortType'] = true;
$config->assetlib->dtable->story->fieldList['openedBy']['type']     = 'user';
$config->assetlib->dtable->story->fieldList['openedBy']['group']    = 5;

$config->assetlib->dtable->story->fieldList['openedDate']['name']     = 'openedDate';
$config->assetlib->dtable->story->fieldList['openedDate']['title']    = $lang->story->openedDate;
$config->assetlib->dtable->story->fieldList['openedDate']['sortType'] = true;
$config->assetlib->dtable->story->fieldList['openedDate']['type']     = 'date';
$config->assetlib->dtable->story->fieldList['openedDate']['group']    = 5;

$config->assetlib->dtable->story->fieldList['estimate']['name']     = 'estimate';
$config->assetlib->dtable->story->fieldList['estimate']['title']    = $lang->story->estimateAB;
$config->assetlib->dtable->story->fieldList['estimate']['sortType'] = true;
$config->assetlib->dtable->story->fieldList['estimate']['type']     = 'number';
$config->assetlib->dtable->story->fieldList['estimate']['group']    = 5;

$config->assetlib->dtable->story->fieldList['assignedTo']['name']     = 'assignedTo';
$config->assetlib->dtable->story->fieldList['assignedTo']['title']    = $lang->assetlib->approved;
$config->assetlib->dtable->story->fieldList['assignedTo']['width']    = '100';
$config->assetlib->dtable->story->fieldList['assignedTo']['type']     = 'user';
$config->assetlib->dtable->story->fieldList['assignedTo']['sortType'] = false;
$config->assetlib->dtable->story->fieldList['assignedTo']['group']    = 5;

$config->assetlib->dtable->story->fieldList['approvedDate']['name']     = 'approvedDate';
$config->assetlib->dtable->story->fieldList['approvedDate']['title']    = $lang->assetlib->approvedDate;
$config->assetlib->dtable->story->fieldList['approvedDate']['sortType'] = true;
$config->assetlib->dtable->story->fieldList['approvedDate']['type']     = 'date';
$config->assetlib->dtable->story->fieldList['approvedDate']['group']    = 5;

$config->assetlib->dtable->story->fieldList['actions']['name']     = 'actions';
$config->assetlib->dtable->story->fieldList['actions']['title']    = $lang->actions;
$config->assetlib->dtable->story->fieldList['actions']['fixed']    = 'right';
$config->assetlib->dtable->story->fieldList['actions']['required'] = true;
$config->assetlib->dtable->story->fieldList['actions']['width']    = 'auto';
$config->assetlib->dtable->story->fieldList['actions']['minWidth'] = 120;
$config->assetlib->dtable->story->fieldList['actions']['type']     = 'actions';
$config->assetlib->dtable->story->fieldList['actions']['menu']     = array('editStory', 'approveStory', 'removeStory');
$config->assetlib->dtable->story->fieldList['actions']['list']     = $config->assetlib->story->actionList;

$config->assetlib->dtable->importStory->fieldList['id']['name']     = 'id';
$config->assetlib->dtable->importStory->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->importStory->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->importStory->fieldList['id']['required'] = true;
$config->assetlib->dtable->importStory->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->importStory->fieldList['id']['checkbox'] = true;
$config->assetlib->dtable->importStory->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->importStory->fieldList['id']['group']    = 1;

$config->assetlib->dtable->importStory->fieldList['title']['name']         = 'title';
$config->assetlib->dtable->importStory->fieldList['title']['title']        = $lang->story->title;
$config->assetlib->dtable->importStory->fieldList['title']['type']         = 'title';
$config->assetlib->dtable->importStory->fieldList['title']['link']         = array('module' => '{type}', 'method' => 'view', 'params' => 'storyID={id}');
$config->assetlib->dtable->importStory->fieldList['title']['fixed']        = 'left';
$config->assetlib->dtable->importStory->fieldList['title']['sortType']     = true;
$config->assetlib->dtable->importStory->fieldList['title']['minWidth']     = '342';
$config->assetlib->dtable->importStory->fieldList['title']['required']     = true;
$config->assetlib->dtable->importStory->fieldList['title']['nestedToggle'] = true;
$config->assetlib->dtable->importStory->fieldList['title']['group']        = 1;
$config->assetlib->dtable->importStory->fieldList['title']['data-toggle']  = 'modal';
$config->assetlib->dtable->importStory->fieldList['title']['data-size']    = 'lg';
$config->assetlib->dtable->importStory->fieldList['title']['styleMap']     = array('--color-link' => 'color');

$config->assetlib->dtable->importStory->fieldList['pri']['name']     = 'pri';
$config->assetlib->dtable->importStory->fieldList['pri']['title']    = $lang->priAB;
$config->assetlib->dtable->importStory->fieldList['pri']['fixed']    = 'left';
$config->assetlib->dtable->importStory->fieldList['pri']['sortType'] = true;
$config->assetlib->dtable->importStory->fieldList['pri']['type']     = 'pri';
$config->assetlib->dtable->importStory->fieldList['pri']['group']    = 2;
if($isEn) $config->assetlib->dtable->importStory->fieldList['pri']['width'] = 100;

$config->assetlib->dtable->importStory->fieldList['status']['name']      = 'status';
$config->assetlib->dtable->importStory->fieldList['status']['title']     = $lang->statusAB;
$config->assetlib->dtable->importStory->fieldList['status']['sortType']  = true;
$config->assetlib->dtable->importStory->fieldList['status']['type']      = 'status';
$config->assetlib->dtable->importStory->fieldList['status']['group']     = 3;
$config->assetlib->dtable->importStory->fieldList['status']['statusMap'] = $lang->story->statusList;

$config->assetlib->dtable->importStory->fieldList['category']['name']      = 'category';
$config->assetlib->dtable->importStory->fieldList['category']['title']     = $lang->story->category;
$config->assetlib->dtable->importStory->fieldList['category']['sortType']  = true;
$config->assetlib->dtable->importStory->fieldList['category']['group']     = 3;
$config->assetlib->dtable->importStory->fieldList['category']['map']       = $lang->story->categoryList;
if($isEn) $config->assetlib->dtable->importStory->fieldList['category']['width'] = 120;

$config->assetlib->dtable->importStory->fieldList['plan']['name']     = 'plan';
$config->assetlib->dtable->importStory->fieldList['plan']['title']    = $lang->story->planAB;
$config->assetlib->dtable->importStory->fieldList['plan']['sortType'] = true;
$config->assetlib->dtable->importStory->fieldList['plan']['type']     = 'category';
$config->assetlib->dtable->importStory->fieldList['plan']['group']    = 4;

$config->assetlib->dtable->importStory->fieldList['openedBy']['name']     = 'openedBy';
$config->assetlib->dtable->importStory->fieldList['openedBy']['title']    = $lang->story->openedByAB;
$config->assetlib->dtable->importStory->fieldList['openedBy']['sortType'] = true;
$config->assetlib->dtable->importStory->fieldList['openedBy']['type']     = 'user';
$config->assetlib->dtable->importStory->fieldList['openedBy']['group']    = 5;

$config->assetlib->dtable->importStory->fieldList['openedDate']['name']     = 'openedDate';
$config->assetlib->dtable->importStory->fieldList['openedDate']['title']    = $lang->story->openedDate;
$config->assetlib->dtable->importStory->fieldList['openedDate']['sortType'] = true;
$config->assetlib->dtable->importStory->fieldList['openedDate']['type']     = 'date';
$config->assetlib->dtable->importStory->fieldList['openedDate']['group']    = 5;
if($isEn) $config->assetlib->dtable->importStory->fieldList['openedDate']['width'] = 120;

$config->assetlib->dtable->importStory->fieldList['estimate']['name']     = 'estimate';
$config->assetlib->dtable->importStory->fieldList['estimate']['title']    = $lang->story->estimateAB;
$config->assetlib->dtable->importStory->fieldList['estimate']['sortType'] = true;
$config->assetlib->dtable->importStory->fieldList['estimate']['type']     = 'number';
$config->assetlib->dtable->importStory->fieldList['estimate']['group']    = 5;
if($isEn) $config->assetlib->dtable->importStory->fieldList['estimate']['width'] = 120;

$config->assetlib->dtable->importIssue->fieldList['id']['name']     = 'id';
$config->assetlib->dtable->importIssue->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->importIssue->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->importIssue->fieldList['id']['required'] = true;
$config->assetlib->dtable->importIssue->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->importIssue->fieldList['id']['checkbox'] = true;
$config->assetlib->dtable->importIssue->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->importIssue->fieldList['id']['group']    = 1;

$config->assetlib->dtable->importIssue->fieldList['severity']['name']         = 'severity';
$config->assetlib->dtable->importIssue->fieldList['severity']['title']        = $lang->issue->severity;
$config->assetlib->dtable->importIssue->fieldList['severity']['fixed']        = 'left';
$config->assetlib->dtable->importIssue->fieldList['severity']['type']         = 'severity';
$config->assetlib->dtable->importIssue->fieldList['severity']['severityList'] = $lang->issue->severityList;
$config->assetlib->dtable->importIssue->fieldList['severity']['sortType']     = true;
$config->assetlib->dtable->importIssue->fieldList['severity']['group']        = 2;

$config->assetlib->dtable->importIssue->fieldList['pri']['name']     = 'pri';
$config->assetlib->dtable->importIssue->fieldList['pri']['title']    = $isEn ? $lang->issue->pri : $lang->priAB;
$config->assetlib->dtable->importIssue->fieldList['pri']['fixed']    = 'left';
$config->assetlib->dtable->importIssue->fieldList['pri']['type']     = 'pri';
$config->assetlib->dtable->importIssue->fieldList['pri']['priList']  = $lang->issue->priList;
$config->assetlib->dtable->importIssue->fieldList['pri']['sortType'] = true;
$config->assetlib->dtable->importIssue->fieldList['pri']['group']    = 2;
if($isEn) $config->assetlib->dtable->importIssue->fieldList['pri']['width'] = 100;

$config->assetlib->dtable->importIssue->fieldList['title']['name']         = 'title';
$config->assetlib->dtable->importIssue->fieldList['title']['title']        = $lang->assetlib->name;
$config->assetlib->dtable->importIssue->fieldList['title']['type']         = 'title';
$config->assetlib->dtable->importIssue->fieldList['title']['link']         = array('module' => 'issue', 'method' => 'view', 'params' => 'issueID={id}');
$config->assetlib->dtable->importIssue->fieldList['title']['fixed']        = 'left';
$config->assetlib->dtable->importIssue->fieldList['title']['sortType']     = true;
$config->assetlib->dtable->importIssue->fieldList['title']['minWidth']     = '342';
$config->assetlib->dtable->importIssue->fieldList['title']['required']     = true;
$config->assetlib->dtable->importIssue->fieldList['title']['nestedToggle'] = true;
$config->assetlib->dtable->importIssue->fieldList['title']['group']        = 1;
$config->assetlib->dtable->importIssue->fieldList['title']['data-toggle']  = 'modal';
$config->assetlib->dtable->importIssue->fieldList['title']['data-size']    = 'lg';

$config->assetlib->dtable->importIssue->fieldList['type']['name']     = 'type';
$config->assetlib->dtable->importIssue->fieldList['type']['title']    = $lang->issue->type;
$config->assetlib->dtable->importIssue->fieldList['type']['type']     = 'category';
$config->assetlib->dtable->importIssue->fieldList['type']['map']      = $lang->issue->typeList;
$config->assetlib->dtable->importIssue->fieldList['type']['sortType'] = true;
$config->assetlib->dtable->importIssue->fieldList['type']['group']    = 3;

$config->assetlib->dtable->importIssue->fieldList['project']['name']     = 'project';
$config->assetlib->dtable->importIssue->fieldList['project']['title']    = $lang->assetlib->project;
$config->assetlib->dtable->importIssue->fieldList['project']['type']     = 'category';
$config->assetlib->dtable->importIssue->fieldList['project']['sortType'] = true;
$config->assetlib->dtable->importIssue->fieldList['project']['group']    = 4;

$config->assetlib->dtable->importRisk->fieldList['id']['name']     = 'id';
$config->assetlib->dtable->importRisk->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->importRisk->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->importRisk->fieldList['id']['required'] = true;
$config->assetlib->dtable->importRisk->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->importRisk->fieldList['id']['checkbox'] = true;
$config->assetlib->dtable->importRisk->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->importRisk->fieldList['id']['group']    = 1;

$config->assetlib->dtable->importRisk->fieldList['rate']['name']     = 'rate';
$config->assetlib->dtable->importRisk->fieldList['rate']['title']    = $lang->risk->rate;
$config->assetlib->dtable->importRisk->fieldList['rate']['fixed']    = 'left';
$config->assetlib->dtable->importRisk->fieldList['rate']['type']     = 'number';
$config->assetlib->dtable->importRisk->fieldList['rate']['sortType'] = true;
$config->assetlib->dtable->importRisk->fieldList['rate']['group']    = 2;
$config->assetlib->dtable->importRisk->fieldList['rate']['width']    = 120;

$config->assetlib->dtable->importRisk->fieldList['pri']['name']     = 'pri';
$config->assetlib->dtable->importRisk->fieldList['pri']['title']    = $lang->priAB;
$config->assetlib->dtable->importRisk->fieldList['pri']['fixed']    = 'left';
$config->assetlib->dtable->importRisk->fieldList['pri']['type']     = 'pri';
$config->assetlib->dtable->importRisk->fieldList['pri']['priList']  = $lang->risk->priList;
$config->assetlib->dtable->importRisk->fieldList['pri']['sortType'] = true;
$config->assetlib->dtable->importRisk->fieldList['pri']['group']    = 2;
if($isEn) $config->assetlib->dtable->importRisk->fieldList['pri']['width'] = 100;

$config->assetlib->dtable->importRisk->fieldList['name']['name']         = 'name';
$config->assetlib->dtable->importRisk->fieldList['name']['title']        = $lang->assetlib->name;
$config->assetlib->dtable->importRisk->fieldList['name']['type']         = 'title';
$config->assetlib->dtable->importRisk->fieldList['name']['link']         = array('module' => 'risk', 'method' => 'view', 'params' => 'riskID={id}');
$config->assetlib->dtable->importRisk->fieldList['name']['fixed']        = 'left';
$config->assetlib->dtable->importRisk->fieldList['name']['sortType']     = true;
$config->assetlib->dtable->importRisk->fieldList['name']['minWidth']     = '342';
$config->assetlib->dtable->importRisk->fieldList['name']['required']     = true;
$config->assetlib->dtable->importRisk->fieldList['name']['group']        = 1;
$config->assetlib->dtable->importRisk->fieldList['name']['data-toggle']  = 'modal';
$config->assetlib->dtable->importRisk->fieldList['name']['data-size']    = 'lg';

$config->assetlib->dtable->importRisk->fieldList['category']['name']     = 'category';
$config->assetlib->dtable->importRisk->fieldList['category']['title']    = $lang->risk->category;
$config->assetlib->dtable->importRisk->fieldList['category']['type']     = 'category';
$config->assetlib->dtable->importRisk->fieldList['category']['map']      = $lang->risk->categoryList;
$config->assetlib->dtable->importRisk->fieldList['category']['sortType'] = true;
$config->assetlib->dtable->importRisk->fieldList['category']['group']    = 3;
if($isEn) $config->assetlib->dtable->importRisk->fieldList['category']['width'] = 120;

$config->assetlib->dtable->importRisk->fieldList['strategy']['name']     = 'strategy';
$config->assetlib->dtable->importRisk->fieldList['strategy']['title']    = $lang->risk->strategy;
$config->assetlib->dtable->importRisk->fieldList['strategy']['type']     = 'category';
$config->assetlib->dtable->importRisk->fieldList['strategy']['map']      = $lang->risk->strategyList;
$config->assetlib->dtable->importRisk->fieldList['strategy']['sortType'] = true;
$config->assetlib->dtable->importRisk->fieldList['strategy']['group']    = 3;
if($isEn) $config->assetlib->dtable->importRisk->fieldList['strategy']['width'] = 120;

$config->assetlib->dtable->importRisk->fieldList['project']['name']     = 'project';
$config->assetlib->dtable->importRisk->fieldList['project']['title']    = $lang->assetlib->project;
$config->assetlib->dtable->importRisk->fieldList['project']['type']     = 'category';
$config->assetlib->dtable->importRisk->fieldList['project']['sortType'] = true;
$config->assetlib->dtable->importRisk->fieldList['project']['group']    = 4;

$config->assetlib->dtable->importOpportunity->fieldList['id']['name']     = 'id';
$config->assetlib->dtable->importOpportunity->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->importOpportunity->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->importOpportunity->fieldList['id']['required'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->importOpportunity->fieldList['id']['checkbox'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['id']['group']    = 1;

$config->assetlib->dtable->importOpportunity->fieldList['ratio']['name']     = 'ratio';
$config->assetlib->dtable->importOpportunity->fieldList['ratio']['title']    = $lang->opportunity->ratio;
$config->assetlib->dtable->importOpportunity->fieldList['ratio']['fixed']    = 'left';
$config->assetlib->dtable->importOpportunity->fieldList['ratio']['type']     = 'number';
$config->assetlib->dtable->importOpportunity->fieldList['ratio']['sortType'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['ratio']['group']    = 2;
$config->assetlib->dtable->importOpportunity->fieldList['ratio']['width']    = 100;

$config->assetlib->dtable->importOpportunity->fieldList['pri']['name']     = 'pri';
$config->assetlib->dtable->importOpportunity->fieldList['pri']['title']    = $lang->priAB;
$config->assetlib->dtable->importOpportunity->fieldList['pri']['fixed']    = 'left';
$config->assetlib->dtable->importOpportunity->fieldList['pri']['type']     = 'pri';
$config->assetlib->dtable->importOpportunity->fieldList['pri']['priList']  = $lang->opportunity->priList;
$config->assetlib->dtable->importOpportunity->fieldList['pri']['sortType'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['pri']['group']    = 2;
if($isEn) $config->assetlib->dtable->importOpportunity->fieldList['pri']['width'] = 100;

$config->assetlib->dtable->importOpportunity->fieldList['name']['name']         = 'name';
$config->assetlib->dtable->importOpportunity->fieldList['name']['title']        = $lang->assetlib->name;
$config->assetlib->dtable->importOpportunity->fieldList['name']['type']         = 'title';
$config->assetlib->dtable->importOpportunity->fieldList['name']['link']         = array('module' => 'opportunity', 'method' => 'view', 'params' => 'opportunityID={id}');
$config->assetlib->dtable->importOpportunity->fieldList['name']['fixed']        = 'left';
$config->assetlib->dtable->importOpportunity->fieldList['name']['sortType']     = true;
$config->assetlib->dtable->importOpportunity->fieldList['name']['minWidth']     = '342';
$config->assetlib->dtable->importOpportunity->fieldList['name']['required']     = true;
$config->assetlib->dtable->importOpportunity->fieldList['name']['nestedToggle'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['name']['group']        = 1;
$config->assetlib->dtable->importOpportunity->fieldList['name']['data-toggle']  = 'modal';
$config->assetlib->dtable->importOpportunity->fieldList['name']['data-size']    = 'lg';

$config->assetlib->dtable->importOpportunity->fieldList['type']['name']     = 'type';
$config->assetlib->dtable->importOpportunity->fieldList['type']['title']    = $lang->opportunity->type;
$config->assetlib->dtable->importOpportunity->fieldList['type']['type']     = 'category';
$config->assetlib->dtable->importOpportunity->fieldList['type']['map']      = $lang->opportunity->typeList;
$config->assetlib->dtable->importOpportunity->fieldList['type']['sortType'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['type']['group']    = 3;

$config->assetlib->dtable->importOpportunity->fieldList['strategy']['name']     = 'strategy';
$config->assetlib->dtable->importOpportunity->fieldList['strategy']['title']    = $lang->opportunity->strategy;
$config->assetlib->dtable->importOpportunity->fieldList['strategy']['type']     = 'category';
$config->assetlib->dtable->importOpportunity->fieldList['strategy']['map']      = $lang->opportunity->strategyList;
$config->assetlib->dtable->importOpportunity->fieldList['strategy']['sortType'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['strategy']['group']    = 3;
if($isEn) $config->assetlib->dtable->importOpportunity->fieldList['strategy']['width'] = 120;

$config->assetlib->dtable->importOpportunity->fieldList['project']['name']     = 'project';
$config->assetlib->dtable->importOpportunity->fieldList['project']['title']    = $lang->assetlib->project;
$config->assetlib->dtable->importOpportunity->fieldList['project']['type']     = 'category';
$config->assetlib->dtable->importOpportunity->fieldList['project']['sortType'] = true;
$config->assetlib->dtable->importOpportunity->fieldList['project']['group']    = 4;

$config->assetlib->dtable->importDoc->fieldList['id']['name']     = 'id';
$config->assetlib->dtable->importDoc->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->importDoc->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->importDoc->fieldList['id']['required'] = true;
$config->assetlib->dtable->importDoc->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->importDoc->fieldList['id']['checkbox'] = true;
$config->assetlib->dtable->importDoc->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->importDoc->fieldList['id']['group']    = 1;

$config->assetlib->dtable->importDoc->fieldList['title']['name']         = 'title';
$config->assetlib->dtable->importDoc->fieldList['title']['title']        = $lang->assetlib->name;
$config->assetlib->dtable->importDoc->fieldList['title']['type']         = 'title';
$config->assetlib->dtable->importDoc->fieldList['title']['link']         = array('module' => 'doc', 'method' => 'view', 'params' => 'docID={id}&version=0');
$config->assetlib->dtable->importDoc->fieldList['title']['fixed']        = 'left';
$config->assetlib->dtable->importDoc->fieldList['title']['sortType']     = true;
$config->assetlib->dtable->importDoc->fieldList['title']['minWidth']     = '342';
$config->assetlib->dtable->importDoc->fieldList['title']['required']     = true;
$config->assetlib->dtable->importDoc->fieldList['title']['nestedToggle'] = true;
$config->assetlib->dtable->importDoc->fieldList['title']['group']        = 1;
$config->assetlib->dtable->importDoc->fieldList['title']['data-app']     = 'doc';

$config->assetlib->dtable->importDoc->fieldList['project']['name']     = 'project';
$config->assetlib->dtable->importDoc->fieldList['project']['title']    = $lang->assetlib->project;
$config->assetlib->dtable->importDoc->fieldList['project']['type']     = 'category';
$config->assetlib->dtable->importDoc->fieldList['project']['sortType'] = true;
$config->assetlib->dtable->importDoc->fieldList['project']['group']    = 4;

$config->assetlib->dtable->browse = new stdclass();
$config->assetlib->dtable->browse->fieldList['id']['title']    = $lang->idAB;
$config->assetlib->dtable->browse->fieldList['id']['fixed']    = 'left';
$config->assetlib->dtable->browse->fieldList['id']['required'] = true;
$config->assetlib->dtable->browse->fieldList['id']['type']     = 'checkID';
$config->assetlib->dtable->browse->fieldList['id']['checkbox'] = false;
$config->assetlib->dtable->browse->fieldList['id']['sortType'] = true;
$config->assetlib->dtable->browse->fieldList['id']['group']    = 1;

$config->assetlib->dtable->browse->fieldList['name']['title']        = $lang->assetlib->name;
$config->assetlib->dtable->browse->fieldList['name']['type']         = 'title';
$config->assetlib->dtable->browse->fieldList['name']['link']         = array('url' => array('module' => 'assetlib', 'method' => 'viewLib', 'params' => 'libID={id}'));
$config->assetlib->dtable->browse->fieldList['name']['fixed']        = 'left';
$config->assetlib->dtable->browse->fieldList['name']['sortType']     = true;
$config->assetlib->dtable->browse->fieldList['name']['minWidth']     = '342';
$config->assetlib->dtable->browse->fieldList['name']['required']     = true;
$config->assetlib->dtable->browse->fieldList['name']['nestedToggle'] = false;
$config->assetlib->dtable->browse->fieldList['name']['group']        = 1;
$config->assetlib->dtable->browse->fieldList['name']['data-app']     = $app->tab;
$config->assetlib->dtable->browse->fieldList['name']['styleMap']     = array('--color-link' => 'color');

$config->assetlib->dtable->browse->fieldList['desc']['title']    = $lang->assetlib->desc;
$config->assetlib->dtable->browse->fieldList['desc']['sortType'] = false;
$config->assetlib->dtable->browse->fieldList['desc']['type']     = 'html';
$config->assetlib->dtable->browse->fieldList['desc']['group']    = 2;

$config->assetlib->dtable->browse->fieldList['createdBy']['title']    = $lang->assetlib->createdBy;
$config->assetlib->dtable->browse->fieldList['createdBy']['sortType'] = true;
$config->assetlib->dtable->browse->fieldList['createdBy']['type']     = 'user';
$config->assetlib->dtable->browse->fieldList['createdBy']['width']    = '80';
$config->assetlib->dtable->browse->fieldList['createdBy']['group']    = 5;

$config->assetlib->dtable->browse->fieldList['actions']['title']    = $lang->actions;
$config->assetlib->dtable->browse->fieldList['actions']['type']     = 'actions';
$config->assetlib->dtable->browse->fieldList['actions']['width']    = '60';
$config->assetlib->dtable->browse->fieldList['actions']['fixed']    = 'right';
$config->assetlib->dtable->browse->fieldList['actions']['required'] = true;
$config->assetlib->dtable->browse->fieldList['actions']['sortType'] = false;
$config->assetlib->dtable->browse->fieldList['actions']['list']     = $config->assetlib->browse->actionList;
$config->assetlib->dtable->browse->fieldList['actions']['menu']     = array('edit');

$config->assetlib->dtable->risk = new stdclass();
$config->assetlib->dtable->risk->fieldList['id']['title'] = $lang->idAB;
$config->assetlib->dtable->risk->fieldList['id']['type']  = 'checkID';

$config->assetlib->dtable->risk->fieldList['name']['title'] = $lang->risk->name;
$config->assetlib->dtable->risk->fieldList['name']['type']  = 'title';
$config->assetlib->dtable->risk->fieldList['name']['link']  = array('url' => array('module' => 'assetlib', 'method' => 'riskView', 'params' => 'riskID={id}'));

$config->assetlib->dtable->risk->fieldList['pri']['title']   = $lang->assetlib->priAB;
$config->assetlib->dtable->risk->fieldList['pri']['type']    = 'pri';
$config->assetlib->dtable->risk->fieldList['pri']['priList'] = $lang->risk->priList;

$config->assetlib->dtable->risk->fieldList['status']['title']     = $lang->risk->status;
$config->assetlib->dtable->risk->fieldList['status']['type']      = 'status';
$config->assetlib->dtable->risk->fieldList['status']['statusMap'] = $lang->assetlib->statusList;

$config->assetlib->dtable->risk->fieldList['strategy']['title']    = $lang->risk->strategy;
$config->assetlib->dtable->risk->fieldList['strategy']['type']     = 'category';
$config->assetlib->dtable->risk->fieldList['strategy']['map']      = $lang->risk->strategyList;
$config->assetlib->dtable->risk->fieldList['strategy']['sortType'] = true;

$config->assetlib->dtable->risk->fieldList['createdBy']['title'] = $lang->assetlib->createdBy;
$config->assetlib->dtable->risk->fieldList['createdBy']['type']  = 'user';

$config->assetlib->dtable->risk->fieldList['createdDate']['title'] = $lang->assetlib->createdDate;
$config->assetlib->dtable->risk->fieldList['createdDate']['type']  = 'date';

$config->assetlib->dtable->risk->fieldList['assignedTo']['title'] = $lang->assetlib->approved;
$config->assetlib->dtable->risk->fieldList['assignedTo']['type']  = 'user';

$config->assetlib->dtable->risk->fieldList['approvedDate']['title'] = $lang->assetlib->approvedDate;
$config->assetlib->dtable->risk->fieldList['approvedDate']['type']  = 'date';

$config->assetlib->dtable->risk->fieldList['actions']['title']    = $lang->actions;
$config->assetlib->dtable->risk->fieldList['actions']['minWidth'] = 120;
$config->assetlib->dtable->risk->fieldList['actions']['type']     = 'actions';
$config->assetlib->dtable->risk->fieldList['actions']['menu']     = array('editRisk', 'approveRisk', 'removeRisk');
$config->assetlib->dtable->risk->fieldList['actions']['list']     = $config->assetlib->risk->actionList;

$config->assetlib->dtable->opportunity = new stdclass();
$config->assetlib->dtable->opportunity->fieldList['id']['title'] = $lang->idAB;
$config->assetlib->dtable->opportunity->fieldList['id']['type']  = 'checkID';

$config->assetlib->dtable->opportunity->fieldList['name']['title'] = $lang->opportunity->name;
$config->assetlib->dtable->opportunity->fieldList['name']['type']  = 'title';
$config->assetlib->dtable->opportunity->fieldList['name']['link']  = array('url' => array('module' => 'assetlib', 'method' => 'opportunityView', 'params' => 'opportunityID={id}'));

$config->assetlib->dtable->opportunity->fieldList['pri']['title']   = $lang->assetlib->priAB;
$config->assetlib->dtable->opportunity->fieldList['pri']['type']    = 'pri';
$config->assetlib->dtable->opportunity->fieldList['pri']['priList'] = $lang->opportunity->priList;

$config->assetlib->dtable->opportunity->fieldList['status']['title']     = $lang->opportunity->status;
$config->assetlib->dtable->opportunity->fieldList['status']['type']      = 'status';
$config->assetlib->dtable->opportunity->fieldList['status']['statusMap'] = $lang->assetlib->statusList;

$config->assetlib->dtable->opportunity->fieldList['type']['title']    = $lang->opportunity->type;
$config->assetlib->dtable->opportunity->fieldList['type']['type']     = 'category';
$config->assetlib->dtable->opportunity->fieldList['type']['map']      = $lang->opportunity->typeList;
$config->assetlib->dtable->opportunity->fieldList['type']['sortType'] = true;

$config->assetlib->dtable->opportunity->fieldList['createdBy']['title'] = $lang->assetlib->createdBy;
$config->assetlib->dtable->opportunity->fieldList['createdBy']['type']  = 'user';

$config->assetlib->dtable->opportunity->fieldList['createdDate']['title'] = $lang->assetlib->createdDate;
$config->assetlib->dtable->opportunity->fieldList['createdDate']['type']  = 'date';

$config->assetlib->dtable->opportunity->fieldList['assignedTo']['title'] = $lang->assetlib->approved;
$config->assetlib->dtable->opportunity->fieldList['assignedTo']['type']  = 'user';

$config->assetlib->dtable->opportunity->fieldList['approvedDate']['title'] = $lang->assetlib->approvedDate;
$config->assetlib->dtable->opportunity->fieldList['approvedDate']['type']  = 'date';

$config->assetlib->dtable->opportunity->fieldList['actions']['title']    = $lang->actions;
$config->assetlib->dtable->opportunity->fieldList['actions']['minWidth'] = 120;
$config->assetlib->dtable->opportunity->fieldList['actions']['type']     = 'actions';
$config->assetlib->dtable->opportunity->fieldList['actions']['menu']     = array('editOpportunity', 'approveOpportunity', 'removeOpportunity');
$config->assetlib->dtable->opportunity->fieldList['actions']['list']     = $config->assetlib->opportunity->actionList;

$config->assetlib->dtable->issue = new stdclass();
$config->assetlib->dtable->issue->fieldList['id']['title'] = $lang->idAB;
$config->assetlib->dtable->issue->fieldList['id']['type']  = 'checkID';

$config->assetlib->dtable->issue->fieldList['title']['title'] = $lang->issue->title;
$config->assetlib->dtable->issue->fieldList['title']['type']  = 'title';
$config->assetlib->dtable->issue->fieldList['title']['link']  = array('url' => array('module' => 'assetlib', 'method' => 'issueView', 'params' => 'issueID={id}'));

$config->assetlib->dtable->issue->fieldList['pri']['title']   = $lang->assetlib->priAB;
$config->assetlib->dtable->issue->fieldList['pri']['type']    = 'pri';
$config->assetlib->dtable->issue->fieldList['pri']['priList'] = $lang->issue->priList;

$config->assetlib->dtable->issue->fieldList['severity']['title']        = $lang->issue->severity;
$config->assetlib->dtable->issue->fieldList['severity']['type']         = 'severity';
$config->assetlib->dtable->issue->fieldList['severity']['severityList'] = $lang->issue->severityList;

$config->assetlib->dtable->issue->fieldList['status']['title']     = $lang->issue->status;
$config->assetlib->dtable->issue->fieldList['status']['type']      = 'status';
$config->assetlib->dtable->issue->fieldList['status']['statusMap'] = $lang->assetlib->statusList;

$config->assetlib->dtable->issue->fieldList['type']['title']    = $lang->issue->type;
$config->assetlib->dtable->issue->fieldList['type']['type']     = 'category';
$config->assetlib->dtable->issue->fieldList['type']['map']      = $lang->issue->typeList;
$config->assetlib->dtable->issue->fieldList['type']['sortType'] = true;

$config->assetlib->dtable->issue->fieldList['createdBy']['title'] = $lang->assetlib->createdBy;
$config->assetlib->dtable->issue->fieldList['createdBy']['type']  = 'user';

$config->assetlib->dtable->issue->fieldList['createdDate']['title'] = $lang->assetlib->createdDate;
$config->assetlib->dtable->issue->fieldList['createdDate']['type']  = 'date';

$config->assetlib->dtable->issue->fieldList['assignedTo']['title'] = $lang->assetlib->approved;
$config->assetlib->dtable->issue->fieldList['assignedTo']['type']  = 'user';

$config->assetlib->dtable->issue->fieldList['approvedDate']['title'] = $lang->assetlib->approvedDate;
$config->assetlib->dtable->issue->fieldList['approvedDate']['type']  = 'date';

$config->assetlib->dtable->issue->fieldList['actions']['title']    = $lang->actions;
$config->assetlib->dtable->issue->fieldList['actions']['minWidth'] = 120;
$config->assetlib->dtable->issue->fieldList['actions']['type']     = 'actions';
$config->assetlib->dtable->issue->fieldList['actions']['menu']     = array('editIssue', 'approveIssue', 'removeIssue');
$config->assetlib->dtable->issue->fieldList['actions']['list']     = $config->assetlib->issue->actionList;
