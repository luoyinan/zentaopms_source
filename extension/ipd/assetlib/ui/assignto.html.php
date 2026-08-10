<?php
/**
 * The assignto view file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

$objectNameField = zget($config->action->objectNameFields, $type, 'name');
$objectName      = zget($object, $objectNameField, '');

modalHeader
(
    set::title($lang->assetlib->assignedTo),
    set::entityID($object->id),
    set::entityText($objectName)
);

formPanel
(
    set::id('assignToForm'),
    set::submitBtnText($lang->save),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->assetlib->assignedTo),
        picker
        (
            set::name('assignedTo'),
            set::items($users),
            set::value($object->assignedTo)
        )
    ),
    formGroup
    (
        set::label($lang->comment),
        editor
        (
            set::name('comment')
        )
    )
);
