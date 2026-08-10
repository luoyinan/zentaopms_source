<?php
$lang->execution->template        = $lang->projectCommon . '模板';
$lang->execution->finish          = '完成';
$lang->execution->program         = '所屬' . $lang->projectCommon;
$lang->execution->taskCount       = '任務數量';
$lang->execution->deliverable     = '維護交付物';
$lang->execution->deliverableAbbr = '交付物';
$lang->execution->whenClosedTips  = '（執行未關閉時，不會對關閉時的交付物進行嚴格校驗）';

$lang->execution->enter = '進入';
$lang->execution->draft = '草稿';

$lang->execution->cannotCloseByDeliverable = "部分執行已關閉，進行中的執行因未提交交付物無法批量關閉。\n 以下執行無法關閉：\n %s";
$lang->execution->closeExecutionError      = "無法關閉未提交交付物的執行。";
$lang->execution->notClose                 = "無法關閉該執行";
$lang->execution->cannotAutoCloseParent    = "檢測到父執行有未上傳、未評審通過或未確認的交付物，無法自動關閉，是否手動關閉父執行？";

$lang->execution->action->managedeliverable = '$date, 由 <strong>$actor</strong> 維護交付物。' . "\n";

$lang->execution->minBuffering       = $lang->execution->common . '最小間隔';
$lang->execution->autoScheduleAction = '執行自動排期';
$lang->execution->scheduleFail       = '排期後執行與項目計划起止日期衝突，請調整執行工期或項目工期。';
$lang->execution->dateConflictTip    = '任務的計划起止日期超出了執行的計划起止日期，請對任務排期進行調整。';
$lang->execution->toAdjust           = '去調整';
$lang->execution->know               = '知道了';
$lang->execution->schedule           = "{$lang->execution->common}工期日曆";
$lang->execution->autoSchedule       = '自動排期';

$lang->execution->globalScheduleSuccess = '全局排期成功';
$lang->execution->scheduleDataEmpty     = '暫時沒有任務，無法使用自動排期。';

$lang->execution->gantt->lagDays = '滯後天數';
