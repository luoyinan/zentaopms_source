<?php
$lang->task->design              = '相关设计';
$lang->task->designChanged       = '设计变更';
$lang->task->confirmDesignChange = '确认设计变更';

$lang->task->autoSchedule       = '自动排期';
$lang->task->globalSchedule     = '全局排期';
$lang->task->autoScheduleAction = '任务自动排期';
$lang->task->adjust             = '调整';

$lang->task->minBuffering  = '最小间隔';
$lang->task->preEstStarted = '原预计开始';
$lang->task->preDeadline   = '原截止日期';
$lang->task->preLeftDays   = '原剩余可用工作日';
$lang->task->leftDays      = '剩余可用工作日';
$lang->task->scheduleFail  = "排期后任务{#%s}的计划截止%s超出执行计划完成%s，请调整任务工期或执行工期。";
$lang->task->hasConflict   = '任务关系存在异常，请先去调整任务关系。';

$lang->task->schedule = new stdclass();
$lang->task->schedule->autoMode   = '启用局部排期';
$lang->task->schedule->globalMode = '启用全局排期';

$lang->task->gantt->notice->withLagDays = new stdclass();
$lang->task->gantt->notice->withLagDays->notSS = "任务：“%s”开始之后%s天，该任务才能开始！";
$lang->task->gantt->notice->withLagDays->notFS = "任务：“%s”结束之后%s天，该任务才能开始！";
$lang->task->gantt->notice->withLagDays->notSF = "任务：“%s”开始之后%s天，该任务才能结束！";
$lang->task->gantt->notice->withLagDays->notFF = "任务：“%s”结束之后%s天，该任务才能结束！";

$lang->task->confirmTips = new stdclass();
$lang->task->confirmTips->delay                 = "预计开始晚于截止日期，是否将截止日期顺延%s天，调整为%s？";
$lang->task->confirmTips->notDelayOfExecution   = "预计开始晚于截止日期，若将截止日期顺延%s天，将晚于执行计划完成日期，请重新调整预计开始。";
$lang->task->confirmTips->notDelayOfPreTask     = "预计开始晚于截止日期，若将截止日期顺延%s天，将超出前置任务#%s的依赖日期+最小间隔天数，请重新调整预计开始。";
$lang->task->confirmTips->advance               = "截止日期早于预计开始，是否将预计开始提前%s天，调整为%s？";
$lang->task->confirmTips->notAdvanceOfExecution = "截止日期早于预计开始，若将预计开始提前%s天，将早于执行计划完成日期，请重新调整预计开始。";
$lang->task->confirmTips->notAdvanceOfPreTask   = "截止日期早于预计开始，若将预计开始提前%s天，将超出前置任务#%s的依赖日期+最小间隔天数，请重新调整截止日期。";

$lang->task->scheduleTips = new stdclass();
$lang->task->scheduleTips->beginBeforeExecutionBegin = "任务预计开始不能早于执行计划开始%s。";
$lang->task->scheduleTips->beginAfterExecutionEnd    = "任务预计开始不能晚于执行计划完成%s。";
$lang->task->scheduleTips->beginBeforePreTaskBegin   = "任务预计开始不能早于前置任务{#%s}的预计开始+最小间隔天数%s。";
$lang->task->scheduleTips->beginBeforePreTaskEnd     = "任务预计开始不能早于前置任务{#%s}的截止日期+最小间隔天数%s。";
$lang->task->scheduleTips->endBeforeExecutionBegin   = "任务截止日期不能早于执行计划开始%s。";
$lang->task->scheduleTips->endAfterExecutionEnd      = "任务截止日期不能晚于执行计划完成%s。";
$lang->task->scheduleTips->endBeforePreTaskBegin     = "任务截止日期不能早于前置任务{#%s}的预计开始+最小间隔天数%s。";
$lang->task->scheduleTips->endBeforePreTaskEnd       = "任务截止日期不能早于前置任务{#%s}的截止日期+最小间隔天数%s。";
$lang->task->scheduleTips->estStartedMinProjectBegin = "任务预计开始不能早于{$lang->projectCommon}开始日期。";

$lang->task->dateRangeTips = new stdclass();
$lang->task->dateRangeTips->beforeExecutionBegin = "不能早于执行计划开始。";
$lang->task->dateRangeTips->beforePreTaskBegin   = "不能早于前置任务#%s的预计开始+最小间隔天数。";
$lang->task->dateRangeTips->beforePreTaskEnd     = "不能早于前置任务#%s的截止日期+最小间隔天数。";
$lang->task->dateRangeTips->afterExecutionEnd    = "不能晚于执行计划完成。";
