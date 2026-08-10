<?php
namespace zin;

global $config;
if($config->vision == 'rnd')
{
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
                    'label'    => $lang->project->end,
                    'width'    => '180px',
                    'control'  => array('control' => 'inputGroup', 'items' => array
                    (
                        array
                        (
                            'control' => 'datePicker',
                            'name'    => 'end',
                            'display' => jsRaw("(value) => (value === '" . LONG_TIME . "' ? '" . $lang->project->longTime . "' : zui.formatDate(value, 'yyyy-MM-dd'))"),
                            'actions' => array
                            (
                                array('text' => $lang->datepicker->dpText->TEXT_TODAY, 'data-set-date' => helper::today()),
                                array('text' => $lang->project->longTime, 'data-set-date' => LONG_TIME)
                            )
                        ),
                        array('control' => 'schedule', 'begin' => 'input[name^=begin]', 'end' => 'input[name^=end]', 'callback' => 'updateWorkDays', 'type' => 'batchForm')
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
        $longTime       = LONG_TIME;
        $newOnRenderRow = jsRaw
        (
            'function($col, col, rowData, index){',
                "($onRenderRow)" . '($col, col, rowData, index);',
                "if(!rowData.begin || !rowData.end || rowData.end == '$longTime'){",
                    '$col.find(".btn-calendar").addClass("disabled");',
                '}',
            '}'
        );
        $node->setProp('onRenderRow', $newOnRenderRow);
    });
}
