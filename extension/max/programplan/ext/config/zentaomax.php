<?php
$config->programplan->datatable->defaultField = array('id', 'name', 'percent', 'attribute', 'begin', 'end', 'realBegan', 'realEnd', 'actions');

$config->programplan->form->create['days']     = array('label' => '', 'type' => 'string', 'control' => 'text',   'required' => false, 'default' => 0);
$config->programplan->form->create['schedule'] = array('label' => '', 'type' => 'string', 'control' => 'editor', 'required' => false, 'default' => '');

$config->programplan->form->edit['days']     = array('label' => '', 'type' => 'string', 'control' => 'text',   'required' => false, 'default' => 0);
$config->programplan->form->edit['schedule'] = array('label' => '', 'type' => 'string', 'control' => 'editor', 'required' => false, 'default' => '');
