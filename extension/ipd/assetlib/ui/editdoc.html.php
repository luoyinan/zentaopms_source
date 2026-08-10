<?php
/**
 * The editdoc view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->assetlib->{($objectType == 'practice' ? 'editPractice' : 'editComponent')}),
    formGroup
    (
        set::label($lang->doc->title),
        set::name('title'),
        set::value($doc->title),
        set::required(true)
    ),
    formGroup
    (
        set::label($lang->doc->keywords),
        set::name('keywords'),
        set::value($doc->keywords)
    ),
    formGroup
    (
        set::label($lang->doc->content),
        editor
        (
            set::name('content'),
            set::value($doc->content)
        )
    ),
    formGroup
    (
        set::label($lang->doc->files),
        fileselector(
            set::name('files'),
            set::defaultFiles(array_values($doc->files))
        )
    ),
    formHidden('editedDate', $doc->editedDate),
    formHidden('contentType', $doc->contentType)
);
