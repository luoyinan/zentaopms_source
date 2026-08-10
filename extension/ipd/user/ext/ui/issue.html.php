<?php
/**
 * The issue view file of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     user
 * @link        https://www.zentao.net
 */
namespace zin;

include $app->getModuleRoot() . 'user/ui/featurebar.html.php';

$that = zget($lang->user->thirdPerson, $user->gender);
$issueNavs['assignedTo'] = array('text' => sprintf($lang->user->assignedTo, $that), 'url' => inlink('issue', "userID={$user->id}&type=assignedTo&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
$issueNavs['createdBy']  = array('text' => sprintf($lang->user->openedBy,   $that), 'url' => inlink('issue', "userID={$user->id}&type=createdBy&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
$issueNavs['closedBy']   = array('text' => sprintf($lang->user->closedBy,   $that), 'url' => inlink('issue', "userID={$user->id}&type=closedBy&orderBy={$orderBy}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}"), 'load' => 'table');
if(isset($issueNavs[$type])) $issueNavs[$type]['active'] = true;

$cols = array();
foreach(array('id', 'type', 'title', 'severity', 'pri', 'owner', 'status', 'createdDate') as $field) $cols[$field] = $config->issue->dtable->fieldList[$field];
$cols['id']['checkbox'] = false;
$cols['title']['link']  = array('module' => 'issue', 'method' => 'view', 'params' => 'id={id}');

$cols = array_map(function($col)
{
    unset($col['fixed'], $col['group']);
    return $col;
}, $cols);

foreach($issues as $issue) $issue->createdDate = substr($issue->createdDate, 0, 10);
$issues = initTableData($issues, $cols);

div
(
    setClass('shadow-sm rounded canvas'),
    nav(setClass('dtable-sub-nav py-1'), set::items($issueNavs)),
    dtable
    (
        set::_className('shadow-none'),
        set::extraHeight('+.dtable-sub-nav'),
        set::userMap($users),
        set::bordered(true),
        set::cols($cols),
        set::data(array_values($issues)),
        set::orderBy($orderBy),
        set::sortLink(inlink('issue', "userID={$user->id}&type={$type}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
        set::footPager(usePager())
    )
);
