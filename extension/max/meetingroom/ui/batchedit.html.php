<?php
/**
 * The batchEdit view file of meetingroom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Ruogu Liu <liuruogu@chandao.com>
 * @package     meetingroom
 * @link        https://www.zentao.net
 */
namespace zin;

$items = array();
$items[] = array('name' => 'id',        'control' => 'hidden', 'hidden' => true);
$items[] = array('name' => 'id',        'label' => $lang->meetingroom->id,        'control' => 'index', 'width' => '50px');
$items[] = array('name' => 'name',      'label' => $lang->meetingroom->name,      'control' => 'input', 'required' => true);
$items[] = array('name' => 'position',  'label' => $lang->meetingroom->position,  'control' => 'input', 'width' => '180px', 'required' => true);
$items[] = array('name' => 'seats',     'label' => $lang->meetingroom->seats,     'control' => 'input', 'width' => '100px', 'required' => true);
$items[] = array('name' => 'equipment', 'label' => $lang->meetingroom->equipment, 'control' => 'picker', 'items' => $lang->meetingroom->equipmentList, 'multiple' => true, 'width' => '260px', 'required' => true);
$items[] = array('name' => 'openTime',  'label' => $lang->meetingroom->openTime,  'control' => 'picker', 'items' => $lang->meetingroom->openTimeList, 'multiple' => true, 'width' => '260px', 'required' => true);

formBatchPanel
(
    set::title($lang->meetingroom->batchEdit),
    set::url(createLink('meetingroom', 'batchEdit')),
    set::mode('edit'),
    set::items($items),
    set::data(array_values($rooms))
);
