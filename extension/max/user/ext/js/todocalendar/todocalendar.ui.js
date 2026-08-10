function escapeHtml(value)
{
    return String(value ?? '').replace(/[&<>"']/g, function(char)
    {
        const maps = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'};
        return maps[char];
    });
}

function formatTodoTime(value)
{
    const date = new Date(value);
    return `${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
}

function isExpired(todo)
{
    if(todo.finish) return false;

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const todoDate = todo.allDay ? new Date(`${todo.start}T00:00:00`) : new Date(todo.start);
    todoDate.setHours(0, 0, 0, 0);
    return todoDate < today;
}

function renderTodoEvent(event)
{
    const todo      = event.todo;
    const pri       = todo.pri ? `(${todo.pri})` : '';
    const title     = `${pri}${todo.title}`;
    const textClass = ['flex', 'items-center', 'gap-1'];

    if(todo.finish) textClass.push('text-gray-500');
    if(isExpired(todo)) textClass.push('text-danger');

    return {
        hint         : title,
        url          : todo.url,
        text         : {
            html     : `<span class="${textClass.join(' ')}"><i class="icon ${todo.finish ? 'icon-check-circle' : 'icon-check-circle-empty'}"></i><span class="title">${escapeHtml(title)}</span></span>`,
            className: 'flex items-center gap-1',
        },
        trailing     : todo.allDay ? null : zui.jsx`<span class="text-xs muted">${formatTodoTime(event.start)}</span>`,
        'data-toggle': 'modal',
        'data-size'  : 'lg',
    };
}

window.setCalendarOptions = function(_, options)
{
    return $.extend({
        dragThenDrop: false,
        events: (options.tasks || []).map(todo => {
            return {
                id    : todo.id,
                title : todo.title,
                start : todo.start,
                end   : todo.end,
                allDay: todo.allDay,
                todo  : todo,
            };
        }),
        eventRender: renderTodoEvent,
    }, options);
};
