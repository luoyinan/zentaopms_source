<?php
/**
 * The todocalendar view file of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Tian Shujie<tianshujie@easycorp.ltd>
 * @package     user
 * @link        https://www.zentao.net
 */

namespace zin;

include $app->getModuleRoot() . 'user/ui/featurebar.html.php';

$todoEvents = json_decode($todos, true);
if(!is_array($todoEvents)) $todoEvents = array();

$calendarItems = array(array('className' => 'primary', 'text' => $lang->todo->common, 'url' => inlink('todocalendar', "userID={$user->id}"), 'active' => true));
if(hasPriv('user', 'effortcalendar')) $calendarItems[] = array('text' => $lang->effort->common, 'url' => inlink('effortcalendar', "userID={$user->id}"), 'active' => false);
elseif(hasPriv('user', 'effort'))     $calendarItems[] = array('text' => $lang->effort->common, 'url' => inlink('effort', "userID={$user->id}"), 'active' => false);

$calendarToolbar = array
(
    array('className' => 'ghost', 'text' => $lang->todo->all,   'url' => inlink('todo', "userID={$user->id}&type=all")),
    array('className' => 'ghost', 'text' => $lang->effort->all, 'url' => inlink('effort', "userID={$user->id}&type=all")),
);
$headerActions = array('className' => 'justify-left switch-btn', 'gap' => 0, 'items' => $calendarItems, 'headerProps' => array('navItems' => $calendarToolbar));
panel
(
    zui::calendar
    (
        set::_id('calendar'),
        set::tasks($todoEvents),
        set::headerActions($headerActions),
        set::headerProps(array('navItems' => $calendarToolbar)),
        set::hideEmptyWeekends(),
        set('$options', jsRaw('window.setCalendarOptions'))
    )
);
