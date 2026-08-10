<?php
/**
 * The setsearch file of workflowfield module of ZenTaoPMS.
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

$mode = $flow->buildin ? 'extendSearch' : 'canSearch';
$checkedFields = $searchFields;
unset($fields['deleted']);

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
            div
            (
                setClass('w-1/2'),
                workflowfield(set::mode($mode), set::fields($fields), set::checkedFields($checkedFields), set::module($module))
            )
        )
    )
);
