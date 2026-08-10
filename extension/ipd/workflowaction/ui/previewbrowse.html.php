<?php
namespace zin;

if(empty($fields))
{
    div
    (
        setClass('panel-body text-center'),
        $lang->workflowaction->tips->emptyLayout,
        btn
        (
            setClass('btn primary'),
            set::href(createLink('workflowlayout', 'admin', "module={$flow->module}&method=$action->method")),
            set(array('data-toggle' => 'modal')),
            $lang->workflowaction->setLayout
        )
    );
}
else
{
    $cols = [];
    foreach($fields as $field)
    {
        if(!$field->show) continue;
        if($field->field == 'id') continue;
        if($field->field == 'actions') continue;

        $cols[$field->field]['name']     = $field->field;
        $cols[$field->field]['title']    = $field->name;
        $cols[$field->field]['type']     = 'html';
        $cols[$field->field]['sortType'] = false;
    }

    $cols['actions'] = array(
        'name'       => 'actions',
        'title'      => $lang->actions,
        'type'       => 'actions',
        'width'      => 200,
        'align'      => 'right',
        'actionsMap' => array(
            'edit' => array(
                'url' => '',
                'text' => $lang->edit
            ),
            'view' => array(
                'url' => '',
                'text' => $lang->view
            ),
            'delete' => array(
                'url' => '',
                'text' => $lang->delete
            )
        )
    );

    $dataList = [];
    for($i = 0; $i < 3; $i++)
    {
        $data = new stdClass();
        foreach($cols as $field => $col)
        {
            if($field == 'actions')
            {
                $data->$field = array(array('name' => 'edit', 'disabled' => false), array('name' => 'view', 'disabled' => false), array('name' => 'delete', 'disabled' => false));
            }
            else
            {
                $data->$field = "<div class='example-text-holder'></div>";
            }
        }

        $dataList[$i] = $data;
    }

    $featureBarItems = [];
    foreach($labels as $label)
    {
        $active = $label == current($labels) ? 'active' : '';
        $featureBarItems[] = li
        (
            setClass('nav-item'),
            a
            (
                setClass("$active"),
                $label
            )
        );
    }

    div(
        set::id('mainMenu'),
        featureBar($featureBarItems),
        toolbar
        (
            btngroup
            (
                btn(setClass('btn primary create-bug-btn'), set::icon('plus'), $lang->create),
                dropdown
                (
                    btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
                    set::items(array
                    (
                        array('text' => $lang->create, 'url' => ''),
                        array('text' => $lang->workflowaction->default->actions['batchcreate'], 'url' => '')
                    )),
                    set::placement('bottom-end')
                )
            )
        )
    );

    dtable
    (
        set::cols(array_values($cols)),
        set::data($dataList)
    );
}