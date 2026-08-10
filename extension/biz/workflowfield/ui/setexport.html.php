<?php
/**
 * The setexport file of workflowfield module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowfield
 * @link        https://www.zentao.net
 */
namespace zin;
include dirname(__DIR__, 2) . '/workflow/ui/header.html.php';
include dirname(__DIR__, 2) . '/workflow/ui/side.html.php';

$mode = $flow->buildin ? 'extendExport' : 'canExport';

if(count($fieldGroups) > 1)
{
    $tabPanes = array();
    foreach($fieldGroups as $module => $fields)
    {
        $checkedFields = zget($exportGroups, $module, '');
        $tabPanes[] = tabPane
        (
            set::key($module),
            set::title(zget($flowPairs, $module)),
            workflowfield(set::mode($mode), set::fields($fields), set::checkedFields($checkedFields), set::module($module))
        );
    }
}
else
{
    $fields = current($fieldGroups);
    $module = current(array_keys($fieldGroups));
    $checkedFields = zget($exportGroups, $module, '');
}

div
(
    setClass('flex mt-2'),
    cell
    (
        setClass('shadow'),
        $sideBar
    ),
    formPanel
    (
        setClass('bg-canvas flex-1 ml-6 shadow'),
        setStyle(array('max-width' => '100%')),
        set::actions(array('submit')),
        set::title($title),
        formRow
        (
            count($fieldGroups) > 1 ? tabs
            (
                $tabPanes
            ) : div
            (
                setClass('w-1/2'),
                workflowfield(set::mode($mode), set::fields($fields), set::checkedFields($checkedFields), set::module($module))
            )
        )
    )
);
