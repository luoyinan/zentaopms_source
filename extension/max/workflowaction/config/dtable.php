<?php
global $lang;
$config->workflowaction->dtable = new stdclass();

$config->workflowaction->dtable->fieldList['sort']['name']     = 'sort';
$config->workflowaction->dtable->fieldList['sort']['title']    = $lang->sort;
$config->workflowaction->dtable->fieldList['sort']['type']     = 'html';
$config->workflowaction->dtable->fieldList['sort']['fixed']    = 'left';
$config->workflowaction->dtable->fieldList['sort']['width']    = 50;
$config->workflowaction->dtable->fieldList['sort']['sortType'] = false;

$config->workflowaction->dtable->fieldList['name']['name']     = 'name';
$config->workflowaction->dtable->fieldList['name']['title']    = $lang->workflowaction->name;
$config->workflowaction->dtable->fieldList['name']['type']     = 'html';
$config->workflowaction->dtable->fieldList['name']['width']    = 200;
$config->workflowaction->dtable->fieldList['name']['sortType'] = false;

$config->workflowaction->dtable->fieldList['action']['name']     = 'action';
$config->workflowaction->dtable->fieldList['action']['title']    = $lang->workflowaction->action;
$config->workflowaction->dtable->fieldList['action']['type']     = 'text';
$config->workflowaction->dtable->fieldList['action']['sortType'] = false;

$config->workflowaction->dtable->fieldList['buildin']['name']     = 'buildin';
$config->workflowaction->dtable->fieldList['buildin']['title']    = $lang->workflowaction->buildin;
$config->workflowaction->dtable->fieldList['buildin']['type']     = 'html';
$config->workflowaction->dtable->fieldList['buildin']['width']    = 60;
$config->workflowaction->dtable->fieldList['buildin']['align']    = 'center';
$config->workflowaction->dtable->fieldList['buildin']['sortType'] = false;

$config->workflowaction->dtable->fieldList['extensionType']['name']     = 'extensionType';
$config->workflowaction->dtable->fieldList['extensionType']['title']    = $lang->workflowaction->extensionType;
$config->workflowaction->dtable->fieldList['extensionType']['type']     = 'text';
$config->workflowaction->dtable->fieldList['extensionType']['width']    = 80;
$config->workflowaction->dtable->fieldList['extensionType']['align']    = 'center';
$config->workflowaction->dtable->fieldList['extensionType']['map']      = $lang->workflowaction->extensionTypeList;
$config->workflowaction->dtable->fieldList['extensionType']['sortType'] = false;

$config->workflowaction->dtable->fieldList['actions']['name']     = 'actions';
$config->workflowaction->dtable->fieldList['actions']['title']    = $lang->actions;
$config->workflowaction->dtable->fieldList['actions']['type']     = 'actions';
$config->workflowaction->dtable->fieldList['actions']['fixed']    = 'right';
$config->workflowaction->dtable->fieldList['actions']['width']    = 200;
$config->workflowaction->dtable->fieldList['actions']['menu']     = array('edit', 'layout', 'condition', 'setVerification', 'hook', 'setNotice', 'setJS', 'setCSS', 'delete');
$config->workflowaction->dtable->fieldList['actions']['list']     = array(
    'edit' => array(
        'hint'        => $lang->edit,
        'icon'        => 'edit',
        'url'         => array('module' => 'workflowaction', 'method' => 'edit', 'params' => "id={id}"),
        'data-toggle' => 'modal'
    ),
    'layout' => array(
        'hint'        => $lang->workflowaction->layout,
        'icon'        => 'layout',
        'url'         => array('module' => 'workflowlayout', 'method' => 'admin', 'params' => "module={module}&action={action}"),
        'data-toggle' => 'modal',
        'data-size'   => 'lg'
    ),
    'condition' => array(
        'hint'        => $lang->workflowaction->condition,
        'icon'        => 'trigger',
        'url'         => array('module' => 'workflowcondition', 'method' => 'browse', 'params' => "action={id}"),
        'data-id'     => 'conditionBrowse',
        'data-toggle' => 'modal'
    ),
    'setVerification' => array(
        'hint'        => $lang->workflowaction->setVerification,
        'icon'        => 'change',
        'url'         => array('module' => 'workflowaction', 'method' => 'setVerification', 'params' => "action={id}"),
        'data-toggle' => 'modal'
    ),
    'hook' => array(
        'hint'        => $lang->workflowaction->hook,
        'icon'        => 'flow',
        'url'         => array('module' => 'workflowhook', 'method' => 'browse', 'params' => "action={id}"),
        'data-id'     => 'hookBrowse',
        'data-toggle' => 'modal',
        'data-size'   => 'lg'
    ),
    'setNotice' => array(
        'hint'        => $lang->workflowaction->setNotice,
        'icon'        => 'bell',
        'url'         => array('module' => 'workflowaction', 'method' => 'setNotice', 'params' => "action={id}"),
        'data-toggle' => 'modal'
    ),
    'setJS' => array(
        'hint'        => $lang->workflowaction->setJS,
        'icon'        => 'code',
        'url'         => array('module' => 'workflowaction', 'method' => 'setJS', 'params' => "action={id}"),
        'data-toggle' => 'modal'
    ),
    'setCSS' => array(
        'hint'        => $lang->workflowaction->setCSS,
        'icon'        => 'file-code',
        'url'         => array('module' => 'workflowaction', 'method' => 'setCSS', 'params' => "action={id}"),
        'data-toggle' => 'modal'
    ),
    'delete' => array(
        'hint'         => $lang->delete,
        'icon'         => 'trash',
        'url'          => array('module' => 'workflowaction', 'method' => 'delete', 'params' => "action={id}"),
        'className'    => 'form-ajax',
        'data-confirm' => $lang->confirmDelete
    )
);
$config->workflowaction->dtable->fieldList['actions']['sortType'] = false;
