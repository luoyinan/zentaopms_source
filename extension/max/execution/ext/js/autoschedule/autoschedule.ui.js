window.renderRowData = function($row, index, row)
{
    let $execName = $row.find('.form-batch-input[data-name="name"]');
    $execName.addClass('hidden').after('<div class="form-control-static text-clip" title="' + row.name + '">' + row.name + '</div>');

    let $preBegin = $row.find('.form-batch-input[data-name="preBegin"]');
    $preBegin.addClass('hidden').after('<div class="form-control-static">' + row.preBegin + '</div>');

    let $preEnd = $row.find('.form-batch-input[data-name="preEnd"]');
    $preEnd.addClass('hidden').after('<div class="form-control-static">' + row.preEnd + '</div>');

    let $preLeftDays = $row.find('.form-batch-input[data-name="preLeftDays"]');
    $preLeftDays.addClass('hidden').after('<div class="form-control-static">' + row.preLeftDays + '</div>');

    $row.find('.btn-calendar').toggleClass('disabled', !row.begin || !row.end || row.begin > row.end);

    $row.find('[data-name="begin"] > div.form-group-wrapper').on('inited', function(e, info)
    {
        let $begin = info[0];
        $begin.render({minDate: row.beginRanger.minDate, maxDate: row.beginRanger.maxDate});
    });

    $row.find('[data-name="endBox"] div.end-date-picker').on('inited', function(e, info)
    {
        let $end = info[0];
        $end.render({minDate: row.endRanger.minDate, maxDate: row.endRanger.maxDate});
    });
}

window.getCurrentDate = function()
{
    const date = new Date();
    let year   = date.getFullYear();
    let month  = (date.getMonth() + 1).toString().padStart(2, '0');
    let day    = date.getDate().toString().padStart(2, '0');

    return year + '-' + month + '-' + day;
}

window.clickAutoSchedule = function(event)
{
    const formData = new FormData($(event.target).closest('form').eq(0)[0]);
    const link = $.createLink('execution', 'autoSchedule', 'projectID=' + projectID)

    let form = {};
    for(var d of formData) form[d[0]] = d[1];

    form['type']             = 'updatePage';
    form['changeObjectType'] = '';
    form['changeObjectID']   = '';

    loadPartial(link, '#scheduleTable', {method: 'post', data: form});
}

window.computeLeftDays = function(e, type)
{
    const $row          = $(e).closest('tr');
    const schedule      = JSON.parse((e).val());
    const totalCalendar = Object.entries(schedule.calendar);
    const currentDate   = getCurrentDate();
    let   startIndex    = '';

    for(let i = 0; i < totalCalendar.length; i++)
    {
        if(totalCalendar[i] >= currentDate)
        {
            startIndex = i;
            break;
        }
    }

    let leftDays = 0;
    if(startIndex !== '')
    {
        const leftCalendar = totalCalendar.slice(startIndex);
        leftDays = parseInt(leftCalendar.length);
    }
    else
    {
        const endDate          = totalCalendar[totalCalendar.length - 1][1];
        const DAY_MILLISECONDS = 24 * 60 * 60 * 1000;
        const date1            = new Date(currentDate);
        const date2            = new Date(endDate);
        const time             = date2 - date1;

        leftDays = parseInt(time / DAY_MILLISECONDS);
    }
    if(e.length && e.val()) $row.find('input[name^=leftDays]').val(leftDays);

    if(type)
    {
        const formData = new FormData($(e).closest('form').eq(0)[0]);
        const link = $.createLink('execution', 'autoSchedule', 'projectID=' + projectID)

        let form = {};
        for(var d of formData) form[d[0]] = d[1];

        form['type']             = 'updatePage';
        form['changeObjectType'] = type;
        form['changeObjectID']   = $row.find('div[data-name=id]').text();

        loadPartial(link, '#scheduleTable', {method: 'post', data: form});
    }
}
