const EFFORT_CALENDAR_SELECTOR = '#effortCalendar';

function getEffortCalendar()
{
    return $(EFFORT_CALENDAR_SELECTOR).zui('calendar');
}

function normalizeEffortEvent(effort)
{
    return {
        id      : effort.id,
        start   : effort.start,
        end     : effort.end,
        title   : effort.title,
        allDay  : !effort.end,
        consumed: Number(effort.consumed).toFixed(2),
        effort  : effort,
    };
}

async function handleSwitchCalendarDate(date)
{
    const calendar = this && typeof this.modifyEvents === 'function'
        ? this
        : (this && this.$ && typeof this.$.modifyEvents === 'function' ? this.$ : null);
    if(!calendar) return;

    const displayYear = date.getFullYear();
    const props       = this?.props || calendar?.props || {};
    try
    {
        const data   = await $.getJSON(props.ajaxGetEffortsUrl.replace('{year}', displayYear));
        const events = data.map(normalizeEffortEvent);
        if(typeof calendar.changeState === 'function')
        {
            calendar.changeState({modifiedEvents: []});
        }
        calendar.modifyEvents(events);
    }
    catch
    {
        zui.Messager.fail(props.textNetworkError);
    }
}

function renderEvent(event)
{
    const effort = event.effort;
    const url    = effort.url || this?.props?.effortViewUrl?.replace('{id}', effort.id);

    return {
        icon         : null,
        className    : 'state',
        hint         : effort.title,
        'data-url'   : url,
        text         : {html: effort.title, className: 'flex items-center gap-1'},
        trailing     : zui.jsx`<div class="text-xs text-primary">${Number(effort.consumed).toFixed(2)}h</div>`,
    };
}

function canCreateEffort(date)
{
    const targetDate = new Date(date);
    const today      = new Date();

    targetDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);

    return targetDate.getTime() <= today.getTime();
}

function openBatchAddByDate(date)
{
    const calendar = getEffortCalendar();
    const batchURL = calendar?.props?.batchAddUrl;
    if(!batchURL) return;

    const targetDate = new Date(date);
    openBatchCreate(batchURL.replace('{date}', zui.formatDate(targetDate, 'yyyyMMdd')));
}

function handleClickCalendarEvent(_effort, _category, event)
{
    const url = $(event.target).closest('.listitem').attr('data-url');
    if(url) zui.Modal.open({url});
}

window.setCalendarOptions = function(_, options)
{
    return $.extend({
        onSwitchDate: handleSwitchCalendarDate,
        eventRender : renderEvent,
        onClickDay  : (date) => {
            if(canCreateEffort(date)) openBatchAddByDate(date);
        },
        onClickEvent: handleClickCalendarEvent,
    }, options);
};

window.exportCalendar = function(href)
{
    const calendar = getEffortCalendar();
    const thisDate = new Date(calendar && calendar.$ && calendar.$.date ? calendar.$.date : Date.now());
    const year     = thisDate.getFullYear();
    const month    = thisDate.getMonth() + 1;

    href = href.replace('_date_', `${year}_${month}_01`);
    zui.Modal.open({url: href, size: 600});
};

window.openBatchCreate = function(url)
{
    zui.Modal.open({url, showHeader: false, size: 'lg'});
    return false;
};

window.refreshCalendar = function()
{
    const calendar = getEffortCalendar();
    if(!calendar) return window.location.reload();

    const calendarInstance = calendar.$ && typeof calendar.$.modifyEvents === 'function' ? calendar.$ : calendar;
    calendar.displayDate = undefined;
    if(calendarInstance !== calendar) calendarInstance.displayDate = undefined;

    return handleSwitchCalendarDate.call(calendarInstance, new Date(calendarInstance.date || Date.now()));
};
