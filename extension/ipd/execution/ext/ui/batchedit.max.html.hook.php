<?php
namespace zin;

if(helper::hasFeature('deliverable'))
{
    global $lang, $app;

    $app->control->loadModel('project');

    $executions = data('executions');
    foreach($executions as $execution)
    {
        if($execution->status == 'closed' && !empty($execution->deliverable) && $app->control->project->checkUploadedDeliverable($execution->id)) $execution->hasDeliverable = true;
    }

    query('formBatchPanel')->each(function($node) use ($executions)
    {
        $data = array_values($executions);

        $node->setProp('data', $data);
    });
}

query('formBatchPanel')->each(function($node)
{
    global $lang;

    $items = $node->prop('items');
    foreach($items as $key => $item)
    {
        if(empty($item['name'])) continue;
        if($item['name'] == 'end')
        {
            $items[$key] = array
            (
                'name'     => 'endBox',
                'required' => true,
                'label'    => $lang->execution->end,
                'width'    => '180px',
                'control'  => array('control' => 'inputGroup', 'items' => array
                (
                    array('control' => 'datePicker', 'name'  => 'end'),
                    array('control' => 'schedule',   'begin' => 'input[name^=begin]', 'end' => 'input[name^=end]', 'callback' => 'updateWorkDays', 'type' => 'batchForm')
                ))
            );
        }
        if($item['name'] == 'days')
        {
            $items[$key]['disabled'] = true;
        }
    }

    $node->setProp('items', $items);

    $onRenderRow    = json_encode($node->prop('onRenderRow'));
    $newOnRenderRow = jsRaw
    (
        'function($col, col, rowData, index){',
            "($onRenderRow)" . '($col, col, rowData, index);',
            '$col.find(".btn-calendar").attr("data-project", rowData.project);',
            "if(!rowData.begin || !rowData.end){",
                '$col.find(".btn-calendar").addClass("disabled");',
            '}',
        '}'
    );
    $node->setProp('onRenderRow', $newOnRenderRow);
});
