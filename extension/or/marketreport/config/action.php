<?php
global $lang;
$config->marketreport->actionList = array();

$config->marketreport->actionList['edit']['icon']       = 'edit';
$config->marketreport->actionList['edit']['text']       = $lang->marketreport->edit;
$config->marketreport->actionList['edit']['hint']       = $lang->marketreport->edit;
$config->marketreport->actionList['edit']['url']        = array('module' => 'marketreport', 'method' => 'edit', 'params' => 'marketreportID={id}&fromMarket={fromMarket}');
$config->marketreport->actionList['edit']['notInModal'] = true;

$config->marketreport->actionList['publish']['icon']         = 'publish';
$config->marketreport->actionList['publish']['text']         = $lang->marketreport->publish;
$config->marketreport->actionList['publish']['hint']         = $lang->marketreport->publish;
$config->marketreport->actionList['publish']['url']          = array('module' => 'marketreport', 'method' => 'publish', 'params' => 'marketreportID={id}&confirm=yes');
$config->marketreport->actionList['publish']['data-confirm'] = array('message' => $lang->marketreport->confirmPublish, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
$config->marketreport->actionList['publish']['class']        = 'ajax-submit';

$config->marketreport->actionList['delete']['icon']         = 'trash';
$config->marketreport->actionList['delete']['hint']         = $lang->marketreport->delete;
$config->marketreport->actionList['delete']['text']         = $lang->marketreport->delete;
$config->marketreport->actionList['delete']['url']          = array('module' => 'marketreport', 'method' => 'delete', 'params' => 'marketreportID={id}&confirm=yes');
$config->marketreport->actionList['delete']['data-confirm'] = array('message' => $lang->marketreport->confirmDelete, 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x');
$config->marketreport->actionList['delete']['class']        = 'ajax-submit';
$config->marketreport->actionList['delete']['notInModal']   = true;
