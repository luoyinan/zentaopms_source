<?php
/**
 * The view view file of meetingroom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Ruogu Liu <liuruogu@chandao.com>
 * @package     meetingroom
 * @link        https://www.zentao.net
 */
namespace zin;

$actions = array();
if(!$room->deleted)
{
    if(common::hasPriv('meetingroom', 'edit'))
    {
        $actions[] = array('text' => $lang->edit, 'icon' => 'edit', 'url' => createLink('meetingroom', 'edit', "roomID={$room->id}"));
    }

    if(common::hasPriv('meetingroom', 'delete'))
    {
        $actions[] = array
        (
            'text'         => $lang->delete,
            'icon'         => 'trash',
            'url'          => createLink('meetingroom', 'delete', "roomID={$room->id}&confirm=yes"),
            'data-confirm' => $lang->meetingroom->confirmDelete
        );
    }
}

$basicInfoItems = array();
$basicInfoItems[$lang->meetingroom->position]  = array('control' => 'text', 'text' => $room->position);
$basicInfoItems[$lang->meetingroom->seats]     = array('control' => 'text', 'text' => $room->seats);
$basicInfoItems[$lang->meetingroom->equipment] = array('control' => 'text', 'text' => $room->equipmentName);
$basicInfoItems[$lang->meetingroom->openTime]  = array('control' => 'text', 'text' => $room->openTimeName);

$lifeTimeItems = array();
$lifeTimeItems[$lang->meetingroom->createdBy]   = array('control' => 'text', 'text' => zget($users, $room->createdBy));
$lifeTimeItems[$lang->meetingroom->createdDate] = array('control' => 'text', 'text' => helper::isZeroDate($room->createdDate) ? '' : $room->createdDate);
$lifeTimeItems[$lang->meetingroom->editedBy]    = array('control' => 'text', 'text' => zget($users, $room->editedBy));
$lifeTimeItems[$lang->meetingroom->editedDate]  = array('control' => 'text', 'text' => helper::isZeroDate($room->editedDate) ? '' : $room->editedDate);
$lifeTime = datalist
(
    set::items($lifeTimeItems)
);

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->meetingroom->legendLifeTime)
    ->children(wg($lifeTime));

$sections = array();
$sections[] = setting()
    ->title($lang->meetingroom->common)
    ->control('datalist')
    ->items($basicInfoItems);

detail
(
    set::object($room),
    set::objectType('meetingroom'),
    set::objectID($room->id),
    set::urlFormatter(array('{id}' => $room->id)),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
