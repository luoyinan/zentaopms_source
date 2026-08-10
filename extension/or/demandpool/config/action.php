<?php
global $lang;
$config->demandpool->actionList = array();

$config->demandpool->actionList['edit']['icon']       = 'edit';
$config->demandpool->actionList['edit']['text']       = $lang->demandpool->edit;
$config->demandpool->actionList['edit']['hint']       = $lang->demandpool->edit;
$config->demandpool->actionList['edit']['url']        = array('module' => 'demandpool', 'method' => 'edit', 'params' => 'demandpoolID={id}');
$config->demandpool->actionList['edit']['notInModal'] = true;

$config->demandpool->actionList['close']['icon']        = 'off';
$config->demandpool->actionList['close']['text']        = $lang->demandpool->close;
$config->demandpool->actionList['close']['hint']        = $lang->demandpool->close;
$config->demandpool->actionList['close']['url']         = array('module' => 'demandpool', 'method' => 'close', 'params' => 'demandpoolID={id}');
$config->demandpool->actionList['close']['data-toggle'] = 'modal';

$config->demandpool->actionList['activate']['icon']        = 'magic';
$config->demandpool->actionList['activate']['text']        = $lang->demandpool->activate;
$config->demandpool->actionList['activate']['hint']        = $lang->demandpool->activate;
$config->demandpool->actionList['activate']['url']         = array('module' => 'demandpool', 'method' => 'activate', 'params' => 'demandpoolID={id}');
$config->demandpool->actionList['activate']['data-toggle'] = 'modal';

$config->demandpool->actionList['delete']['icon']         = 'trash';
$config->demandpool->actionList['delete']['hint']         = $lang->demandpool->delete;
$config->demandpool->actionList['delete']['text']         = $lang->demandpool->delete;
$config->demandpool->actionList['delete']['url']          = array('module' => 'demandpool', 'method' => 'delete', 'params' => 'demandpoolID={id}&confirm=yes');
$config->demandpool->actionList['delete']['data-confirm'] = array('message' => $lang->demandpool->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
$config->demandpool->actionList['delete']['class']        = 'ajax-submit';
$config->demandpool->actionList['delete']['notInModal']   = true;
