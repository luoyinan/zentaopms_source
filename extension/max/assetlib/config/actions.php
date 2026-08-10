<?php
global $lang, $app;
$app->loadLang('story');
$app->loadLang('opportunity');
$config->assetlib->story = new stdclass();

$config->assetlib->story->actionList = array();
$config->assetlib->story->actionList['editStory']['icon']     = 'edit';
$config->assetlib->story->actionList['editStory']['text']     = $lang->story->edit;
$config->assetlib->story->actionList['editStory']['hint']     = $lang->story->edit;
$config->assetlib->story->actionList['editStory']['url']      = array('module' => 'assetlib', 'method' => 'editStory', 'params' => 'storyID={id}');
$config->assetlib->story->actionList['editStory']['data-app'] = $app->tab;

$config->assetlib->story->actionList['approveStory']['icon']        = 'glasses';
$config->assetlib->story->actionList['approveStory']['text']        = $lang->assetlib->approveStory;
$config->assetlib->story->actionList['approveStory']['hint']        = $lang->assetlib->approveStory;
$config->assetlib->story->actionList['approveStory']['url']         = array('module' => 'assetlib', 'method' => 'approveStory', 'params' => 'storyID={id}', 'onlybody' => true);
$config->assetlib->story->actionList['approveStory']['data-toggle'] = 'modal';
$config->assetlib->story->actionList['approveStory']['data-app']    = $app->tab;

$config->assetlib->story->actionList['removeStory']['icon']         = 'unlink';
$config->assetlib->story->actionList['removeStory']['text']         = $lang->assetlib->removeStory;
$config->assetlib->story->actionList['removeStory']['hint']         = $lang->assetlib->removeStory;
$config->assetlib->story->actionList['removeStory']['url']          = array('module' => 'assetlib', 'method' => 'removeStory', 'params' => 'storyID={id}');
$config->assetlib->story->actionList['removeStory']['className']    = 'ajax-submit';
$config->assetlib->story->actionList['removeStory']['data-confirm'] = $lang->assetlib->confirmDeleteStory;
$config->assetlib->story->actionList['removeStory']['data-app']     = $app->tab;

$config->assetlib->browse = new stdclass();
$config->assetlib->browse->actionList = array();
$config->assetlib->browse->actionList['edit']['icon']     = 'edit';
$config->assetlib->browse->actionList['edit']['text']     = $lang->edit;
$config->assetlib->browse->actionList['edit']['hint']     = $lang->edit;
$config->assetlib->browse->actionList['edit']['url']      = array('module' => 'assetlib', 'method' => 'edit', 'params' => 'id={id}');
$config->assetlib->browse->actionList['edit']['data-app'] = $app->tab;

