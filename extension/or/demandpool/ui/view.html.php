<?php
/**
 * The view view file of demandpool module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Chenxuan Song <songchenxuan@easycorp.ltd>
 * @package     demandpool
 * @link        https://www.zentao.net
 */

namespace zin;

$canModify = !$demandpool->deleted;
$actions = $canModify ? $this->loadModel('common')->buildOperateMenu($demandpool) : array();
if(!empty($actions)) $actions = array_merge($actions['mainActions'], $actions['suffixActions']);

$owner = $reviewer = $productList = '';
foreach(explode(',', $demandpool->owner)    as $user)    $owner       .= zget($users, $user, '') . ' ';
foreach(explode(',', $demandpool->reviewer) as $user)    $reviewer    .= zget($users, $user, '') . ' ';
foreach(explode(',', $demandpool->products) as $product) $productList .= "<p>" . zget($products, $product, '') . "</p>";

$basicInfoItems = array();
$basicInfoItems[$lang->demandpool->owner]       = array('control' => 'text', 'text' => $owner);
$basicInfoItems[$lang->demandpool->reviewer]    = array('control' => 'text', 'text' => $reviewer);
$basicInfoItems[$lang->demandpool->status]      = array('control' => 'text', 'text' => zget($lang->demandpool->statusList, $demandpool->status, ''));
$basicInfoItems[$lang->demandpool->products]    = array('control' => 'html', 'content' => $productList);
$basicInfoItems[$lang->demandpool->acl]         = array('control' => 'text', 'text' => zget($lang->demandpool->aclList, $demandpool->acl, ''));
$basicInfoItems[$lang->demandpool->createdBy]   = array('control' => 'text', 'text' => zget($users, $demandpool->createdBy, ''));
$basicInfoItems[$lang->demandpool->createdDate] = array('control' => 'text', 'text' => $demandpool->createdDate);
$basicInfo = datalist(set::items($basicInfoItems));

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->demandpool->basicInfo)
    ->children(wg($basicInfo));

$sections = array();
$sections[] = setting()
    ->title($lang->demandpool->desc)
    ->control('html')
    ->content(!empty($demandpool->desc) ? $demandpool->desc : $lang->noData);

detail
(
    set::urlFormatter(array('{id}' => $demandpool->id)),
    set::object($demandpool),
    set::objectType('demandpool'),
    set::objectID($demandpool->id),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
