<?php
/**
 * The quotedb view file of workflow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguanming@zentao.net>
 * @package     workflow
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('module',  $module);
jsVar('groupID', $groupID);

set::title($lang->workflow->quoteDB);

if(empty($tableGroups))
{
    div(setClass('bg-secondary-50 text-secondary p-4'), $lang->workflow->tips->noQuoteTables);
}
else
{
    $treeItems    = array();
    $firstTableID = 0;
    foreach($tableGroups as $group)
    {
        $groupItem = array('text' => $group->text, 'items' => array());
        foreach($group->items as $table)
        {
            if(empty($firstTableID)) $firstTableID = $table->id;

            $groupItem['items'][] = array
            (
                'text'        => $table->text,
                'data-module' => $table->module,
                'actions'     => array(
                    array('icon' => 'eye', 'data-on' => 'click', 'data-call' => 'showTable', 'data-params' => 'event', 'data-id' => $table->id)
                )
            );
        }
        $treeItems[] = $groupItem;
    }

    if(!empty($firstTableID)) jsVar('firstTableID', $firstTableID);

    formPanel
    (
        set::actions(array(array('text' => $lang->workflowtable->use, 'class' => 'primary ajax-btn not-open-url', 'data-on' => 'click', 'data-call' => 'useTable'))),
        div
        (
            setClass('flex gap-4'),
            div
            (
                setClass('flex-1'),
                zui::tree
                (
                    set::defaultNestedShow(true),
                    set::checkOnClick(true),
                    set::checkbox(true),
                    set::items($treeItems)
                )
            ),
            div
            (
                setID('previewArea'),
                setClass('flex-1 bg-surface p-4')
            )
        )
    );
}
