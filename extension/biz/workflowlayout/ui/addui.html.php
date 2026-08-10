<?php
namespace zin;

modalHeader(set::title($title));

$operatorList  = $lang->workflowcondition->operatorList;
$operatorItems = array();
foreach($operatorList as $key => $value)
{
    $operatorItems[] = array(
        'value' => $key,
        'text' => $value
    );
}

jsVar('moduleName', $module);
jsVar('operatorItems', $operatorItems);

$formRows = array();
$formRows[] = formRow
(
    formGroup
    (
        set::label($lang->workflowlayout->ui->name),
        set::required(true),
        input(set::name('name'))
    )
);

$formRows[] = formRow
(
    setClass('condition-row'),
    set(array('data-key' => 1)),
    formGroup(set::width('1/12'), setClass('condition-label-box'), set::label($lang->workflowlayout->ui->condition)),
    formGroup
    (
        set::width('1/4'),
        setClass('condition-field-box'),
        picker(
            set::name('field[1]'),
            set::items($fields),
            setClass('condition-field')
        )
    ),
    formGroup
    (
        set::width('1/6'),
        picker(
            set::name('operator[1]'),
            set::items($operatorItems),
            set::required(true),
            setClass('condition-operator')
        )
    ),
    formGroup(set::width('1/4'), setClass('condition-param'), input(set::name('param[1]'))),
    formGroup(
        set::width('1/6'),
        setClass('condition-actions'),
        a(set::href('javascript:;'), setClass('btn ghost addCondition'), icon('plus')),
        a(set::href('javascript:;'), setClass('btn ghost delCondition'), icon('close'))
    )
);

$otherRows = array();
if($others)
{
    $otherRows[] = formGroup(set::label($lang->workflowlayout->ui->other), div(setClass('text-muted')));

    $preUI = 0;
    foreach($others as $uiID => $uiConditions)
    {
        foreach($uiConditions as $fieldConditions)
        {
            foreach($fieldConditions as $condition)
            {
                $otherRows[] = formRow(
                    setClass('other-condition-row'),
                    formGroup(set::width('1/12'), set::label($uiID != $preUI ? $uiList[$uiID]->name : '')),
                    formGroup
                    (
                        set::width('1/4'),
                        picker(
                            set::name('otherfield'),
                            set::items($fields),
                            set::value((string)$condition->field),
                            set::required(true),
                            set::disabled(true)
                        )
                    ),
                    formGroup
                    (
                        set::width('1/6'),
                        picker(
                            set::name('otheroperator'),
                            set::items($operatorList),
                            set::value((string)$condition->operator),
                            set::required(true),
                            set::disabled(true)
                        )
                    ),
                    formGroup(set::width('1/4'), input(set::name('param[1]'), set::disabled(true), set::value($condition->param))),
                    formGroup(set::width('1/6'))
                );
                $preUI = $uiID;
            }
        }
    }
}

$formActions    = array(
    'submit',
    'cancel' => array(
        'text'      => $lang->cancel,
        'url'       => inlink('admin', "module=$module&action=$action"),
        'data-load' => 'modal',
        'data-size' => 'lg'
    )
);

formPanel(
    set::url(inlink('addUI', "module={$module}&action={$action}")),
    set::actions($formActions),
    on::click('.addCondition', 'addCondition'),
    on::click('.delCondition', 'delCondition'),
    on::change('[name^="field["]', 'changeConditionField'),
    $formRows,
    $otherRows
);
