<?php
$config->marketreport = new stdclass();
$config->marketreport->create = new stdclass();
$config->marketreport->edit   = new stdclass();

$config->marketreport->create->requiredFields = 'name';
$config->marketreport->edit->requiredFields   = $config->marketreport->create->requiredFields;

$config->marketreport->editor = new stdclass();
$config->marketreport->editor->create = array('id' => 'desc', 'tools' => 'simpleTools');
$config->marketreport->editor->edit   = array('id' => 'desc', 'tools' => 'simpleTools');
$config->marketreport->editor->view   = array('id' => 'comment,lastComment', 'tools' => 'simpleTools');
