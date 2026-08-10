<?php
/**
 * The calendar view file of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Gunagming Sun <sunguangming@chandao.com>
 * @package     effort
 * @link        https://www.zentao.net
 */
namespace zin;

$featureItems   = array(array('text' => $lang->effort->effortCalendar, 'url' => 'javascript:;', 'active' => true));
$toolbarItems   = array();
$batchCreateURL = createLink('effort', 'batchCreate', 'date=' . str_replace('-', '', $date));

if(isset($effortCount) && hasPriv('my', 'effort'))
{
    $toolbarItems[] = array
    (
        'type'  => 'btnGroup',
        'items' => array
        (
            array
            (
                'icon'  => 'cards-view',
                'class' => 'btn-icon text-primary',
                'hint'  => $lang->effort->calendar,
                'url'   => createLink('effort', 'calendar')
            ),
            array
            (
                'icon'  => 'list',
                'class' => 'btn-icon',
                'hint'  => $lang->effort->list,
                'url'   => createLink('my', 'effort', 'type=all')
            )
        )
    );
}

if(hasPriv('effort', 'export'))
{
    $toolbarItems[] = array
    (
        'type'         => 'ghost',
        'text'         => $lang->effort->export,
        'icon'         => 'export',
        'zui-on-click' => array('call' => 'exportCalendar', 'params' => array(createLink('effort', 'export', "userID={$user->id}&orderBy=date_asc&date=_date_")))
    );
}

if(hasPriv('effort', 'batchCreate'))
{
    $toolbarItems[] = array
    (
        'type'         => 'primary',
        'text'         => $lang->effort->create,
        'icon'         => 'plus',
        'id'           => 'batchCreate',
        'zui-on-click' => array('call' => 'openBatchCreate', 'params' => array($batchCreateURL))
    );
}

featureBar(set::items($featureItems));
toolbar(set::items($toolbarItems));

panel
(
    zui::calendar
    (
        set::_id('effortCalendar'),
        set::hideEmptyWeekends(),
        set::ajaxGetEffortsUrl(createLink('effort', 'ajaxGetEfforts', "userID={$user->id}&year={year}")),
        set::effortViewUrl(createLink('effort', 'view', 'id={id}')),
        set::batchAddUrl(createLink('effort', 'batchCreate', 'date={date}')),
        set::textNetworkError($lang->textNetworkError),
        set::textHasMoreItems($lang->textHasMoreItems),
        set::maxVisibleEvents(6),
        set::forceUpdateID(uniqid()),
        set('$options', jsRaw('window.setCalendarOptions'))
    )
);
