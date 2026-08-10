<?php
namespace zin;

$begin = data('project.begin') ? data('project.begin') : date('Y-m-d');
$end   = data('project.end') == LONG_TIME ? '' : data('project.end');
query('formGridPanel')->each(function($node) use($begin, $end)
{
    $fields = $node->prop('fields');

    $fields->field('days')->readonly(true);

    $fields->field('begin')
        ->itemBegin('schedule')
        ->control('schedule')
        ->begin('input[name=begin]')
        ->end('input[name=end]')
        ->value(data('project.schedule'))
        ->disabled(!$end || !$begin)
        ->callback('updateWorkingDays')
        ->itemEnd();

    $node->setProp('fields', $fields);
});
