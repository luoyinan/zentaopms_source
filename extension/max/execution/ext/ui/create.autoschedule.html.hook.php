<?php
namespace zin;

$begin = data('plan.begin') ? $plan->begin : date('Y-m-d');
$end   = data('plan.end');
query('formGridPanel')->each(function($node) use($begin, $end)
{
    $fields = $node->prop('fields');

    $fields->field('days')->readonly(true);

    $fields->field('dateRange')
        ->itemBegin('schedule')
        ->control('schedule')
        ->begin('input[name=begin]')
        ->end('input[name=end]')
        ->value(data('plan.schedule'))
        ->projectID(data('projectID'))
        ->disabled(!$end || !$begin)
        ->callback('updateWorkingDays')
        ->itemEnd();

    $node->setProp('fields', $fields);
});
