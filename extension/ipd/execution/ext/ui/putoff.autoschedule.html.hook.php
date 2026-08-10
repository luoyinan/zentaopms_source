<?php
namespace zin;

global $lang;
$execution = data('execution');

$dateBox = array();
$dateBox[] = inputGroup
(
    datePicker
    (
        set::control('date'),
        set::id('begin'),
        set::name('begin'),
        set::value($execution->begin),
        set::placeholder($lang->execution->begin)
    ),
    $lang->execution->to,
    datePicker
    (
        set::control('date'),
        set::id('end'),
        set::name('end'),
        set::value($execution->end),
        set::placeholder($lang->execution->end)
    ),
    schedule
    (
        set::begin('input[name=begin]'),
        set::end('input[name=end]'),
        set::value($execution->schedule),
        set::projectID($execution->project),
        set::disabled(!$execution->begin || !$execution->end),
        set::callback('updateWorkingDays')
    )
);
query('#dateBox')->empty()->after($dateBox);
query('#days')->prop('readonly', true)->prop('value', $execution->days);
