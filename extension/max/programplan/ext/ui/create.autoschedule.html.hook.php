<?php
namespace zin;

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
                'label'    => $lang->programplan->end,
                'width'    => '180px',
                'control'  => array('control' => 'inputGroup', 'items' => array
                (
                    array('control' => 'datePicker', 'name'  => 'end'),
                    array('control' => 'schedule',   'begin' => 'input[name^=begin]', 'end' => 'input[name^=end]', 'callback' => 'updateWorkDays', 'projectID' => data('project.id'), 'type' => 'batchForm')
                ))
            );
        }
        if($item['name'] == 'days')     $items[$key] = array('name' => 'days', 'control' => 'input', 'disabled' => true, 'hidden' => true);
        if($item['name'] == 'schedule') unset($items[$key]);
    }

    $node->setProp('items', $items);
});
