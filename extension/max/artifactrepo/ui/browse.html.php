<?php
/**
 * The browse view file of artifact module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Zeng Gang<zenggang@easycorp.ltd>
 * @package     artifact
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('pageLink', $pageLink);

$statusMap = array();
$canCreate = (!$config->inCompose || !empty($hasNexusServer)) && hasPriv('artifactrepo', 'create');

$cols = $config->artifactrepo->dtable->fieldList;
if($inSpace)
{
    if(!empty($cols['actions']['list']['edit'])) $cols['actions']['list']['edit']['url']['params'] = "id={id}&space={$space}";
    $cols['name']['link']['params'] = "id={id}&space={$space}";
    unset($cols['space']);
}
if(!$inSpace) $cols['space']['map'] = $spaces;
$artifactRepos = initTableData($artifactRepos, $cols, $this->artifactrepo);

foreach($artifactRepos as &$repo)
{
    $repo->space = $repo->space ? $repo->space : '';
    $productNames = array();
    $productList  = explode(',', str_replace(' ', '', $repo->products));
    if($productList)
    {
        foreach($productList as $productID)
        {
            if(!isset($products[$productID])) continue;
            $productNames[] = zget($products, $productID, $productID);
        }
        $repo->productNames = implode('，', $productNames);
    }

    if(isset($repo->actions))
    {
        array_unshift($repo->actions, array('url' => $repo->url, 'target' => '_blank', 'icon' => 'menu-my', 'hint' => $lang->artifactrepo->visit));
    }
}

$spaceItems = array();
if(!$inSpace)
{
    $spaceItems[] = array('text' => $lang->artifactrepo->allSpace, 'url' => createLink('artifactrepo', 'browse'));
    foreach($spaces as $spaceID => $spaceName)
    {
        $spaceItems[] = array('text' => $spaceName, 'url' => createLink('artifactrepo', 'browse', "inSpace=false&space=$spaceID"));
    }
}

featureBar
(
    !$inSpace ? to::before
    (
        dropdown
        (
            to('trigger', btn(zget($spaces, $space, $lang->artifactrepo->allSpace), setID('spaceDropdown'), setClass('ghost'))),
            set::items($spaceItems)
        )
    ) : null
);

toolBar
(
    $canCreate ? item(set(array
    (
        'text'  => $lang->artifactrepo->create,
        'icon'  => 'plus',
        'class' => 'btn primary',
        'url'   => createLink('artifactrepo', 'create', "space={$space}"),
    ))) : null
);

dtable
(
    set::cols($cols),
    set::data($artifactRepos),
    set::onRenderCell(jsRaw('window.renderList')),
    set::sortLink(createLink('artifactrepo', 'browse', "inSpace={$inSpace}&space={$space}&browseType={$browseType}&orderBy={name}_{sortType}&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}")),
    set::orderBy($orderBy),
    set::footPager(usePager())
);
