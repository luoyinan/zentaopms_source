<?php
/**
 * The editstory view file of assetlib module of ZenTaoPMS.
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
    set::title($lang->assetlib->editStory),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->story->name),
        set::name('title'),
        set::value($story->title),
        set::required(true)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->story->pri),
        picker
        (
            set::name('pri'),
            set::items($lang->story->priList),
            set::value($story->pri)
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->story->estimate),
        set::name('estimate'),
        set::value($story->estimate)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->story->keywords),
        set::name('keywords'),
        set::value($story->keywords)
    ),
    formGroup
    (
        set::label($lang->story->spec),
        editor
        (
            set::name('spec'),
            set::value($story->spec)
        )
    ),
    formGroup
    (
        set::label($lang->story->verify),
        editor
        (
            set::name('verify'),
            set::value($story->verify)
        )
    )
);
