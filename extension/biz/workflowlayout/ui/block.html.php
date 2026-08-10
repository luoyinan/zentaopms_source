<?php
/**
 * The block view file of workflowlayout module of ZDOO.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gunagming Sun <sungunagming@xirangit.com>
 * @package     workflowlayout
 * @version     $Id$
 * @link        https://www.zdoo.com
 */
namespace zin;

modalHeader(set::title($title));

jsVar('langDelete', $lang->delete);
jsVar('langTabName', $lang->workflowlayout->tabName);

$maxBlockKey = 0;

$blocks = $action->blocks ? json_decode($action->blocks) : array();
if(!is_array($blocks) && !is_object($blocks)) $blocks = array();

$formAction = createLink('workflowlayout', 'block', "module={$action->module}");

$buildBlockRow = function (string $blockKey, string $blockName, bool $showChecked, $tabs) use ($lang)
{
    $tabItems = array();
    if(!empty($tabs))
    {
        foreach($tabs as $tabKey => $tabName)
        {
            $tabItems[] = li(
                setClass('tab'),
                formRow(
                    setClass('wf-block-tab-row items-center'),
                    formGroup
                    (
                        set::label(''),
                        set::width('1/12'),
                        setClass('sort-box mr-4'),
                        icon('move', setClass('text-muted sort-block-handler'))
                    ),
                    formGroup
                    (
                        set::label(false),
                        set::width('1/4'),
                        input(
                            set::name("tabName[{$tabKey}]"),
                            set::value(is_string($tabName) ? $tabName : (string) $tabName),
                            setClass('form-control'),
                            set::placeholder($lang->workflowlayout->tabName)
                        ),
                        formHidden("parent[{$tabKey}]", $blockKey, setClass('parent'))
                    ),
                    formGroup
                    (
                        set::label(false),
                        set::width('1/6'),
                        a(set::href('javascript:;'), setClass('btn ghost removeTab text-sm'), $lang->delete)
                    ),
                    formGroup(set::label(false), set::width('1/4')),
                    formGroup(set::label(false), set::width('1/6'))
                )
            );
        }
    }

    $mainRow = formRow(
        setClass('wf-block-main-row items-center'),
        formGroup
        (
            set::label(''),
            set::width('1/12'),
            setClass('sort-box mr-4'),
            icon('move', setClass('text-muted sort-block-handler'))
        ),
        formGroup
        (
            set::label(false),
            set::width('1/4'),
            input(
                set::name("blockName[{$blockKey}]"),
                set::value($blockName),
                setClass('form-control'),
                set::placeholder($lang->workflowlayout->blockName)
            ),
            formHidden("key[{$blockKey}]", '')
        ),
        formGroup
        (
            set::label(false),
            set::width('1/6'),
            setClass('show-name-box ml-2'),
            checkbox(
                set::primary(false),
                set::name("showName[{$blockKey}]"),
                set::value('1'),
                set::checked($showChecked),
                set::text($lang->workflowlayout->showName)
            )
        ),
        formGroup
        (
            set::label(false),
            set::width('1/4'),
            div(
                setClass('flex items-center gap-1'),
                a(set::href('javascript:;'), setClass('btn ghost addBlock text-sm'), $lang->workflowlayout->addBlock),
                a(set::href('javascript:;'), setClass('btn ghost addTab text-sm'), $lang->workflowlayout->addTab),
                a(set::href('javascript:;'), setClass('btn ghost removeBlock text-sm'), $lang->delete)
            )
        ),
        formGroup(set::label(false), set::width('1/6'))
    );

    $children = array($mainRow);
    if($tabItems) $children[] = ul(setClass('tabList'), $tabItems);

    return li(setClass('block'), $children);
};

$blockItems = array();
foreach($blocks as $blockKey => $block)
{
    if(is_array($block)) $block = (object) $block;
    if($maxBlockKey < $blockKey) $maxBlockKey = $blockKey;

    $tabs = isset($block->tabs) ? $block->tabs : null;
    if(is_object($tabs)) $tabs = (array) $tabs;

    $showChecked = isset($block->showName) && $block->showName == '1';
    $blockName   = isset($block->name) ? (string) $block->name : '';

    $blockItems[] = $buildBlockRow((string) $blockKey, $blockName, $showChecked, $tabs);
}

$maxBlockKey++;

$blockItems[] = $buildBlockRow((string) $maxBlockKey, '', true, null);

$blockList = ul(setClass('blockList'), $blockItems);

$formActions = array(
    'submit' => array(
        'text'     => $lang->save,
        'btnType'  => 'submit',
        'type'     => 'primary',
        'className'=> 'submit',
    ),
    'cancel' => array(
        'text' => $lang->goback,
        'url' => createLink('workflowlayout', 'admin', "module={$action->module}&action={$action->action}&mode=edit"),
        'data-load' => 'modal',
        'data-size' => 'lg'
    )
);

formPanel(
    set::formID('blockForm'),
    set::url($formAction),
    set::actions($formActions),
    on::click('.addBlock', 'window.addBlock'),
    on::click('.addTab', 'window.addTab'),
    on::click('.removeBlock', 'window.removeBlock'),
    on::click('.removeTab', 'window.removeTab'),
    $blockList
);
