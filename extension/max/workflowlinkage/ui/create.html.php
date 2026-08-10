<?php
/**
 * The create view file of workflowlinkage module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Guangming Sun <sunguangming@zentao.net>
 * @package     workflowlinkage
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
namespace zin;

modalHeader();

$fieldItems = array();
foreach($fields as $key => $value)
{
    if(!$key) continue;
    if(strpos($key, 'sub_') === 0) continue;
    $fieldItems[] = array('value' => $key, 'text' => $value);
}

$statusItems = array();
foreach($lang->workflowlinkage->statusList as $key => $value)
{
    $statusItems[] = array('value' => $key, 'text' => $value);
}

$sourceIndex = 1;
$targetIndex = 1;
$sourceFormRow = formRow
(
    setClass('linkage-source-row'),
    formGroup
    (
        set::label($lang->workflowlinkage->source)
    ),
    formGroup
    (
        set::width('1/4'),
        setClass('source-field-box'),
        picker
        (
            set::name("source[{$sourceIndex}]"),
            setID("source{$sourceIndex}"),
            set::items($fieldItems),
        )
    ),
    formGroup
    (
        set::width('1/6'),
        picker
        (
            set::required(true),
            set::name("operator[{$sourceIndex}]"),
            setID("operator{$sourceIndex}"),
            set::items($config->workflowlinkage->operatorList),
        )
    ),
    formGroup
    (
        set::width('1/4'),
        setClass('source-value-box'),
        input
        (
            set::name("value[{$sourceIndex}]"),
            setID("value{$sourceIndex}"),
            setClass('form-control')
        )
    ),
    formGroup
    (
        set::label(false),
        set::width('1/6')
    )
);

$firstTargetRow = formRow
(
    setClass('linkage-target-row'),
    formGroup
    (
        set::label($lang->workflowlinkage->target),
        setClass('target-label')
    ),
    formGroup
    (
        set::width('1/4'),
        setClass('target-box'),
        picker
        (
            set::name("target[{$targetIndex}]"),
            setID("target{$targetIndex}"),
            set::items($fieldItems)
        )
    ),
    formGroup
    (
        set::label(false),
        set::width('1/6'),
        div
        (
            setClass('form-control text-muted flex items-center justify-center'),
            $lang->workflowlinkage->status
        )
    ),
    formGroup
    (
        set::label(false),
        set::width('1/4'),
        setClass('status-box'),
        picker
        (
            set::required(true),
            set::name("status[{$targetIndex}]"),
            setID("status{$targetIndex}"),
            set::items($statusItems)
        )
    ),
    formGroup
    (
        set::label(false),
        set::width('1/6'),
        a(set::href('javascript:;'), setClass('btn ghost addTarget'), icon('plus')),
        a(set::href('javascript:;'), setClass('btn ghost delTarget'), icon('close'))
    )
);

$formActions = array(
    'submit' => array(
        'text' => $lang->save,
        'btnType' => 'submit',
        'type' => 'primary'
    ),
    'cancel' => array(
        'text' => $lang->goback,
        'url' => inlink('browse', "action={$action->id}&ui={$ui}"),
        'data-load' => 'modal',
        'data-size' => 'md'
    )
);

jsVar('workflow', $flow->module);
jsVar('window.statusItems', $statusItems);

formPanel
(
    set::formID('createLinkageForm'),
    set::url(inlink('create', "action={$action->id}&ui={$ui}")),
    set::actions($formActions),
    on::change('[name^="source"]', 'changeSource'),
    on::change('[name^="target"]', 'changeTarget'),
    on::click('.addTarget', 'addTarget'),
    on::click('.delTarget', 'delTarget'),
    formHidden('ui', (string)$ui),
    $sourceFormRow,
    $firstTargetRow
);