$config->assetlib->browse->actionList['delete']['icon']         = 'trash';
$config->assetlib->browse->actionList['delete']['text']         = $lang->delete;
$config->assetlib->browse->actionList['delete']['hint']         = $lang->delete;
$config->assetlib->browse->actionList['delete']['url']          = array('module' => 'assetlib', 'method' => 'delete', 'params' => 'id={id}&confirm=yes');
$config->assetlib->browse->actionList['delete']['className']    = 'ajax-submit';
$config->assetlib->browse->actionList['delete']['data-confirm'] = array('message' => '', 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');

$config->assetlib->actions = new stdclass();
$config->assetlib->actions->view = array();
$config->assetlib->actions->view['mainActions']   = array('edit', 'delete');
$config->assetlib->actions->view['suffixActions'] = array();

$config->assetlib->risk = new stdclass();
$config->assetlib->risk->actionList = array();

$config->assetlib->risk->actionList = array();
$config->assetlib->risk->actionList['editRisk']['icon'] = 'edit';
$config->assetlib->risk->actionList['editRisk']['text'] = $lang->assetlib->editRisk;
$config->assetlib->risk->actionList['editRisk']['hint'] = $lang->assetlib->editRisk;
$config->assetlib->risk->actionList['editRisk']['url']  = array('module' => 'assetlib', 'method' => 'editRisk', 'params' => 'riskID={id}');

$config->assetlib->risk->actionList['approveRisk']['icon']        = 'glasses';
$config->assetlib->risk->actionList['approveRisk']['text']        = $lang->assetlib->approveRisk;
$config->assetlib->risk->actionList['approveRisk']['hint']        = $lang->assetlib->approveRisk;
$config->assetlib->risk->actionList['approveRisk']['url']         = array('module' => 'assetlib', 'method' => 'approveRisk', 'params' => 'riskID={id}');
$config->assetlib->risk->actionList['approveRisk']['data-toggle'] = 'modal';

$config->assetlib->risk->actionList['removeRisk']['icon']         = 'unlink';
$config->assetlib->risk->actionList['removeRisk']['text']         = $lang->assetlib->removeRisk;
$config->assetlib->risk->actionList['removeRisk']['hint']         = $lang->assetlib->removeRisk;
$config->assetlib->risk->actionList['removeRisk']['url']          = array('module' => 'assetlib', 'method' => 'removeRisk', 'params' => 'riskID={id}');
$config->assetlib->risk->actionList['removeRisk']['className']    = 'ajax-submit';
$config->assetlib->risk->actionList['removeRisk']['data-confirm'] = $lang->assetlib->confirmDeleteRisk;
$config->assetlib->risk->actionList['removeRisk']['data-app']     = $app->tab;

$config->assetlib->issue = new stdclass();
$config->assetlib->issue->actionList = array();

$config->assetlib->issue->actionList = array();
$config->assetlib->issue->actionList['editIssue']['icon'] = 'edit';
$config->assetlib->issue->actionList['editIssue']['text'] = $lang->assetlib->editIssue;
$config->assetlib->issue->actionList['editIssue']['hint'] = $lang->assetlib->editIssue;
$config->assetlib->issue->actionList['editIssue']['url']  = array('module' => 'assetlib', 'method' => 'editIssue', 'params' => 'issueID={id}');

$config->assetlib->issue->actionList['approveIssue']['icon']        = 'glasses';
$config->assetlib->issue->actionList['approveIssue']['text']        = $lang->assetlib->approveIssue;
$config->assetlib->issue->actionList['approveIssue']['hint']        = $lang->assetlib->approveIssue;
$config->assetlib->issue->actionList['approveIssue']['url']         = array('module' => 'assetlib', 'method' => 'approveIssue', 'params' => 'issueID={id}');
$config->assetlib->issue->actionList['approveIssue']['data-toggle'] = 'modal';

$config->assetlib->issue->actionList['removeIssue']['icon']         = 'unlink';
$config->assetlib->issue->actionList['removeIssue']['text']         = $lang->assetlib->removeIssue;
$config->assetlib->issue->actionList['removeIssue']['hint']         = $lang->assetlib->removeIssue;
$config->assetlib->issue->actionList['removeIssue']['url']          = array('module' => 'assetlib', 'method' => 'removeIssue', 'params' => 'issueID={id}');
$config->assetlib->issue->actionList['removeIssue']['className']    = 'ajax-submit';
$config->assetlib->issue->actionList['removeIssue']['data-confirm'] = $lang->assetlib->confirmDeleteIssue;
$config->assetlib->issue->actionList['removeIssue']['data-app']     = $app->tab;

$config->assetlib->opportunity = new stdclass();
$config->assetlib->opportunity->actionList = array();

$config->assetlib->opportunity->actionList['editOpportunity']['icon'] = 'edit';
$config->assetlib->opportunity->actionList['editOpportunity']['text'] = $lang->assetlib->editOpportunity;
$config->assetlib->opportunity->actionList['editOpportunity']['hint'] = $lang->assetlib->editOpportunity;
$config->assetlib->opportunity->actionList['editOpportunity']['url']  = array('module' => 'assetlib', 'method' => 'editOpportunity', 'params' => 'opportunityID={id}');

$config->assetlib->opportunity->actionList['approveOpportunity']['icon']        = 'glasses';
$config->assetlib->opportunity->actionList['approveOpportunity']['text']        = $lang->assetlib->approveOpportunity;
$config->assetlib->opportunity->actionList['approveOpportunity']['hint']        = $lang->assetlib->approveOpportunity;
$config->assetlib->opportunity->actionList['approveOpportunity']['url']         = array('module' => 'assetlib', 'method' => 'approveOpportunity', 'params' => 'opportunityID={id}');
$config->assetlib->opportunity->actionList['approveOpportunity']['data-toggle'] = 'modal';

$config->assetlib->opportunity->actionList['removeOpportunity']['icon']         = 'unlink';
$config->assetlib->opportunity->actionList['removeOpportunity']['text']         = $lang->assetlib->removeOpportunity;
$config->assetlib->opportunity->actionList['removeOpportunity']['hint']         = $lang->assetlib->removeOpportunity;
$config->assetlib->opportunity->actionList['removeOpportunity']['url']          = array('module' => 'assetlib', 'method' => 'removeOpportunity', 'params' => 'opportunityID={id}');
$config->assetlib->opportunity->actionList['removeOpportunity']['className']    = 'ajax-submit';
$config->assetlib->opportunity->actionList['removeOpportunity']['data-confirm'] = $lang->assetlib->confirmDeleteOpportunity;
$config->assetlib->opportunity->actionList['removeOpportunity']['data-app']     = $app->tab;
