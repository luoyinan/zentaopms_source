<?php
/**
 * The editissue view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->assetlib->editIssue),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->issue->type),
        set::required(true),
        picker
        (
            set::name('type'),
            set::items($lang->issue->typeList),
            set::value($issue->type),
            set::required(true)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->issue->title),
        set::name('title'),
        set::value($issue->title),
        set::required(true)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->issue->severity),
        set::required(true),
        picker
        (
            set::name('severity'),
            set::items($lang->issue->severityList),
            set::value($issue->severity),
            set::required(true)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->issue->pri),
        priPicker
        (
            set::name('pri'),
            set::items($lang->issue->priList),
            set::value($issue->pri)
        )
    ),
    formGroup
    (
        set::label($lang->issue->desc),
        editor
        (
            set::name('desc'),
            set::rows(6),
            set::value($issue->desc)
        )
    )
);
