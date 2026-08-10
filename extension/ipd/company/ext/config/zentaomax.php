<?php
global $lang;

$tableField = array();
foreach($config->company->user->dtable->fieldList as $key => $fieldList)
{
    $tableField[$key] = $fieldList;
    if($key == 'role')
    {
        $tableField['superior']['name']       = 'superior';
        $tableField['superior']['title']      = $lang->user->superior;
        $tableField['superior']['type']       = 'user';
        $tableField['superior']['sortType']   = true;
        $tableField['superior']['width']      = '100';
        $tableField['superior']['group']      = '3';
        $tableField['superior']['dataSource'] = array('module' => 'user', 'method' => 'getPairs', 'params' => 'noletter|nodeleted|noclosed');
    }
}
$config->company->user->dtable->fieldList = $tableField;
$config->company->user->dtable->fieldList['superior']['required'] = true;
$config->company->user->dtable->fieldList['superior']['show']     = true;

$defaultField = array();
foreach($config->company->user->dtable->defaultField as $field)
{
    $defaultField[] = $field;
    if($field == 'role' && !in_array('superior', $config->company->user->dtable->defaultField)) $defaultField[] = 'superior';
}
$config->company->user->dtable->defaultField = $defaultField;
if(!in_array('superior', $config->company->user->dtable->requiredFields)) $config->company->user->dtable->requiredFields[] = 'superior';
$config->company->browse->dtable = $config->company->user->dtable;

$config->company->browse->search['fields']['superior'] = $lang->user->superior;
$config->company->browse->search['params']['superior'] = array('operator' => '=', 'control' => 'select', 'values' => 'users');
