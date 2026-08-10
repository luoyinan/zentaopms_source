<?php
/**
 * The ui view file of effort method of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     user
 * @link        https://www.zentao.net
 */
namespace zin;

include $app->getModuleRoot() . 'user/ui/featurebar.html.php';

$filterItems = array();
foreach($lang->user->featureBar['effort'] as $key => $name)
{
    $active = $type == $key ? 'active' : '';
    $filterItems[] = div
    (
        setClass('nav-item'),
        a(
            $name,
            set::href(inlink('effort', "userID={$user->id}&type=$key")),
            setClass("btn ghost $active"),
        )
    );
}

div(
    setClass('nav-feature flex mb-2'),
    div(
        setClass('nav-item'),
        a(
            set::href(createLink('user', 'effortcalendar', "id={$user->id}")),
            setClass("btn ghost"),
            icon('back'),
            $lang->goback,
        )
    ),
    $filterItems
);

foreach($efforts as $effort)
{
    if($effort->objectType == 'custom') $effort->objectTitle = '';
}

$cols = $config->user->effort->dtable->fieldList;
dtable
(
    set::cols($cols),
    set::data($efforts),
    set::footPager(usePager())
);
