<?php
/**
 * The setfulltextsearch file of workflow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflow
 * @link        https://www.zentao.net
 */
namespace zin;
include __DIR__ . '/header.html.php';
include __DIR__ . '/side.html.php';

jsVar('confirmMessage', $lang->workflow->tips->buildIndex);

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
        set::actions(array('submit', $flow->titleField ? array('text' => $lang->workflow->buildIndex, 'class' => 'secondary buildBtn', 'url' => 'javascript:;', 'data-module' => $flow->module, 'data-on' => 'click', 'data-call' => 'buildIndex', 'data-params' => 'event') : null)),
        set::title($title),
        formGroup
        (
            set::width('1/2'),
            set::label($lang->workflow->fullTextSearch->titleField),
            set::name('titleField'),
            set::items($fields),
            set::value($flow->titleField),
            set::placeholder($lang->workflow->placeholder->titleField)
        ),
        formGroup
        (
            set::width('1/2'),
            set::label($lang->workflow->fullTextSearch->contentField),
            set::name('contentField'),
            set::items($fields),
            set::value($flow->contentField),
            set::multiple(true),
            set::placeholder($lang->workflow->placeholder->contentField)
        ),
        formGroup
        (
            set::label(''),
            div
            (
                setClass('bg-warning bg-opacity-10 text-warning p-4'),
                html($lang->workflow->tips->fullTextSearch)
            )
        ),
        formGroup
        (
            set::label(''),
            setClass('hidden'),
            div(set::id('resultBox'))
        )
    )
);
