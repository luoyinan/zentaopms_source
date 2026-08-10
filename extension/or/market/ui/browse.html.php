<?php
/**
 * The browse view file of market module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      sunguangning <sunguangning@chandao.com>
 * @package     market
 * @link        https://www.zentao.net
 */
namespace zin;

featureBar
(
    set::current($browseType),
    set::queryMenuLinkCallback(fn($key) => str_replace('{queryID}', (string)$key, $queryMenuLink)),
    li(searchToggle(set::module('market'), set::open($browseType == 'bysearch')))
);

jsVar('confirmDelete', $lang->market->confirmDelete);

$tableData = array_values(initTableData($markets, $config->market->dtable->fieldList));
foreach($tableData as $market)
{
    $market->scale      = $market->scale != 0 ? $market->scale . ' ' . $lang->market->hundredMillion : '';
    $market->openedDate = helper::isZeroDate($market->openedDate) ? '' : substr($market->openedDate, 5, 11);
}

toolbar
(
    hasPriv('market', 'create') ? item
    (
        set::icon('plus'),
        set::text($lang->market->create),
        set::url(createLink('market', 'create')),
        set::className('primary')
    ) : null
);

dtable
(
    set::cols(array_values($config->market->dtable->fieldList)),
    set::data($tableData),
    set::orderBy($orderBy),
    set::sortLink(createLink('market', 'browse', "browseType={$browseType}&param=0&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}")),
    set::footPager(usePager()),
    set::emptyTip($lang->noData),
    set::createTip($lang->market->create),
    hasPriv('market', 'create') ? set::createLink(createLink('market', 'create')) : null
);

render();
