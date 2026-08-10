<?php
$lang->execution->template        = $lang->projectCommon . '模板';
$lang->execution->finish          = '完成';
$lang->execution->program         = '所属' . $lang->projectCommon;
$lang->execution->taskCount       = '任务数量';
$lang->execution->deliverable     = '维护交付物';
$lang->execution->deliverableAbbr = '交付物';
$lang->execution->whenClosedTips  = '（执行未关闭时，不会对关闭时的交付物进行严格校验）';

$lang->execution->enter = '进入';
$lang->execution->draft = '草稿';

$lang->execution->cannotCloseByDeliverable = "部分执行已关闭，进行中的执行因未提交交付物无法批量关闭。\n 以下执行无法关闭：\n %s";
$lang->execution->closeExecutionError      = "无法关闭未提交交付物的执行。";
$lang->execution->notClose                 = "无法关闭该执行";
$lang->execution->cannotAutoCloseParent    = "检测到父执行有未上传、未评审通过或未确认的交付物，无法自动关闭，是否手动关闭父执行？";

$lang->execution->action->managedeliverable = '$date, 由 <strong>$actor</strong> 维护交付物。' . "\n";

$lang->execution->minBuffering       = $lang->execution->common . '最小间隔';
$lang->execution->autoScheduleAction = '执行自动排期';
$lang->execution->scheduleFail       = '排期后执行与项目计划起止日期冲突，请调整执行工期或项目工期。';
$lang->execution->dateConflictTip    = '任务的计划起止日期超出了执行的计划起止日期，请对任务排期进行调整。';
$lang->execution->toAdjust           = '去调整';
$lang->execution->know               = '知道了';
$lang->execution->schedule           = "{$lang->execution->common}工期日历";
$lang->execution->autoSchedule       = '自动排期';

$lang->execution->globalScheduleSuccess = '全局排期成功';
$lang->execution->scheduleDataEmpty     = '暂时没有任务，无法使用自动排期。';

$lang->execution->gantt->lagDays = '滞后天数';
