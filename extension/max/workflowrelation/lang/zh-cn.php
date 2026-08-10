<?php
$lang->workflowrelation->common           = '工作流跨流程设置';
$lang->workflowrelation->admin            = '跨流程设置';
$lang->workflowrelation->createForeignKey = '新建';

$lang->workflowrelation->prev       = '前置流程';
$lang->workflowrelation->next       = '后置流程';
$lang->workflowrelation->action     = '动作';
$lang->workflowrelation->foreignKey = '外键';

$lang->workflowrelation->relationActionList['one2one']   = '一个前置流程创建一个后置流程';
$lang->workflowrelation->relationActionList['one2many']  = '一个前置流程创建多个后置流程';
$lang->workflowrelation->relationActionList['many2one']  = '多个前置流程创建一个后置流程';
$lang->workflowrelation->relationActionList['many2many'] = '多个前置流程创建多个后置流程';

$lang->workflowrelation->tableWidth = 900;

/* Tips */
$lang->workflowrelation->tips = new stdclass();
$lang->workflowrelation->tips->foreignKey = '<strong>外键</strong>是后置流程中用来关联显示当前流程数据的字段。设为外键的字段只能选择<strong>文本</strong>或者<strong>数字</strong>类型的字段，保存后系统会将字段类型更新为<strong>整数</strong>，并将已有数据转换为0。';

/* Error */
$lang->workflowrelation->error = new stdclass();
$lang->workflowrelation->error->existNextField  = '该字段已经在%s流程的跨流程设置中使用。';
