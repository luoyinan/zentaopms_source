<?php
$lang->task->design              = 'Related Design';
$lang->task->designChanged       = 'Change Design';
$lang->task->confirmDesignChange = 'Confirm changed design';

$lang->task->autoSchedule       = 'Auto Schedule';
$lang->task->globalSchedule     = 'Global Schedule';
$lang->task->autoScheduleAction = 'Task Auto Schedule';
$lang->task->adjust             = 'Adjust';

$lang->task->minBuffering  = 'Minimum Interval';
$lang->task->preEstStarted = 'Original Estimated Start';
$lang->task->preDeadline   = 'Original Deadline';
$lang->task->preLeftDays   = 'Original Left Days';
$lang->task->leftDays      = 'Left Days';
$lang->task->scheduleFail  = "The deadline for the scheduled task {#%s} is %s, Exceeded the execution plan to complete %s, please adjust the task duration or execution duration.";
$lang->task->hasConflict   = 'There is an abnormality in the task relationship, please adjust the task relationship first.';

$lang->task->schedule = new stdclass();
$lang->task->schedule->autoMode   = 'Auto Scheduling';
$lang->task->schedule->globalMode = 'Global Scheduling';

$lang->task->gantt->notice->withLagDays = new stdclass();
$lang->task->gantt->notice->withLagDays->notSS = "Since \"%s\" started after %s days, this task can begin!";
$lang->task->gantt->notice->withLagDays->notFS = "Since \"%s\" ended after %s days, this task can begin!";
$lang->task->gantt->notice->withLagDays->notSF = "Since \"%s\" started after %s days, this task can end!";
$lang->task->gantt->notice->withLagDays->notFF = "Since \"%s\" ended after %s days, this task can end!";

$lang->task->confirmTips = new stdclass();
$lang->task->confirmTips->delay                 = "Expected to start later than the deadline, would you like to extend the deadline by %s days and adjust it to %s?";
$lang->task->confirmTips->notDelayOfExecution   = "The expected start date is later than the deadline. If the deadline is postponed by %s days, it will be later than the completion date of the execution plan. Please readjust the expected start date.";
$lang->task->confirmTips->notDelayOfPreTask     = "The expected start date is later than the deadline. If the deadline is postponed by %s days, it will exceed the dependency date of the previous task #%s + the minimum interval days. Please readjust the expected start date.";
$lang->task->confirmTips->advance               = "The deadline is earlier than the expected start date. Will the expected start date be moved up by %s days and adjusted to %s?";
$lang->task->confirmTips->notAdvanceOfExecution = "The deadline is earlier than the expected start date. If the expected start date is advanced by %s days, it will be earlier than the completion date of the execution plan. Please readjust the expected start date.";
$lang->task->confirmTips->notAdvanceOfPreTask   = "The deadline is earlier than the expected start date. If the expected start date is advanced by %s days, it will exceed the dependency date+minimum interval days of the previous task #%s. Please adjust the deadline again.";

$lang->task->scheduleTips = new stdclass();
$lang->task->scheduleTips->beginBeforeExecutionBegin = "The expected start of the task cannot be earlier than the execution plan start %s.";
$lang->task->scheduleTips->beginAfterExecutionEnd    = "The expected start of the task cannot be later than the completion of the execution plan %s.";
$lang->task->scheduleTips->beginBeforePreTaskBegin   = "The expected start of the task cannot be earlier than the expected start of the preceding task {#%s} + minimum interval days %s";
$lang->task->scheduleTips->beginBeforePreTaskEnd     = "The expected start date of the task cannot be earlier than the deadline of the preceding task {#%s} + the minimum interval days %s";
$lang->task->scheduleTips->endBeforeExecutionBegin   = "The deadline for the task cannot be earlier than the start of the execution plan %s.";
$lang->task->scheduleTips->endAfterExecutionEnd      = "The deadline for the task cannot be later than the completion of the execution plan %s.";
$lang->task->scheduleTips->endBeforePreTaskBegin     = "The deadline for the task cannot be earlier than the expected start of the preceding task {#%s} + the minimum interval days %s.";
$lang->task->scheduleTips->endBeforePreTaskEnd       = "The task deadline cannot be earlier than the deadline of the preceding task {#%s} + the minimum interval days %s.";
$lang->task->scheduleTips->estStartedMinProjectBegin = "The start date for the task cannot be earlier than the {$lang->projectCommon} begin date.";

$lang->task->dateRangeTips = new stdclass();
$lang->task->dateRangeTips->beforeExecutionBegin = "Cannot be earlier than the execution plan start.";
$lang->task->dateRangeTips->beforePreTaskBegin   = "Cannot be earlier than the expected start of the preceding task #%s + the minimum interval days.";
$lang->task->dateRangeTips->beforePreTaskEnd     = "Cannot be earlier than the deadline of the preceding task #%s + the minimum interval days.";
$lang->task->dateRangeTips->afterExecutionEnd    = "Cannot be later than the completion of the execution plan.";
