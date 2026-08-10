<?php
/**
 * The batchCreate view file of measurement module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@easycorp.ltd>
 * @package     measurement
 * @link        https://www.zentao.net
 */
namespace zin;

$createTipRow = function($index = 0, $tipConfig = array()) use ($lang)
{
    return formRow
    (
        formGroup
        (
            set::width('200px'),
            inputGroup
            (
                input(set::name("mins[{$index}]"), set::value(zget($tipConfig, 'min', ''))),
                $lang->dash,
                input(set::name("maxs[{$index}]"), set::value(zget($tipConfig, 'max', '')))
            )
        ),
        formGroup
        (
            set::width('150px'),
            radioList(set::name("ranges[{$index}]"), set::inline(true), set::items($lang->custom->tipRangeList), set::value(zget($tipConfig, 'range', 0)))
        ),
        formGroup(set::name("tips[{$index}]"), set::value(zget($tipConfig, 'tip', '')), set::width('500px')),
        formGroup
        (
            set::width('90px'),
            div
            (
                setClass('pl-2 flex self-center'),
                btn
                (
                    setClass('btn ghost add-item'),
                    on::click('addRow'),
                    icon('plus')
                ),
                btn
                (
                    setClass('btn ghost del-item'),
                    on::click('removeRow'),
                    icon('trash')
                )
            )
        )
    );
};

$formItems[] = formRow
(
    set::width('full'),
    formGroup(setClass('justify-center content-center'), div(setClass('font-bold'), $lang->custom->region),  set::width('200px')),
    formGroup(setClass('justify-center content-center'), div(setClass('font-bold'), $lang->custom->isRange), set::width('150px')),
    formGroup(setClass('justify-center content-center'), div(setClass('font-bold'), $lang->custom->tips),    set::width('500px')),
    formGroup(setClass('justify-center content-center'), div(setClass('font-bold'), $lang->actions),         set::width('90px')),
);

$rowIndex  = 0;
if(!empty($tipsConfig))
{
    foreach($tipsConfig as $key => $tipConfig)
    {
        if($tipConfig->type != $object) continue;
        $formItems[] = $createTipRow($rowIndex, $tipConfig);
        $rowIndex ++;
    }
}

for($i = 0; $i < 2; $i ++)
{
    $formItems[] = $createTipRow($rowIndex);
    $rowIndex ++;
}

$menuItems = array();
foreach($lang->custom->tipProgressList as $key => $value)
{
    $menuItems[] = li
    (
        setClass('menu-item'),
        a
        (
            setClass($object == $key ? 'active' : ''),
            set::href(inlink('setTips', "type=progress&object=$key")),
            $value
        )
    );
}
foreach($lang->custom->tipCostList as $key => $value)
{
    $menuItems[] = li
    (
        setClass('menu-item'),
        a
        (
            setClass($object == $key ? 'active' : ''),
            set::href(inlink('setTips', "type=cost&object=$key")),
            $value
        )
    );
}

div
(
    setClass('row has-sidebar-left'),
    sidebar
    (
        set::showToggle(false),
        div
        (
            setClass('cell p-2.5 bg-white'),
            menu($menuItems)
        )
    ),
    jsVar('+rowIndex', $rowIndex),
    formPanel
    (
        set::headingClass('justify-start'),
        setClass('flex-auto ml-2'),
        set::actionsClass('w-1/2'),
        set::actions(array('submit')),
        $formItems
    ),
    div
    (
        setID('rowTemplate'),
        setClass('hidden'),
        $createTipRow('%rowIndex%')
    )
);

