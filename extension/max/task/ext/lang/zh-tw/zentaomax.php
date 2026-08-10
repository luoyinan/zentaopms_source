<?php
$lang->task->design              = '相關設計';
$lang->task->designChanged       = '設計變更';
$lang->task->confirmDesignChange = '確認設計變更';

$lang->task->autoSchedule       = '自動排期';
$lang->task->globalSchedule     = '全局排期';
$lang->task->autoScheduleAction = '任務自動排期';
$lang->task->adjust             = '調整';

$lang->task->minBuffering  = '最小間隔';
$lang->task->preEstStarted = '原預計開始';
$lang->task->preDeadline   = '原截止日期';
$lang->task->preLeftDays   = '原剩餘可用工作日';
$lang->task->leftDays      = '剩餘可用工作日';
$lang->task->scheduleFail  = "排期後任務{#%s}的計劃截止%s超出執行計劃完成%s，請調整任務工期或執行工期。";
$lang->task->hasConflict   = '任務關係存在異常，請先去調整任務關係。';

$lang->task->schedule = new stdclass();
$lang->task->schedule->autoMode   = '啟用局部排期';
$lang->task->schedule->globalMode = '啟用全局排期';

$lang->task->gantt->notice->withLagDays = new stdclass();
$lang->task->gantt->notice->withLagDays->notSS = "任務：“%s”開始之後%s天，該任務才能開始！";
$lang->task->gantt->notice->withLagDays->notFS = "任務：“%s”結束之後%s天，該任務才能開始！";
$lang->task->gantt->notice->withLagDays->notSF = "任務：“%s”開始之後%s天，該任務才能結束！";
$lang->task->gantt->notice->withLagDays->notFF = "任務：“%s”結束之後%s天，該任務才能結束！";

$lang->task->confirmTips = new stdclass();
$lang->task->confirmTips->delay                 = "預計開始晚于截止日期，是否將截止日期順延%s天，調整為%s？";
$lang->task->confirmTips->notDelayOfExecution   = "預計開始晚于截止日期，若將截止日期順延%s天，將晚于執行計劃完成日期，請重新調整預計開始。";
$lang->task->confirmTips->notDelayOfPreTask     = "預計開始晚于截止日期，若將截止日期順延%s天，將超出前置任務#%s的依賴日期+最小間隔天數，請重新調整預計開始。";
$lang->task->confirmTips->advance               = "截止日期早于預計開始，是否將預計開始提前%s天，調整為%s？";
$lang->task->confirmTips->notAdvanceOfExecution = "截止日期早于預計開始，若將預計開始提前%s天，將早于執行計劃完成日期，請重新調整預計開始。";
$lang->task->confirmTips->notAdvanceOfPreTask   = "截止日期早于預計開始，若將預計開始提前%s天，將超出前置任務#%s的依賴日期+最小間隔天數，請重新調整截止日期。";

$lang->task->scheduleTips = new stdclass();
$lang->task->scheduleTips->beginBeforeExecutionBegin = "任務預計開始不能早于執行計劃開始%s。";
$lang->task->scheduleTips->beginAfterExecutionEnd    = "任務預計開始不能晚于執行計劃完成%s。";
$lang->task->scheduleTips->beginBeforePreTaskBegin   = "任務預計開始不能早于前置任務{#%s}的預計開始+最小間隔天數%s。";
$lang->task->scheduleTips->beginBeforePreTaskEnd     = "任務預計開始不能早于前置任務{#%s}的截止日期+最小間隔天數%s。";
$lang->task->scheduleTips->endBeforeExecutionBegin   = "任務截止日期不能早于執行計劃開始%s。";
$lang->task->scheduleTips->endAfterExecutionEnd      = "任務截止日期不能晚于執行計劃完成%s。";
$lang->task->scheduleTips->endBeforePreTaskBegin     = "任務截止日期不能早于前置任務{#%s}的預計開始+最小間隔天數%s。";
$lang->task->scheduleTips->endBeforePreTaskEnd       = "任務截止日期不能早于前置任務{#%s}的截止日期+最小間隔天數%s。";
$lang->task->scheduleTips->estStartedMinProjectBegin = "任務預計開始不能早于{$lang->projectCommon}開始日期。";

$lang->task->dateRangeTips = new stdclass();
$lang->task->dateRangeTips->beforeExecutionBegin = "不能早于執行計劃開始。";
$lang->task->dateRangeTips->beforePreTaskBegin   = "不能早于前置任務#%s的預計開始+最小間隔天數。";
$lang->task->dateRangeTips->beforePreTaskEnd     = "不能早于前置任務#%s的截止日期+最小間隔天數。";
$lang->task->dateRangeTips->afterExecutionEnd    = "不能晚于執行計劃完成。";
