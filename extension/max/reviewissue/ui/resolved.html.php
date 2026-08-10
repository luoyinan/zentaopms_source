<?php
/**
 * The resolved view file of reviewissue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@chandao.com>
 * @package     reviewissue
 * @link        https://www.zentao.net
 */
namespace zin;

modalHeader(set::title($lang->reviewissue->resolved), set::entityID($issue->id), set::entityText($issue->title));

formPanel
(
    formGroup
    (
        set::width('1/3'),
        set::label($lang->reviewissue->resolution),
        set::required(true),
        picker
        (
            set::name('resolution'),
            set::items($lang->reviewissue->resolutionList),
        )
    ),
    formGroup
    (
        set::width('1/3'),
        set::label($lang->reviewissue->resolutionDate),
        set::control('datetimePicker'),
        set::name('resolutionDate'),
        set::value(helper::today())
    ),
    formGroup
    (
        set::width('1/3'),
        set::name('assignedTo'),
        set::label($lang->reviewissue->assignedTo),
        set::value($issue->assignedTo),
        set::items($users)
    ),
    formGroup
    (
        set::label($lang->bug->files),
        fileSelector()
    ),
    formGroup
    (
        set::label($lang->comment),
        set::name('comment'),
        set::control('editor'),
        set::rows(6)
    )
);

hr();
history
(
    set::objectID($issue->id),
    set::commentUrl(createLink('action', 'comment', array('objectType' => 'reviewissue', 'objectID' => $issue->id)))
);
