<?php
$config->assetlib->form = new stdclass();

$config->assetlib->form->create = array();
$config->assetlib->form->create['name'] = array('required' => true,  'type' => 'string', 'filter' => 'trim');
$config->assetlib->form->create['desc'] = array('required' => false, 'type' => 'string', 'filter' => 'trim');

$config->assetlib->form->edit = array();
$config->assetlib->form->edit['name'] = array('required' => true,  'type' => 'string', 'filter' => 'trim');
$config->assetlib->form->edit['desc'] = array('required' => false, 'type' => 'string', 'filter' => 'trim');
