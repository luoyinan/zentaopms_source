<?php
$lang->workflowrelation->common           = '工作流跨流程設置';
$lang->workflowrelation->admin            = '跨流程設置';
$lang->workflowrelation->createForeignKey = '新建';

$lang->workflowrelation->prev       = '前置流程';
$lang->workflowrelation->next       = '後置流程';
$lang->workflowrelation->action     = '動作';
$lang->workflowrelation->foreignKey = '外鍵';

$lang->workflowrelation->relationActionList['one2one']   = '一個前置流程創建一個後置流程';
$lang->workflowrelation->relationActionList['one2many']  = '一個前置流程創建多個後置流程';
$lang->workflowrelation->relationActionList['many2one']  = '多個前置流程創建一個後置流程';
$lang->workflowrelation->relationActionList['many2many'] = '多個前置流程創建多個後置流程';

$lang->workflowrelation->tableWidth = 900;

/* Tips */
$lang->workflowrelation->tips = new stdclass();
$lang->workflowrelation->tips->foreignKey = '<strong>外鍵</strong>是後置流程中用來關聯顯示當前流程數據的欄位。設為外鍵的欄位只能選擇<strong>文本</strong>或者<strong>數字</strong>類型的欄位，保存後系統會將欄位類型更新為<strong>整數</strong>，並將已有數據轉換為0。';

/* Error */
$lang->workflowrelation->error = new stdclass();
$lang->workflowrelation->error->existNextField  = '該欄位已經在%s流程的跨流程設置中使用。';
