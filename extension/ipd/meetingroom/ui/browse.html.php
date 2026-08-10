<?php
/**
 * The browse view file of meetingroom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Ruogu Liu <liuruogu@chandao.com>
 * @package     meetingroom
 * @link        https://www.zentao.net
 */
namespace zin;

$canCreate      = common::hasPriv('meetingroom', 'create');
$canBatchCreate = common::hasPriv('meetingroom', 'batchCreate');
$canBatchEdit   = common::hasPriv('meetingroom', 'batchEdit');
$canEdit        = common::hasPriv('meetingroom', 'edit');

$linkParams = "browseType={key}&param={$param}&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
featureBar
(
    set::current($browseType),
    set::linkParams($linkParams),
    li(searchToggle(set::module('meetingroom'), set::open($browseType == 'bysearch')))
);

$createLink      = createLink('meetingroom', 'create');
$batchCreateLink = createLink('meetingroom', 'batchCreate');
$createItem      = array('text' => $lang->meetingroom->create,      'url' => $createLink);
$batchCreateItem = array('text' => $lang->meetingroom->batchCreate, 'url' => $batchCreateLink);

toolbar
(
    $canCreate && $canBatchCreate ? btngroup
    (
        btn(setClass('btn primary'), set::icon('plus'), set::url($createLink), $lang->meetingroom->create),
        dropdown
        (
            btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::items(array($createItem, $batchCreateItem)),
            set::placement('bottom-end')
        )
    ) : null,
    $canCreate && !$canBatchCreate ? item(set($createItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null,
    $canBatchCreate && !$canCreate ? item(set($batchCreateItem + array('class' => 'btn primary', 'icon' => 'plus'))) : null
);

$cols = array();
$cols['id']            = array('name' => 'id', 'title' => $lang->meetingroom->id, 'type' => $canBatchEdit ? 'checkID' : 'id', 'fixed' => 'left', 'width' => '80', 'sortType' => true, 'show' => true);
$cols['name']          = array('name' => 'name', 'title' => $lang->meetingroom->name, 'type' => 'title', 'link' => array('module' => 'meetingroom', 'method' => 'view', 'params' => 'roomID={id}'), 'sortType' => true, 'show' => true);
$cols['position']      = array('name' => 'position', 'title' => $lang->meetingroom->position, 'type' => 'text', 'width' => '120', 'sortType' => true, 'show' => true);
$cols['seats']         = array('name' => 'seats', 'title' => $lang->meetingroom->seats, 'type' => 'text', 'width' => '80', 'sortType' => true, 'show' => true);
$cols['equipmentName'] = array('name' => 'equipmentName', 'title' => $lang->meetingroom->equipment, 'type' => 'text', 'width' => '280', 'show' => true);
$cols['openTimeName']  = array('name' => 'openTimeName', 'title' => $lang->meetingroom->openTime, 'type' => 'text', 'width' => '280', 'show' => true);
$cols['actions']       = array
(
    'name'     => 'actions',
    'title'    => $lang->actions,
    'type'     => 'actions',
    'sortType' => false,
    'width'    => '80',
    'list'     => array
    (
        'edit' => array('icon' => 'edit', 'text' => $lang->edit, 'url' => array('module' => 'meetingroom', 'method' => 'edit', 'params' => 'roomID={id}'))
    ),
    'menu'     => array('edit')
);
if(!$canEdit) unset($cols['actions']['list'], $cols['actions']['menu']);

$rooms = initTableData($rooms, $cols, $this->meetingroom);

$footToolbar = $canBatchEdit ? array
(
    'items'    => array(array('text' => $lang->edit, 'className' => 'secondary batch-btn not-open-url', 'data-url' => createLink('meetingroom', 'batchEdit'))),
    'btnProps' => array('size' => 'sm', 'btnType' => 'secondary')
) : null;

dtable
(
    setID('meetingroomList'),
    set::cols($cols),
    set::data(array_values($rooms)),
    set::checkable($canBatchEdit),
    set::orderBy($orderBy),
    set::sortLink(inlink('browse', "browseType={$browseType}&param={$param}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footToolbar($footToolbar),
    set::footPager(usePager()),
    set::createTip($lang->meetingroom->create),
    set::createLink($canCreate ? $createLink : '')
);
