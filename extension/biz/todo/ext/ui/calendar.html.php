<?php
/**
 * The calendar view file of todo module of ZenTaoPMS.
 *
 * @copyright   Copyright 2026 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     todo
 * @link        https://www.zentao.net
 */
namespace zin;

$featureItems = array(array('text' => $lang->todo->todoCalendar, 'url' => 'javascript:;', 'active' => true));
$toolbarItems = array();
$moduleList   = array_values($config->todo->moduleList);

if(hasPriv('my', 'todo'))
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
                'hint'  => $lang->todo->calendar,
                'url'   => createLink('todo', 'calendar')
            ),
            array
            (
                'icon'  => 'list',
                'class' => 'btn-icon',
                'hint'  => $lang->todo->list,
                'url'   => createLink('my', 'todo', 'type=all')
            )
        )
    );
}

if(hasPriv('todo', 'export'))
{
    $toolbarItems[] = array
    (
        'type'        => 'ghost',
        'text'        => $lang->todo->export,
        'icon'        => 'export',
        'url'         => createLink('todo', 'export', "userID={$app->user->id}&orderBy=id_desc"),
        'data-toggle' => 'modal'
    );
}

$createURL       = createLink('todo', 'create', '', '', true);
$batchCreateURL  = createLink('todo', 'batchCreate', '', '', true);
$createItem      = array('text' => $lang->todo->create, 'url' => $createURL, 'data-toggle' => 'modal');
$batchCreateItem = array('text' => $lang->todo->batchCreate, 'url' => 'javascript:;', 'zui-on-click' => array('call' => 'openBatchCreate', 'params' => array($batchCreateURL)));

$createAction = null;
if(hasPriv('todo', 'create') && hasPriv('todo', 'batchCreate'))
{
    $createAction = btnGroup
    (
        btn
        (
            setClass('btn primary'),
            set::icon('plus'),
            set::url($createURL),
            set('data-toggle', 'modal'),
            $lang->todo->create
        ),
        dropdown
        (
            btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
            set::items(array($createItem, $batchCreateItem)),
            set::placement('bottom-end')
        )
    );
}
elseif(hasPriv('todo', 'create'))
{
    $createAction = $createItem + array('type' => 'primary', 'icon' => 'plus');
}
elseif(hasPriv('todo', 'batchCreate'))
{
    $createAction = array
    (
        'type'         => 'primary',
        'text'         => $lang->todo->batchCreate,
        'icon'         => 'plus',
        'url'          => 'javascript:;',
        'zui-on-click' => array('call' => 'openBatchCreate', 'params' => array($batchCreateURL))
    );
}

$canDragObject = hasPriv('todo', 'create');
$tabPanes      = array();
$isFirstTab    = true;

foreach($todoList as $type => $todoSides)
{
    if(empty($todoSides)) continue;

    $items       = array();
    $canDragType = $canDragObject && in_array($type, $moduleList);

    foreach($todoSides as $id => $todoName)
    {
        $viewType = $type == 'task' && $this->config->vision == 'or' ? 'researchtask' : $type;
        $method   = $type == 'feedback' ? 'adminView' : 'view';

        $items[] = array
        (
            'class'      => 'todo-object-row',
            'title'      => $todoName,
            'hint'       => $todoName,
            'url'        => createLink($viewType, $method, "id=$id"),
            'innerClass' => $canDragType ? 'todo-item' : 'todoList',
            'innerAttrs' => array
            (
                'data-toggle' => 'modal',
                'data-size' => 'lg',
                'data-object-id' => (string)$id,
                'data-object-type' => $type,
                'data-title'  => $todoName,
                'draggable'   => $canDragType ? 'true' : null
            )
        );
    }

    $tabPanes[] = tabPane
    (
        set::key("tab_$type"),
        set::title(zget($lang->side, $type, $type)),
        set::active($isFirstTab),
        to::suffix(span(setClass('label label-light label-badge label-todo'), (string)count($items))),
        simpleList
        (
            setClass('todo-list'),
            set::items($items)
        )
    );

    $isFirstTab = false;
}

featureBar(set::items($featureItems));
if(is_array($createAction)) $toolbarItems[] = $createAction;
toolbar(set::items($toolbarItems), $createAction instanceof \zin\node ? $createAction : null);

sidebar
(
    set::side('right'),
    set::width(320),
    panel
    (
        empty($tabPanes) ? div(setClass('todo-object-empty text-center text-gray py-8'), $lang->noData) : tabs
        (
            setID('todoObjectTabs'),
            set::titleClass('text-sm'),
            $tabPanes
        )
    )
);

jsVar('ajaxFinishUrl', createLink('todo', 'finish', 'id={id}'));
jsVar('ajaxActivateUrl', createLink('todo', 'activate', 'id={id}'));
jsVar('ajaxGetTodosUrl', createLink('todo', 'ajaxGetTodos', "userID={$app->user->id}&year={year}"));
jsVar('ajaxChangeDaysUrl', createLink('todo', 'ajaxChangeDays', 'id={id}&milliseconds={date}'));
jsVar('todoCreateUrl', createLink('todo', 'create', '', 'json'));
jsVar('todoViewUrl', createLink('todo', 'view', 'id={id}'));
jsVar('batchAddUrl', createLink('todo', 'batchCreate', 'date={date}'));
jsVar('textNetworkError', $lang->textNetworkError);
jsVar('moduleList', $moduleList);

panel
(
    zui::calendar
    (
        set::_id('todoCalendar'),
        set::hideEmptyWeekends(),
        set::maxVisibleEvents(6),
        set::forceUpdateID(uniqid()),
        set('$options', jsRaw('window.setCalendarOptions'))
    )
);
