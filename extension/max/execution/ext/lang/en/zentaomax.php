<?php
$lang->execution->template        = 'Template';
$lang->execution->finish          = 'Finish';
$lang->execution->program         = $lang->projectCommon;
$lang->execution->taskCount       = 'Task Count';
$lang->execution->deliverable     = 'Deliverable';
$lang->execution->deliverableAbbr = 'Deliverable';
$lang->execution->whenClosedTips  = '(Deliverables are not strictly validated when the execution is closed)';

$lang->execution->enter = 'Entry';
$lang->execution->draft = 'Draft';

$lang->execution->cannotCloseByDeliverable = "Some executions have been closed, the ongoing executions cannot be closed due to the absence of submitted deliverables. \n The following executions cannot be closed: \n %s";
$lang->execution->closeExecutionError      = "Cannot close the execution of undelivered deliverables.";
$lang->execution->notClose                 = "Cannot close the execution";
$lang->execution->cannotAutoCloseParent    = "Unsubmitted, unreviewed, or unconfirmed deliverables have been detected in the parent execution. The execution cannot be closed automatically. Do you want to close the parent execution manually?";

$lang->execution->action->managedeliverable = '$date, managed by <strong>$actor</strong> of deliverable.' . "\n";

$lang->execution->minBuffering       = 'Min Interval';
$lang->execution->autoScheduleAction = 'Auto Schedule Execution';
$lang->execution->scheduleFail       = 'The execution after scheduling conflicts with the start and end dates of the project plan. Please adjust the execution period or project duration.';
$lang->execution->dateConflictTip    = 'The planned start and end dates of the task exceed the scheduled start and end dates for execution. Please adjust the task schedule.';
$lang->execution->toAdjust           = 'To Adjust';
$lang->execution->know               = 'Know';
$lang->execution->schedule           = "{$lang->execution->common} Schedule";
$lang->execution->autoSchedule       = 'Auto Schedule';

$lang->execution->globalScheduleSuccess = 'Global Schedule Success';
$lang->execution->scheduleDataEmpty     = 'No tasks available. Auto-scheduling is disabled.';

$lang->execution->gantt->lagDays = 'Lag Days';
