const TODO_CALENDAR_SELECTOR    = '#todoCalendar';
const TODO_OBJECT_TABS_SELECTOR = '#todoObjectTabs';
const TODO_DAY_CELL_SELECTOR    = '.calendar-month-view-day';
const TODO_EVENT_ITEM_SELECTOR  = '.calendar-month-view-day-events li.list-item';
const TODO_OBJECT_DND_NS        = '.todoObjectDnD';
const TODO_DROP_ACTIVE_CLASS    = 'todo-drop-active';

let objectDraggableInstance = null;
let nativeDraggingElement   = null;

function escapeHTML(text)
{
    return String(text || '').replace(/[&<>"']/g, (char) => {
        const map = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'};
        return map[char] || char;
    });
}

function formatTodoDate(date)
{
    const target = new Date(date);
    if(Number.isNaN(target.getTime())) return '';

    const year  = target.getFullYear();
    const month = `${target.getMonth() + 1}`.padStart(2, '0');
    const day   = `${target.getDate()}`.padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function formatTodoTime(date)
{
    const target = new Date(date);
    if(Number.isNaN(target.getTime())) return '';

    const hour   = `${target.getHours()}`.padStart(2, '0');
    const minute = `${target.getMinutes()}`.padStart(2, '0');
    return `${hour}:${minute}`;
}

function getTodoCalendar()
{
    return $(TODO_CALENDAR_SELECTOR).zui('calendar');
}

function getDropDate(dropElement)
{
    const $dropDay = $(dropElement).closest('[z-date], [data-date]');
    if(!$dropDay.length) return null;

    const dateText = $dropDay.attr('z-date') || $dropDay.attr('data-date');
    if(!dateText) return null;

    const date = new Date(dateText);
    return Number.isNaN(date.getTime()) ? null : date;
}

function normalizeTodoEvent(todo)
{
    return {
        id    : String(todo.id),
        title : todo.title,
        start : todo.start,
        end   : todo.end || null,
        allDay: !todo.end,
        color : todo.finish ? 'var(--color-success-300)' : 'var(--color-primary-200)',
        todo,
    };
}

async function handleSwitchCalendarDate(date)
{
    const calendar = this && typeof this.modifyEvents === 'function'
        ? this
        : (this && this.$ && typeof this.$.modifyEvents === 'function' ? this.$ : null);
    if(!calendar) return;

    const displayYear = date.getFullYear();
    try
    {
        const data   = await $.getJSON(ajaxGetTodosUrl.replace('{year}', displayYear));
        const events = data.map(normalizeTodoEvent);
        if(typeof calendar.changeState === 'function')
        {
            calendar.changeState({modifiedEvents: []});
        }
        calendar.modifyEvents(events);
    }
    catch(e)
    {
        zui.Messager.fail(textNetworkError);
    }
}

function renderEvent(event)
{
    const todo    = event.todo || event;
    const pri     = todo.pri ? `<span class="todo-event-pri">(${escapeHTML(todo.pri)})</span>` : '';
    const time    = todo.end ? formatTodoTime(todo.start) : '';
    const icon    = todo.finish ? 'check-circle text-success' : 'check-circle text-gray';
    const viewUrl = todoViewUrl.replace('{id}', todo.id);

    return {
        icon         : null,
        leading      : null,
        className    : 'state',
        hint         : todo.title,
        'data-url'   : todo.url || viewUrl,
        text         : {
            html     : `<span class="todo-calendar-event"><span class="icon icon-${icon} todo-event-toggle" data-id="${todo.id}" data-finish="${todo.finish ? 1 : 0}"></span><span class="todo-event-title">${pri}${escapeHTML(todo.title)}</span></span>`,
            className: 'flex items-center gap-1 min-w-0'
        },
        trailing     : time ? zui.jsx`<span class="text-xs text-muted shrink-0">${time}</span>` : null,
    };
}

function updateTabCount(type)
{
    const $pane = $(`${TODO_OBJECT_TABS_SELECTOR} #tab_${type}`);
    if(!$pane.length) return;

    const count = $pane.find('.todo-item, .todoList').length;
    $(`${TODO_OBJECT_TABS_SELECTOR} .tabs-nav [href="#tab_${type}"]`).find('.label-todo').text(count);
}

function removeSourceItem(element)
{
    const $link = $(element);
    const type  = $link.data('objectType');
    $link.closest('.todo-object-row').remove();
    if(type) updateTabCount(type);
}

window.refreshCalendar = function()
{
    const calendar = getTodoCalendar();
    if(!calendar) return window.location.reload();

    const calendarInstance = calendar.$ && typeof calendar.$.modifyEvents === 'function' ? calendar.$ : calendar;
    calendar.displayDate = undefined;
    if(calendarInstance !== calendar) calendarInstance.displayDate = undefined;

    return handleSwitchCalendarDate.call(calendarInstance, new Date(calendarInstance.date || Date.now()));
};

function openBatchAddByDate(date)
{
    const targetDate = new Date(date);
    openBatchCreate(batchAddUrl.replace('{date}', zui.formatDate(targetDate, 'yyyyMMdd')));
}

function changeTodoDate(todoID, date)
{
    const calendar = getTodoCalendar();
    if(!calendar) return;

    $.ajax({
        url     : ajaxChangeDaysUrl.replace('{id}', todoID).replace('{date}', new Date(date).getTime()),
        success : window.refreshCalendar,
        error   : function()
        {
            zui.Messager.fail(textNetworkError);
            window.refreshCalendar();
        }
    });
}

function getTodoIDFromDragElement(element)
{
    const $element = $(element);
    if(!$element.length) return '';

    const todoID = $element.attr('z-key');
    return todoID && todoID !== 'more' ? String(todoID) : '';
}

function toggleTodoStatus(todoID, isFinished)
{
    const actionURL = isFinished ? ajaxActivateUrl : ajaxFinishUrl;

    $.ajax({
        url    : actionURL.replace('{id}', todoID),
        success: function(data)
        {
            data = JSON.parse(data);
            zui.Messager.success(data.message);
            window.refreshCalendar();
        },
        error  : function()
        {
            zui.Messager.fail(textNetworkError);
            window.refreshCalendar();
        }
    });
}

function createTodoFromObject(dragElement, dropElement)
{
    const calendar   = getTodoCalendar();
    const objectType = dragElement.dataset.objectType;
    const objectID   = dragElement.dataset.objectId || dragElement.dataset.id;
    const objectName = dragElement.dataset.title;
    const date       = getDropDate(dropElement);

    if(!calendar || !objectID || !moduleList.includes(objectType) || !date) return;

    $.ajax({
        type    : 'POST',
        dataType: 'json',
        url     : todoCreateUrl,
        data    : {
            date    : formatTodoDate(date),
            type    : objectType,
            objectID: objectID,
            name    : objectName,
            begin   : '',
            end     : '',
            pri     : 3,
            status  : 'wait',
        },
        success : function()
        {
            removeSourceItem(dragElement);
            window.refreshCalendar();
        },
        error   : function()
        {
            zui.Messager.fail(textNetworkError);
            window.refreshCalendar();
        }
    });
}

function handleClickCalendarEvent(todo, _category, event)
{
    const $target = $(event.target);
    const $toggle = $target.closest('.todo-event-toggle');
    if($toggle.length)
    {
        const todoID     = todo ? todo.id : 0;
        const isFinished = +($toggle.data('finish')) === 1;
        if(todoID) toggleTodoStatus(todoID, isFinished);
    }
    else
    {
        const url = $target.closest('.listitem').attr('data-url');
        if(url) zui.Modal.open({url, size: 'lg'});
    }
}

function handleCalendarMounted()
{
    /* Init draggable */
    this._calendarDraggable = new zui.Draggable('#mainContent', {
        selector     : `.todo-item[draggable="true"], ${TODO_EVENT_ITEM_SELECTOR}`,
        target       : function()
        {
            return $(TODO_CALENDAR_SELECTOR).find(`${TODO_DAY_CELL_SELECTOR}, ${TODO_EVENT_ITEM_SELECTOR}`);
        },
        droppingClass : TODO_DROP_ACTIVE_CLASS,
        canDrop : function(_, dragElement, dropElement)
        {
            const dropDate = getDropDate(dropElement);
            if(!dropDate) return false;

            if((dragElement.dataset.objectId || dragElement.dataset.id) && dragElement.dataset.objectType) return true;
            return !!getTodoIDFromDragElement(dragElement);
        },
        onDragEnd: function()
        {
            $(TODO_CALENDAR_SELECTOR).find(`${TODO_DAY_CELL_SELECTOR}, ${TODO_EVENT_ITEM_SELECTOR}`).removeClass(TODO_DROP_ACTIVE_CLASS);
        },
        onDrop  : function(_, dragElement, dropElement)
        {
            if((dragElement.dataset.objectId || dragElement.dataset.id) && dragElement.dataset.objectType)
            {
                createTodoFromObject(dragElement, dropElement);
                return;
            }

            const todoID   = getTodoIDFromDragElement(dragElement);
            const dragDate = getDropDate(dragElement);
            const date     = getDropDate(dropElement);
            if(dragDate && date && formatTodoDate(dragDate) === formatTodoDate(date)) return;
            if(todoID && date) changeTodoDate(todoID, date);
        }
    });
}

function handleCalendarUnmounted()
{
    const draggable = this._calendarDraggable;
    if(draggable)
    {
        draggable.destroy();
        delete this._calendarDraggable;
    }
}
window.setCalendarOptions = function(_, options)
{
    return $.extend({
        onSwitchDate : handleSwitchCalendarDate,
        eventRender  : renderEvent,
        onClickDay   : (date) => openBatchAddByDate(date),
        onClickEvent : handleClickCalendarEvent,
        onMounted    : handleCalendarMounted,
        onUnmounted  : handleCalendarUnmounted,
    }, options);
};

window.exportCalendar = function(href)
{
    const calendar = getTodoCalendar();
    const thisDate = new Date(calendar && calendar.$ && calendar.$.date ? calendar.$.date : Date.now());
    const year     = thisDate.getFullYear();
    const month    = thisDate.getMonth() + 1;

    href = href.replace('_date_', `${year}_${month}_01`);
    zui.Modal.open({url: href, size: 600});
};

window.openBatchCreate = function(url)
{
    zui.Modal.open({url, width: '80%', showHeader: false});
    return false;
};
