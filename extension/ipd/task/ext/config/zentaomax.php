<?php
$config->task->form->create['design'] = array('type' => 'int', 'required' => false, 'default' => 0);
$config->task->form->edit['design']   = array('type' => 'int', 'required' => false, 'default' => 0);

$config->task->form->autoSchedule = array();
$config->task->form->autoSchedule['id']         = array('type' => 'int',  'required' => false, 'base' => true);
$config->task->form->autoSchedule['estStarted'] = array('type' => 'date', 'required' => false, 'default' => null);
$config->task->form->autoSchedule['deadline']   = array('type' => 'date', 'required' => false, 'default' => null);
