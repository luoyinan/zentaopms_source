<?php
/**
 * The bug view file of user module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Wang Yidong <yidong@easycorp.ltd>
 * @package     user
 * @link        https://www.zentao.net
 */
namespace zin;
include $app->getModuleRoot() . 'user/ui/featurebar.html.php';

$that = zget($lang->user->thirdPerson, $user->gender);
$riskNavs['assignedTo'] = array('text' => sprintf($lang->user->assignedTo, $that), 'url' => inlink('risk', "userID={$user->id}&type=assignedTo&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
$riskNavs['createdBy']  = array('text' => sprintf($lang->user->openedBy,   $that), 'url' => inlink('risk', "userID={$user->id}&type=createdBy&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
$riskNavs['resolvedBy'] = array('text' => sprintf($lang->user->resolvedBy, $that), 'url' => inlink('risk', "userID={$user->id}&type=resolvedBy&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
$riskNavs['closedBy']   = array('text' => sprintf($lang->user->closedBy,   $that), 'url' => inlink('risk', "userID={$user->id}&type=closedBy&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
if(isset($riskNavs[$type])) $riskNavs[$type]['active'] = true;

$cols = $config->risk->dtable->fieldList;
unset($cols['assignedTo'], $cols['relatedObject'], $cols['actions']);
$cols['id']['checkbox']          = false;
$cols['name']['data-toggle']     = 'modal';
$cols['name']['data-size']       = 'lg';
$cols['identifiedDate']['title'] = $lang->risk->identifiedDate;

$cols = array_map(function($col)
{
    unset($col['fixed'], $col['group']);
    return $col;
}, $cols);

$risks = initTableData($risks, $cols);

div
(
    setClass('shadow-sm rounded canvas'),
    nav(setClass('dtable-sub-nav py-1'), set::items($riskNavs)),
    dtable
    (
        set::_className('shadow-none'),
        set::extraHeight('+.dtable-sub-nav'),
        set::bordered(true),
        set::cols($cols),
        set::data(array_values($risks)),
        set::orderBy($orderBy),
        set::sortLink(inlink('risk', "userID={$user->id}&type={$type}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
        set::footPager(usePager())
    )
);

render();
