<?php
/**
 * The setjs file of workflow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflow
 * @link        https://www.zentao.net
 */
namespace zin;
if($type == 'flow')
{
    include __DIR__ . '/header.html.php';
    include __DIR__ . '/side.html.php';
}

div
(
    setClass('flex mt-2'),
    $type == 'flow' ? cell
    (
        setClass('shadow'),
        $sideBar
    ) : null,
    formPanel
    (
        setClass('bg-canvas flex-1 ml-6 shadow'),
        setStyle(array('max-width' => '100%')),
        set::actions(array('submit')),
        set::title($title),
        monaco
        (
            setClass('border'),
            set::height('400'),
            set::id('js'),
            set::options(array('automaticLayout' => true, 'language' => 'javascript', 'value' => $js))
        )
    )
);
