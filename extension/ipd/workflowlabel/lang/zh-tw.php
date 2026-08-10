<?php
$lang->workflowlabel->common   = '工作流標籤';
$lang->workflowlabel->browse   = '所有標籤';
$lang->workflowlabel->create   = '新增標籤';
$lang->workflowlabel->edit     = '編輯標籤';
$lang->workflowlabel->delete   = '刪除標籤';
$lang->workflowlabel->sort     = '標籤排序';
$lang->workflowlabel->search   = '搜索';
$lang->workflowlabel->settings = '標籤及屬性設置';

$lang->workflowlabel->id          = '編號';
$lang->workflowlabel->module      = '所屬模組';
$lang->workflowlabel->label       = '檢索標籤';
$lang->workflowlabel->params      = '檢索條件';
$lang->workflowlabel->type        = '條件類型';
$lang->workflowlabel->sql         = 'SQL條件';
$lang->workflowlabel->order       = '順序';
$lang->workflowlabel->orderBy     = '數據排序';
$lang->workflowlabel->buildin     = '內置';
$lang->workflowlabel->createdBy   = '由誰創建';
$lang->workflowlabel->createdDate = '創建日期';
$lang->workflowlabel->editedBy    = '由誰編輯';
$lang->workflowlabel->editedDate  = '編輯日期';

$lang->workflowlabel->operatorList['equal']      = '=';
$lang->workflowlabel->operatorList['notequal']   = '!=';
$lang->workflowlabel->operatorList['gt']         = '>';
$lang->workflowlabel->operatorList['ge']         = '>=';
$lang->workflowlabel->operatorList['lt']         = '<';
$lang->workflowlabel->operatorList['le']         = '<=';
$lang->workflowlabel->operatorList['include']    = '包含';
$lang->workflowlabel->operatorList['notinclude'] = '不包含';
$lang->workflowlabel->operatorList['between']    = '介於';

$lang->workflowlabel->typeList['data'] = '以數據定義條件';
$lang->workflowlabel->typeList['sql']  = '以SQL語句定義條件';

$lang->workflowlabel->orderTypeList['asc']  = '正序';
$lang->workflowlabel->orderTypeList['desc'] = '倒序';

$lang->workflowlabel->buildinList['0'] = '否';
$lang->workflowlabel->buildinList['1'] = '是';

$lang->workflowlabel->confirmDelete = '您確定要執行刪除操作嗎？';

$lang->workflowlabel->default = new stdclass();
$lang->workflowlabel->default->labels['all'] = '全部';

$lang->workflowlabel->approval = new stdclass();
$lang->workflowlabel->approval->labels['review']     = '待審批';
$lang->workflowlabel->approval->labels['reviewedby'] = '我評審';

$lang->workflowlabel->error = new stdclass();
$lang->workflowlabel->error->emptyParams = '檢索條件不能為空！';
$lang->workflowlabel->error->emptySQL    = '請輸入SQL條件語句';
$lang->workflowlabel->error->unsafeSQL   = 'SQL條件包含不允許使用的語法，請檢查後重試。';
$lang->workflowlabel->error->invalidSQL  = 'SQL條件無效，可能是欄位名已發生修改，或SQL語句不合法，請檢查後重試。';

$lang->workflowlabel->placeholder = new stdclass();
$lang->workflowlabel->placeholder->sql = '請輸入SQL條件語句，例如：status = "doing"';

$lang->workflowlabel->tips = new stdclass();
$lang->workflowlabel->tips->known    = '知道了';
$lang->workflowlabel->tips->features = '在流程的列表頁可以通過標籤瀏覽不同的數據。';
