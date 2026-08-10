<?php
/**
 * The edit view file of workflowlinkage module of ZDOO.
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
foreach($fields as $fieldKey => $fieldLabel)
{
    if(!$fieldKey) continue;
    if(strpos((string) $fieldKey, 'sub_') === 0) continue;
    $fieldItems[] = array('value' => $fieldKey, 'text' => $fieldLabel);
}

$statusItems = array();
foreach($lang->workflowlinkage->statusList as $statusKey => $statusLabel)
{
    $statusItems[] = array('value' => $statusKey, 'text' => $statusLabel);
}

$linkagesForUi = zget($action->linkages, $ui, array());
$linkage       = isset($linkagesForUi[$key]) ? $linkagesForUi[$key] : null;
$sources       = $linkage ? zget($linkage, 'sources', array()) : array();
$targets       = $linkage ? zget($linkage, 'targets', array()) : array();

$firstSource = null;
if($sources)
{
    $firstSource = $sources[0];
    if(is_array($firstSource)) $firstSource = (object) $firstSource;
}

$sourceField = '';
$sourceOp    = '';
$sourceVal   = '';
if($firstSource)
{
    $sourceField = (string) $firstSource->field;
    $sourceOp    = (string) $firstSource->operator;
    $sourceVal   = (string) zget($firstSource, 'value', '');
}

$sourceIndex = 1;
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
            set::value($sourceField)
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
            set::value($sourceOp)
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
            setClass('form-control'),
            set::value($sourceVal)
        )
    ),
    formGroup
    (
        set::label(false),
        set::width('1/6')
    )
);

$targetRows  = array();
$targetIndex = 1;
$targetList  = $targets ? $targets : array(null);
foreach($targetList as $target)
{
    if($target && is_array($target)) $target = (object) $target;

    $targetField  = $target ? (string) $target->field : '';
    $targetStatus = $target ? (string) $target->status : '';

    $targetRows[] = formRow
    (
        setClass('linkage-target-row'),
        formGroup
        (
            $targetIndex === 1 ? set::label($lang->workflowlinkage->target) : set::label(''),
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
                set::items($fieldItems),
                set::value($targetField)
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
                set::items($statusItems),
                set::value($targetStatus)
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

    $targetIndex++;
}

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
    set::formID('editLinkageForm'),
    set::url(inlink('edit', "action={$action->id}&key={$key}&ui={$ui}")),
    set::actions($formActions),
    on::change('[name^="source"]', 'changeSource'),
    on::change('[name^="target"]', 'changeTarget'),
    on::click('.addTarget', 'addTarget'),
    on::click('.delTarget', 'delTarget'),
    formHidden('ui', (string) $ui),
    $sourceFormRow,
    ...$targetRows
);
