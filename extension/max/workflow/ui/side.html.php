<?php
/**
 * The side file of workflow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflow
 * @link        https://www.zentao.net
 */
namespace zin;

$menuItems     = array();
$currentModule = $this->app->getModuleName();
$currentMethod = $this->app->getMethodName();
foreach($lang->workfloweditor->moreSettings as $setting)
{
    list($label, $moduleName, $methodName, $params) = explode('|', $setting);
    if(strpos($config->workflow->noExportModule, ",{$flow->module},") !== false && $methodName == 'setExport') continue;
    if($this->session->workflowGroupID > 0 && $moduleName != 'workflow') continue;
    if($this->session->workflowGroupID > 0 && $methodName == 'setFulltextSearch') continue;
    if(!commonModel::hasPriv($moduleName, $methodName)) continue;
    if($flow->module != 'charter' && $moduleName == 'workflow' && $methodName == 'setapproval' && $config->edition == 'biz') continue;

    $class  = ($currentModule == $moduleName && $currentMethod == strtolower($methodName)) ? 'active' : '';
    $params = ($moduleName == 'workflow' && $methodName != 'setapproval') ? sprintf($params, $flow->id) : sprintf($params, $flow->module);
    $menuItems[] = li
    (
        setClass('nav-item w-full'),
        a
        (
            setClass('ellipsis guide-tab text-dark title', $class),
            set::href(createLink($moduleName, $methodName, $params)), $label
        )
    );
}

$sideBar[] = div
(
    setClass('bg-canvas p-4'),
    ul
    (
        setClass('nav nav-stacked'),
        $menuItems
    )
);
