<?php
global $app, $lang;
$app->loadLang('workflow');

$config->workflow->dtable = new stdclass();
$config->workflow->dtable->fieldList['id']['title']    = $lang->idAB;
$config->workflow->dtable->fieldList['id']['type']     = 'id';
$config->workflow->dtable->fieldList['id']['sortType'] = true;

$config->workflow->dtable->fieldList['name']['title']       = $lang->workflow->name;
$config->workflow->dtable->fieldList['name']['link']        = ['module' => 'workflow', 'method' => 'view', 'params' => 'id={id}'];
$config->workflow->dtable->fieldList['name']['data-toggle'] = 'modal';
$config->workflow->dtable->fieldList['name']['width']       = '200px';
$config->workflow->dtable->fieldList['name']['sortType']    = true;

$config->workflow->dtable->fieldList['module']['title']    = $lang->workflow->module;
$config->workflow->dtable->fieldList['module']['width']    = '200px';
$config->workflow->dtable->fieldList['module']['sortType'] = true;

$config->workflow->dtable->fieldList['navigator']['title']    = $lang->workflow->navigator;
$config->workflow->dtable->fieldList['navigator']['map']      = $lang->workflow->navigators;
$config->workflow->dtable->fieldList['navigator']['align']    = 'center';
$config->workflow->dtable->fieldList['navigator']['width']    = '100px';
$config->workflow->dtable->fieldList['navigator']['sortType'] = true;

$config->workflow->dtable->fieldList['app']['title']    = $lang->workflow->app;
$config->workflow->dtable->fieldList['app']['align']    = 'center';
$config->workflow->dtable->fieldList['app']['width']    = '100px';
$config->workflow->dtable->fieldList['app']['hint']     = true;
$config->workflow->dtable->fieldList['app']['sortType'] = true;

$config->workflow->dtable->fieldList['buildin']['title']    = $lang->workflow->buildin;
$config->workflow->dtable->fieldList['buildin']['align']    = 'center';
$config->workflow->dtable->fieldList['buildin']['width']    = '80px';
$config->workflow->dtable->fieldList['buildin']['sortType'] = true;

$config->workflow->dtable->fieldList['status']['title']     = $lang->workflow->status;
$config->workflow->dtable->fieldList['status']['type']      = 'status';
$config->workflow->dtable->fieldList['status']['statusMap'] = $lang->workflow->statusList;

$config->workflow->dtable->fieldList['desc']['title'] = $lang->workflow->desc;
$config->workflow->dtable->fieldList['desc']['type']  = 'desc';

$config->workflow->dtable->fieldList['actions']['title'] = $lang->actions;
$config->workflow->dtable->fieldList['actions']['type']  = 'actions';
$config->workflow->dtable->fieldList['actions']['menu']  = ['edit', 'design|field', 'release|deactivate|activate', 'copy', 'delete'];
$config->workflow->dtable->fieldList['actions']['list']  = $config->workflow->actionList;

$app->loadLang('workflowfield');
$workflowGroupID = (int)$app->session->workflowGroupID;

$config->workflow->dtable->browseDB = array();
$config->workflow->dtable->browseDB['name'] = array(
    'name'  => 'name',
    'title' => $lang->workflowtable->name,
    'width' => '90px',
);
$config->workflow->dtable->browseDB['module'] = array(
    'name'  => 'module',
    'title' => $lang->workflowtable->module,
    'width' => '90px',
);
$config->workflow->dtable->browseDB['groupName'] = array(
    'name'  => 'groupName',
    'title' => $lang->workflowfield->group,
    'width' => '100px',
);
$config->workflow->dtable->browseDB['desc'] = array(
    'name'  => 'desc',
    'title' => $lang->workflow->desc,
    'type'  => 'desc',
);
$config->workflow->dtable->browseDB['actions'] = array(
    'name'   => 'actions',
    'title'  => $lang->actions,
    'type'   => 'actions',
    'width'  => '100px',
    'align'  => 'center',
    'menu'   => array('browseDBFields', 'browseDBEdit', 'browseDBDelete'),
    'list'   => array(
        'browseDBFields' => array(
            'icon' => 'list',
            'text' => '',
            'hint' => $lang->workflow->field,
            'url'  => array(
                'module' => 'workflowfield',
                'method' => 'browse',
                'params' => "module={module}&order=order&groupID={$workflowGroupID}",
            ),
        ),
        'browseDBEdit' => array(
            'icon'        => 'edit',
            'text'        => '',
            'hint'        => $lang->edit,
            'url'         => array('module' => 'workflow', 'method' => 'edit', 'params' => 'id={id}'),
            'data-toggle' => 'modal',
            'data-size'   => 'sm'
        ),
        'browseDBDelete'   => array(
            'icon'         => 'trash',
            'text'         => '',
            'hint'         => $lang->delete,
            'url'          => array('module' => 'workflow', 'method' => 'delete', 'params' => 'id={id}'),
            'className'    => 'ajax-submit',
            'data-confirm' => $lang->confirmDelete
        ),
    ),
);
