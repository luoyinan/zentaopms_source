<?php
$lang->workflowhook->common = 'Workflow Extended Action';
$lang->workflowhook->browse = 'Extended Actions';
$lang->workflowhook->create = 'Create Ext Action';
$lang->workflowhook->edit   = 'Edit Ext Action';
$lang->workflowhook->delete = 'Delete Ext Action';

$lang->workflowhook->condition = 'Condition';
$lang->workflowhook->hook      = 'Ext Action';
$lang->workflowhook->type      = 'Type';
$lang->workflowhook->result    = 'Result';
$lang->workflowhook->sql       = 'SQL';
$lang->workflowhook->varName   = 'Var Name';
$lang->workflowhook->varValue  = 'Var Value';
$lang->workflowhook->action    = 'Action';
$lang->workflowhook->table     = 'Table';
$lang->workflowhook->field     = 'Field';
$lang->workflowhook->value     = 'Value';
$lang->workflowhook->where     = 'Where';
$lang->workflowhook->message   = 'Message';

$lang->workflowhook->confirmDelete = 'Are you sure you want to perform the deletion operation?';

$lang->workflowhook->tables['product']     = $lang->productCommon;
$lang->workflowhook->tables['project']     = $lang->executionCommon;
$lang->workflowhook->tables['storyspec']   = 'Story Describe';
$lang->workflowhook->tables['file']        = 'File';
$lang->workflowhook->tables['action']      = 'History';
$lang->workflowhook->tables['attend']      = 'Attend';
$lang->workflowhook->tables['branch']      = 'Platform/Branch';
$lang->workflowhook->tables['deploy']      = 'Deploy';
$lang->workflowhook->tables['dept']        = 'Department';
$lang->workflowhook->tables['effort']      = 'Log';
$lang->workflowhook->tables['faq']         = 'FAQ';
$lang->workflowhook->tables['holiday']     = 'Holiday';
$lang->workflowhook->tables['host']        = 'Host';
$lang->workflowhook->tables['leave']       = 'Leave';
$lang->workflowhook->tables['lieu']        = 'Lieu';
$lang->workflowhook->tables['makeup']      = 'Makeup';
$lang->workflowhook->tables['overtime']    = 'Overtime';
$lang->workflowhook->tables['score']       = 'Point';
$lang->workflowhook->tables['serverroom']  = 'IDC';
$lang->workflowhook->tables['service']     = 'Service';
$lang->workflowhook->tables['testreport']  = 'Report';
$lang->workflowhook->tables['todo']        = 'Todo';
$lang->workflowhook->tables['trip']        = 'Trip';
$lang->workflowhook->tables['user']        = 'User';

$lang->workflowhook->typeList['data'] = 'Data as condition';
$lang->workflowhook->typeList['sql']  = 'SQL as condition';

$lang->workflowhook->resultList['empty']    = 'Execute extended action when result is empty or zero.';
$lang->workflowhook->resultList['notempty'] = 'Execute extended action when result is not empty nor zero.';

$lang->workflowhook->logicalOperatorList['and'] = 'And';
$lang->workflowhook->logicalOperatorList['or']  = 'Or';

$lang->workflowhook->actionList['insert'] = 'Insert';
$lang->workflowhook->actionList['update'] = 'Update';
$lang->workflowhook->actionList['delete'] = 'Delete';

$lang->workflowhook->options['currentUser'] = 'User';
$lang->workflowhook->options['currentDept'] = 'Dept';
$lang->workflowhook->options['deptManager'] = 'Dept Manager';
$lang->workflowhook->options['actor']       = 'Operated User';
$lang->workflowhook->options['today']       = 'Operated Date';
$lang->workflowhook->options['now']         = 'Operated Time';
$lang->workflowhook->options['formula']     = 'Formula';

$lang->workflowhook->placeholder = new stdclass();
$lang->workflowhook->placeholder->sql = 'Write a SQL query. Only the query is allowed.';

$lang->workflowhook->error = new stdclass();
$lang->workflowhook->error->wrongSQL = 'The SQL is wrong! Error: ';

/* Formula */
$lang->workflowhook->formula = new stdclass();
$lang->workflowhook->formula->common    = 'Expression';
$lang->workflowhook->formula->target    = 'Target';
$lang->workflowhook->formula->operator  = 'Operator';
$lang->workflowhook->formula->numbers   = 'Number';
$lang->workflowhook->formula->clearLast = 'Delete';
$lang->workflowhook->formula->clearAll  = 'Delete All';
$lang->workflowhook->formula->set       = 'Setting';

$lang->workflowhook->formula->functions['sum']     = 'Total_%s_%s';
$lang->workflowhook->formula->functions['average'] = 'Average_%s_%s';
$lang->workflowhook->formula->functions['max']     = 'Max_%s_%s';
$lang->workflowhook->formula->functions['min']     = 'Min_%s_%s';
$lang->workflowhook->formula->functions['count']   = 'Quantity_%s_%s';

$lang->workflowhook->formula->error = new stdclass();
$lang->workflowhook->formula->error->empty = 'Expression can not be empty.';
$lang->workflowhook->formula->error->error = 'Expression is not correct.';
