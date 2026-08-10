<?php
namespace zin;

global $lang;
$plan = data('plan');

$dateBox = array();
$dateBox[] = inputGroup
(
    datePicker
    (
        set::id('begin'),
        set::name('begin'),
        set::control('date'),
        set::value($plan->begin)
    ),
    $lang->execution->to,
    datePicker
    (
        set::id('end'),
        set::name('end'),
        set::control('date'),
        set::value($plan->end)
    ),
    schedule
    (
        set::begin('input[name=begin]'),
        set::end('input[name=end]'),
        set::value($plan->schedule),
        set::projectID($plan->project),
        set::disabled(!$plan->begin || !$plan->end),
        set::callback('updateWorkingDays')
    ),
    input(set::name('days'), setClass('hidden'), set::value($plan->days))
);
query('#dateBox')->empty()->after($dateBox);
