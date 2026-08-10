<?php
/**
 * The view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     bug
 * @link        https://www.zentao.net
 */
namespace zin;
global $app;

$methodName = $app->getMethodName();
$config->assetlib->actions->$methodName = $config->assetlib->actions->view;
$config->assetlib->actionList           = $config->assetlib->browse->actionList;
$config->assetlib->actionList['edit']['text']   = zget($lang->assetlib, 'edit'   . ucfirst($lib->type) . 'Lib', $lang->edit);
$config->assetlib->actionList['delete']['text'] = zget($lang->assetlib, 'delete' . ucfirst($lib->type) . 'Lib', $lang->delete);
$config->assetlib->actionList['edit']['hint']   = $config->assetlib->actionList['edit']['text'];
$config->assetlib->actionList['delete']['hint'] = $config->assetlib->actionList['delete']['text'];
$config->assetlib->actionList['edit']['url']['method']   = 'edit'   . ucfirst($lib->type). 'Lib';
$config->assetlib->actionList['delete']['url']['method'] = 'delete' . ucfirst($lib->type) . 'Lib';
$config->assetlib->actionList['delete']['data-confirm']['message'] = zget($lang->assetlib, $lib->type . 'LibDelete', $lang->confirmDelete);

$operateList = $this->loadModel('common')->buildOperateMenu($lib);

/* 初始化主栏内容。Init sections in main column. */
$sections = array();
$sections[] = setting()
    ->title($lang->assetlib->desc)
    ->control('html')
    ->content($lib->desc);

h::css(".detail-side{display:none}");
detail
(
    set::urlFormatter(array('{id}' => $lib->id)),
    set::backBtn(array('url' => createLink('assetlib', "{$lib->type}Lib"))),
    set::objectType('assetlib'),
    set::objectID($lib->id),
    set::object($lib),
    set::deleted($lib->deleted),
    set::sections($sections),
    set::actions($lib->deleted ? array() : array_values($operateList['mainActions']))
);
