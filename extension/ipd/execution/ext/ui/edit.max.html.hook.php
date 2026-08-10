<?php
namespace zin;

if(helper::hasFeature('deliverable'))
{
    global $lang, $app;
    $execution      = data('execution');
    $hasDeliverable = false;
    if($execution->status == 'closed' && !empty($execution->deliverable) && $app->control->loadModel('project')->checkUploadedDeliverable($execution->id)) $hasDeliverable = true;
    query('formGridPanel')->each(function($node) use ($hasDeliverable)
    {
        $fields = $node->prop('fields');

        $fields->field('attribute')->disabled($hasDeliverable);
        $fields->field('lifetime')->disabled($hasDeliverable);

        $node->setProp('fields', $fields);
    });
}

global $config;
if($config->vision == 'rnd')
{
    $begin = data('execution.begin');
    $end   = data('execution.end');
    query('formGridPanel')->each(function($node) use($begin, $end)
    {
        $fields = $node->prop('fields');

        $fields->field('days')->readonly(true);

        $fields->field('planDate')
            ->itemBegin('schedule')
            ->control('schedule')
            ->begin('input[name=begin]')
            ->end('input[name=end]')
            ->value(data('execution.schedule'))
            ->projectID(data('execution.project'))
            ->disabled(!$end || !$begin)
            ->callback('updateWorkingDays')
            ->itemEnd();

        $node->setProp('fields', $fields);
    });
}
