<?php
/**
 * The create view file of workflowaction module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     workflowaction
 * @link        https://www.zentao.net
 */
namespace zin;

$batchOpenList = array();
$openList      = array();
foreach($lang->workflowaction->openList as $key => $value)
{
    $openList[] = array('text' => $value, 'value' => $key);
    if($key !== 'modal') $batchOpenList[] = array('text' => $value, 'value' => $key);
}

jsVar('openList',      $openList);
jsVar('batchOpenList', $batchOpenList);

$typeList     = $lang->workflowaction->typeList;
$positionList = $lang->workflowaction->positionList;
$position     = 'browseandview';
if($flow->buildin)
{
    unset($positionList['menu'], $positionList['browse'], $positionList['browseandview']);
    $position = 'view';
}

$showList = $lang->workflowaction->showList;
if($flow->buildin) unset($showList['dropdownlist']);

$defaultShow = $flow->buildin ? 'direct' : (isset($lang->workflowaction->showList['0']) ? '0' : 'direct');

modalHeader();

$groups   = array();
$groups[] = formGroup(
    set::width('1/2'),
    set::label($lang->workflowaction->name),
    set::required(true),
    input(
        set::name('name'),
        set::value('')
    )
);

$groups[] = formGroup(
    set::width('1/2'),
    set::label($lang->workflowaction->action),
    set::required(true),
    input(
        set::name('action'),
        set::value(''),
        set::placeholder($lang->workflowaction->placeholder->code)
    )
);

$groups[] = formGroup(
    set::label($lang->workflowaction->type),
    set::width('1/2'),
    picker(
        set::required(true),
        setID('type'),
        set::name('type'),
        set::items($typeList),
        set::value('')
    )
);

$groups[] = formGroup(
    setClass('batch-mode-row hidden'),
    set::label($lang->workflowaction->batchMode),
    set::width('1/2'),
    picker(
        setID('batchMode'),
        set::required(true),
        set::name('batchMode'),
        set::items($lang->workflowaction->batchModeList),
        set::value('')
    )
);

$groups[] = formGroup(
    setClass('type-single-only'),
    set::label($lang->workflowaction->open),
    set::width('1/2'),
    picker(
        set::width('1/2'),
        setID('open'),
        set::required(true),
        set::name('open'),
        set::items($lang->workflowaction->openList),
        set::value('')
    )
);

$groups[] = formRow(
    formGroup(
        setClass('type-single-only'),
        set::label($lang->workflowaction->position),
        set::width('1/2'),
        picker(
            set::width('1/2'),
            set::required(true),
            setID('position'),
            set::name('position'),
            set::items($positionList),
            set::value($position)
        )
    ),
    formGroup(
        set::width('1/2'),
        btn
        (
            set::icon('help'),
            toggle::tooltip(array('title' => $lang->workflowaction->tips->position, 'type' => 'white', 'className' => 'text-gray border border-light', 'placement' => 'right')),
            set::square(true),
            setClass('ghost h-6 mt-0.5 tooltip-btn')
        )
    )
);

$groups[] = formRow(
    formGroup(
        setClass('type-single-only'),
        set::label($lang->workflowaction->show),
        set::width('1/2'),
        picker(
            setID('show'),
            set::required(true),
            set::name('show'),
            set::items($showList),
            set::value($defaultShow)
        )
    ),
    formGroup(
        setClass('type-single-only'),
        btn
        (
            set::icon('help'),
            toggle::tooltip(array('title' => $lang->workflowaction->tips->show, 'type' => 'white', 'className' => 'text-gray border border-light', 'placement' => 'right')),
            set::square(true),
            setClass('ghost h-6 mt-0.5 tooltip-btn')
        )
    )
);

$groups[] = formGroup(
    set::label($lang->workflowaction->desc),
    textarea(
        set::name('desc'),
        set::value(''),
        set::rows(3)
    )
);

formPanel(
    set::formID('ajaxForm'),
    set::url(inlink('create', "module=$flow->module")),
    set::submitBtnText($lang->save),
    set::actions(array('submit')),
    input(set::type('hidden'), set::name('module'), set::value($flow->module)),
    on::change('#type', 'changeType'),
    $groups
);

render();
