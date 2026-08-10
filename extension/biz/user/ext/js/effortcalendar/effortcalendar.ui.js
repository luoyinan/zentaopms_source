const EFFORT_CALENDAR_SELECTOR = '#calendar';

function escapeHtml(value)
{
    return String(value ?? '').replace(/[&<>"']/g, function(char)
    {
        const maps = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'};
        return maps[char];
    });
}

function renderEffortEvent(event)
{
    const effort   = event.effort;
    const rendered = {
        icon    : null,
        hint    : effort.title,
        text    : {html: `<span class="title">${escapeHtml(effort.title)}</span>`, className: 'flex items-center gap-1'},
        trailing: zui.jsx`<span class="text-xs text-primary">${`${effort.consumed}h`}</span>`,
    };

    if(effort.url)
    {
        rendered.url            = effort.url;
        rendered['data-toggle'] = 'modal';
    }

    return rendered;
}

window.setCalendarOptions = function(_, options)
{
    return $.extend({
        dragThenDrop: false,
        events: (options.tasks || []).map((effort) => {
            return {
                id     : effort.id,
                title  : effort.title,
                start  : effort.start,
                end    : effort.end || effort.start,
                allDay : true,
                effort : effort,
            };
        }),
        eventRender: renderEffortEvent,
    }, options);
};

window.exportCalendar = function(href)
{
    const calendar = $(EFFORT_CALENDAR_SELECTOR).zui('calendar');
    const thisDate = new Date(calendar?.$?.date || Date.now());
    const year     = thisDate.getFullYear();
    const month    = thisDate.getMonth() + 1;

    href = href.replace('_date_', `${year}_${month}_01`);
    zui.Modal.open({url: href, size: 600});
};
