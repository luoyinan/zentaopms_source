<?php
/**
 * The browse view file of subject module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang<wangyidong@easycorp.ltd>
 * @package     subject
 * @link        https://www.zentao.net
 */
namespace zin;

foreach($tree as $module) $module->url = createLink('subject', 'browse', "moduleID={$module->id}");

$maxOrder = 0;

/* Generate module rows. */
$moduleRows = array();
foreach($sons as $son)
{
    if($son->order > $maxOrder) $maxOrder = $son->order;

    $moduleRows[] = formRow
    (
        setClass('sonModule'),
        formGroup
        (
            inputGroup
            (
                setClass('row-module no-morph'),
                input
                (
                    setClass('col-module'),
                    set::name("modules[id$son->id]"),
                    set::value($son->name)
                ),
                input
                (
                    setClass('col-short'),
                    set::name("shorts[id$son->id]"),
                    set::value($son->short),
                    set::placeholder($lang->tree->short)
                ),
                formHidden("order[id$son->id]", $son->order)
            ),
            batchActions(set::actionClass('action-group child-hidden'))
        )
    );
}
for($i = 0; $i < 5; $i ++)
{
    $moduleRows[] = formRow
    (
        formGroup
        (
            inputGroup
            (
                setClass('row-module no-morph'),
                input
                (
                    setClass('col-module'),
                    set::name("modules[]"),
                    set::value('')
                ),
                input
                (
                    setClass('col-short'),
                    set::name("shorts[]"),
                    set::placeholder($lang->tree->short)
                )
            ),
            batchActions(set::actionClass('action-group'))
        )
    );
}

$parentPath = array();
foreach($parentModules as $module)
{
    $parentPath[] = div
    (
        setClass('row flex-nowrap items-center'),
        a
        (
            setClass('tree-link text-clip'),
            set('href', helper::createLink('subject', 'browse', "moduleID={$module->id}")),
            set::title($module->name),
            $module->name
        ),
        h::i
        (
            setClass('icon icon-angle-right muted align-middle'),
            setStyle('color', '#313C52')
        )
    );
}

div
(
    setClass('row gap-4 mt-2'),
    sidebar
    (
        set::toggleBtn(false),
        set::width(400),
        set::minWidth(350),
        set::maxWidth(550),
        panel
        (
            set::title($lang->subject->common),
            treeEditor
            (
                set::selected($currentModuleID),
                set::type('subject'),
                set::items($tree),
                set::canDelete(common::hasPriv('tree', 'delete')),
                set::canSplit(true),
                set::sortable(array('handle' => '.icon-move')),
                set::onSort(jsRaw('window.updateOrder'))
            )
        )
    ),
    div
    (
        setClass('flex-auto'),
        setID('modulePanel'),
        panel
        (
            setClass('pb-4'),
            set::title(empty($currentModuleID) ? $lang->subject->manage : $lang->subject->manageChild),
            div
            (
                setClass('flex'),
                div
                (
                    setClass('pr-2 tree-item-content row items-center'),
                    setStyle('max-width', '380px'),
                    setStyle('padding-bottom', '48px'),
                    $parentPath
                ),
                form
                (
                    setClass('flex-1 form-horz'),
                    set::actions(array('submit')),
                    set::action(createLink('tree', 'manageChild', "root=0&viewType=subject")),
                    $moduleRows,
                    set::actionsClass('justify-start'),
                    set::submitBtnText($lang->save),
                    formHidden('parentModuleID', $currentModuleID),
                    formHidden('maxOrder', $maxOrder)
                )
            )
        )
    )
);

render();
