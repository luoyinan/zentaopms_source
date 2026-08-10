<?php
/**
 * The ui view file of effortcalendar method of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     user
 * @link        https://www.zentao.net
 */
namespace zin;

include $app->getModuleRoot() . 'user/ui/featurebar.html.php';

$effortEvents = json_decode($efforts, true);
if(!is_array($effortEvents)) $effortEvents = array();

$calendarItems = array();
if(hasPriv('user', 'todocalendar'))
{
    $calendarItems[] = array('text' => $lang->todo->common, 'url' => inlink('todocalendar', "userID={$user->id}"), 'active' => false);
}
elseif(hasPriv('user', 'todo'))
{
    $calendarItems[] = array('text' => $lang->todo->common, 'url' => inlink('todo', "userID={$user->id}&type=all"), 'active' => false);
}
$calendarItems[] = array('className' => 'primary', 'text' => $lang->effort->common, 'url' => inlink('effortcalendar', "userID={$user->id}"), 'active' => true);

$calendarToolbar = array
(
    array('className' => 'ghost', 'text' => $lang->todo->all,   'url' => inlink('todo', "userID={$user->id}&type=all")),
    array('className' => 'ghost', 'text' => $lang->effort->all, 'url' => inlink('effort', "userID={$user->id}&type=all")),
);

$headerActions = array('className' => 'justify-left switch-btn', 'gap' => 0, 'items' => $calendarItems, 'headerProps' => array('navItems' => $calendarToolbar));

$toolbarItems = array();
if(hasPriv('effort', 'export'))
{
    $toolbarItems[] = array
    (
        'type'         => 'ghost',
        'text'         => $lang->export,
        'icon'         => 'export',
        'zui-on-click' => array('call' => 'exportCalendar', 'params' => array(createLink('effort', 'export', "userID={$user->id}&orderBy=date_asc,begin_asc&date=_date_")))
    );
}

if($toolbarItems) toolbar(set::items($toolbarItems));

panel
(
    zui::calendar
    (
        set::_id('calendar'),
        set::tasks($effortEvents),
        set::headerActions($headerActions),
        set::headerProps(array('navItems' => $calendarToolbar)),
        set::hideEmptyWeekends(),
        set('$options', jsRaw('window.setCalendarOptions'))
    )
);
