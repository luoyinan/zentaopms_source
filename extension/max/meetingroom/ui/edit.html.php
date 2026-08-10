<?php
/**
 * The edit view file of meetingroom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Ruogu Liu <liuruogu@chandao.com>
 * @package     meetingroom
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->meetingroom->edit),
    set::modeSwitcher(false),
    set::layout('horz'),
    formGroup
    (
        set::name('name'),
        set::label($lang->meetingroom->name),
        set::width('1/2'),
        set::value($room->name),
        set::required(true)
    ),
    formGroup
    (
        set::name('position'),
        set::label($lang->meetingroom->position),
        set::width('1/2'),
        set::value($room->position),
        set::required(true)
    ),
    formGroup
    (
        set::name('seats'),
        set::label($lang->meetingroom->seats),
        set::width('1/2'),
        set::value((string)$room->seats),
        set::required(true)
    ),
    formGroup
    (
        set::name('equipment'),
        set::label($lang->meetingroom->equipment),
        set::width('1/2'),
        set::control('picker'),
        set::items($lang->meetingroom->equipmentList),
        set::value($room->equipment),
        set::multiple(true),
        set::required(true)
    ),
    formGroup
    (
        set::name('openTime'),
        set::label($lang->meetingroom->openTime),
        set::width('1/2'),
        set::control('picker'),
        set::items($lang->meetingroom->openTimeList),
        set::value($room->openTime),
        set::multiple(true),
        set::required(true)
    )
);
