window.renderRowData = function($row, index, row)
{
    const today    = formatDate(new Date());
    const showTips = $('#scheduleTable').data('showTips');

    let $errorTip = $row.find('.form-batch-input[data-name="errorTip"]');
    $errorTip.addClass('hidden');
    if(showTips)
    {
        $('.form-batch-head[data-name="errorTip"], .form-batch-control[data-name="errorTip"]').removeClass('hidden');
        $errorTip.after('<div class="form-control-static">' + row.errorTip + '</div>');
    }
    else
    {
        $('.form-batch-head[data-name="errorTip"], .form-batch-control[data-name="errorTip"]').addClass('hidden');
        $errorTip.find('.form-control-static').remove();
    }

    $row.attr({'data-parent': row.parent, 'data-id': row.id});

    let $execName = $row.find('.form-batch-input[data-name="name"]');
    $execName.addClass('hidden').after('<div class="form-control-static text-clip" title="' + row.name + '">' + row.name + '</div>');

    let $preBegin = $row.find('.form-batch-input[data-name="preEstStarted"]');
    $preBegin.addClass('hidden').after('<div class="form-control-static">' + row.preEstStarted + '</div>');

    let $preEnd = $row.find('.form-batch-input[data-name="preDeadline"]');
    $preEnd.addClass('hidden').after('<div class="form-control-static">' + row.preDeadline + '</div>');

    let $preLeftDays = $row.find('.form-batch-input[data-name="preLeftDays"]');
    let preLeftDays  = computeLeftDays(row.preEstStarted, row.preDeadline);
    if(isNaN(preLeftDays)) preLeftDays = '';
    $preLeftDays.addClass('hidden').after('<div class="form-control-static">' + preLeftDays + '</div>');

    $row.find('[name^=leftDays]').val(computeLeftDays(row.estStarted, row.deadline));

    $row.find('[data-name="estStarted"] > div.form-group-wrapper').on('inited', function(e, info)
    {
        let $estStarted = info[0];
        let options     = {required: true, isAllowDate: (date) => {const realDate = formatDate(date); return {allow: ((realDate >= row.estStartedRanger.minDate.date && realDate <= row.estStartedRanger.maxDate.date) || realDate == row.estStarted)}}};
        if(today < row.estStartedRanger.minDate.date || today > row.estStartedRanger.maxDate.date) options.actions = [];
        $estStarted.render(options);
    });

    $row.find('[data-name="deadline"] > div.form-group-wrapper').on('inited', function(e, info)
    {
        let $deadline = info[0];
        let options   = {required: true, isAllowDate: (date) => {const realDate = formatDate(date); return (realDate >= row.deadlineRanger.minDate.date && realDate <= row.deadlineRanger.maxDate.date) || realDate == row.deadline;}};
        if(today < row.deadlineRanger.minDate.date || today > row.deadlineRanger.maxDate.date) options.actions = [];
        $deadline.render(options);
    });
}

window.changeDateRange = function(event)
{
    let changeType    = $(event.target).closest('td').data('name');
    const $row        = $(event.target).closest('tr');
    const currentID   = $row.data('id');
    const $estStarted = $row.find('div[data-name="estStarted"]');
    const $deadline   = $row.find('div[data-name="deadline"]');

    if(changeType == 'estStarted' && $estStarted.zui('datePicker') !== undefined && $estStarted.zui('datePicker').$.value == '')
    {
        $estStarted.zui('datePicker').$.setValue(tasks[currentID].estStarted);
        $estStarted.zui('datePicker').render();
    }

    if(changeType == 'deadline' && $deadline.zui('datePicker') !== undefined && $deadline.zui('datePicker').$.value == '')
    {
        $deadline.zui('datePicker').$.setValue(tasks[currentID].deadline);
        $deadline.zui('datePicker').render();
    }

    let leftDays = computeLeftDays($estStarted.zui('datePicker').$.value, $deadline.zui('datePicker').$.value);
    if(isNaN(leftDays)) leftDays = '';
    $row.find('[data-name="leftDays"]').val(leftDays);

    if((changeType == 'estStarted' && $(event.target).val() > $row.find('input[name^=deadline]').val()) || (changeType == 'deadline' && $(event.target).val() < $row.find('input[name^=estStarted]').val()))
    {
        const taskID   = $row.find('[data-name=id]').text();
        const link     = $.createLink('task', 'ajaxCheckTaskDate', 'executionID=' + execution.id + '&taskID=' + taskID + '&changeType=' + changeType);
        const formData = new FormData($(event.target).closest('form').eq(0)[0]);
        $.post(link, formData, function(result)
        {
            result = JSON.parse(result);
            zui.Modal.confirm(result.confirmOptions).then((res) =>
            {
                if(res)
                {
                    const otherType = changeType == 'estStarted' ? 'deadline' : 'estStarted';
                    $row.find('input[name^=' + otherType + ']').zui('datePicker').$.setValue(changeType == 'estStarted' ? result.task.deadline : result.task.estStarted).then(() =>
                    {
                        const formData = new FormData($(event.target).closest('form').eq(0)[0]);

                        let form = {};
                        for(var d of formData) form[d[0]] = d[1];
                        form['type'] = 'updatePage';
                        form['mode'] = 'manual';

                        const link = $.createLink('task', 'autoSchedule', 'executionID=' + execution.id)
                        loadPartial(link, '#scheduleTable', {method: 'post', data: form});
                    });
                    $row.find('input[name^=' + otherType + ']').zui('datePicker').render();
                }
                else
                {
                    $(event.target).zui('datePicker').$.setValue(changeType == 'estStarted' ? result.oldTask.estStarted : result.oldTask.deadline);
                    $(event.target).zui('datePicker').render();
                }
            });
        });
    }
    else
    {
        const formData = new FormData($(event.target).closest('form').eq(0)[0]);

        let form = {};
        for(var d of formData) form[d[0]] = d[1];
        form['type'] = 'updatePage';
        form['mode'] = 'manual';

        const link = $.createLink('task', 'autoSchedule', 'executionID=' + execution.id)
        loadPartial(link, '#scheduleTable', {method: 'post', data: form});
    }
}

window.clickAutoSchedule = function(event)
{
    const formData = new FormData($(event.target).closest('form').eq(0)[0]);
    const link = $.createLink('task', 'autoSchedule', 'executionID=' + execution.id)

    let form = {};
    for(var d of formData) form[d[0]] = d[1];

    form['type'] = 'updatePage';
    form['mode'] = 'auto';
    loadPartial(link, '#scheduleTable', {method: 'post', data: form});
}

/**
 * 计算两个日期之间的天数。
 * Compute work days between two dates.
 *
 * @param  string date1
 * @param  string date2
 * @access public
 * @return int
 */
function computeDaysDelta(date1, date2)
{
    const DAY_MILLISECONDS = 24 * 60 * 60 * 1000;
    date1 = new Date(date1);
    date2 = new Date(date2);
    const time = date2 - date1;
    const days = parseInt(time / DAY_MILLISECONDS);
    if(isNaN(days)) return;

    return days;
}

window.formatDate = function(date)
{
    let year  = date.getFullYear();
    let month = (date.getMonth() + 1).toString().padStart(2, '0');
    let day   = date.getDate().toString().padStart(2, '0');

    return year + '-' + month + '-' + day;
}

window.computeLeftDays = function(beginDate, endDate)
{
    if(!endDate) return;

    const schedule      = JSON.parse(execution.schedule);
    const totalCalendar = schedule.calendar ? Object.values(schedule.calendar) : [];
    const currentDate   = formatDate(new Date());
    let   startIndex    = '';
    let   endIndex      = '';

    for(let i = 0; i < totalCalendar.length; i++)
    {
        if(totalCalendar[i] >= currentDate && startIndex === '' && execution.begin <= currentDate)
        {
            startIndex = i;
        }

        if(totalCalendar[i] >= endDate)
        {
            if(totalCalendar[i] == endDate) endIndex = i;
            if(totalCalendar[i] >  endDate) endIndex = i - 1;
            break;
        }
    }

    /* currentDate、endDate 都不在执行内的情况 */
    if(startIndex === '' && endIndex === '' && beginDate > currentDate) return computeDaysDelta(beginDate, endDate);
    if(startIndex === '' && endIndex === '' && beginDate < currentDate) return computeDaysDelta(currentDate, endDate);

    /* currentDate不在，endDate 在执行内, 且截止日期小于等于当前的情况 */
    if(startIndex === '' && endIndex !== '' && endDate <= currentDate) return computeDaysDelta(currentDate, endDate);

    /* currentDate不在，endDate 在执行内, 且截止日期大于当前的情况 */
    if(startIndex === '' && endIndex !== '' && endDate > currentDate)
    {
        let beginIndex = 0;
        for(let i = 0; i < totalCalendar.length; i++)
        {
            if(totalCalendar[i] >= beginDate)
            {
                if(totalCalendar[i] == beginDate) beginIndex = i;
                if(totalCalendar[i] >  beginDate) beginIndex = i - 1;
                break;
            }
        }

        return endIndex - beginIndex + 1;
    }

    /* currentDate在，endDate 不在执行内的情况 */
    if(startIndex !== '' && endIndex === '')
    {
        /* 在执行日历范围内的天数。*/
        const inExecution = totalCalendar.slice(startIndex, totalCalendar.length);

        /* 在执行日历范围外的天数。*/
        const endCalendarObj = new Date(totalCalendar[totalCalendar.length - 1]);
        endCalendarObj.setDate(endCalendarObj.getDate() + 1);              // 日期加一天
        const plusOneDayDate = endCalendarObj.toISOString().split('T')[0]; // 日期格式化
        const outExecution   = computeDaysDelta(plusOneDayDate, endDate);

        return inExecution.length + outExecution;
    }

    /* currentDate、endDate 都在执行内的情况 */
    const leftCalendar = totalCalendar.slice(startIndex, endIndex);
    const leftDays     = leftCalendar.length + 1;

    return leftDays;
}

window.updateParentRow = function($row, changeType)
{
    const parentID   = $row.data('parent');
    const $parent    = $row.parent().find('tr[data-id="' + parentID + '"]');
    const parentDate = $parent.find('div[data-name="' + changeType + '"]').zui('datePicker').$.value;
    const childDate  = $row.find('div[data-name="' + changeType + '"]').zui('datePicker').$.value;

    if(childDate && parentDate != childDate)
    {
        if((changeType == 'estStarted' && childDate < parentDate) || (changeType == 'deadline' && childDate > parentDate))
        {
            $parent.find('div[data-name="' + changeType + '"]').zui('datePicker').$.setValue(childDate);
            $parent.find('div[data-name="' + changeType + '"]').zui('datePicker').render({readonly: true});
        }
        else if(changeType == 'estStarted' && childDate > parentDate)
        {
            let minDate = '';
            $('tr[data-parent="' + parentID + '"]').each(function()
            {
                if(minDate == '' || minDate > $(this).find('div[data-name="estStarted"]').zui('datePicker').$.value) minDate = $(this).find('div[data-name="estStarted"]').zui('datePicker').$.value;
            });

            if(minDate > parentDate)
            {
                $parent.find('div[data-name="estStarted"]').zui('datePicker').$.setValue(minDate);
                $parent.find('div[data-name="estStarted"]').zui('datePicker').render({readonly: true});
            }

        }
        else if(changeType == 'deadline' && childDate < parentDate)
        {
            let maxDate = '';
            $('tr[data-parent="' + parentID + '"]').each(function()
            {
                let $deadlinePicker = $(this).find('div[data-name="deadline"]').zui('datePicker');
                if($deadlinePicker !== undefined && (maxDate == '' || maxDate < $(this).find('div[data-name="deadline"]').zui('datePicker').$.value)) minDate = $(this).find('div[data-name="deadline"]').zui('datePicker').$.value;
            });

            if(maxDate < parentDate)
            {
                $parent.find('div[data-name="deadline"]').zui('datePicker').$.setValue(minDate);
                $parent.find('div[data-name="deadline"]').zui('datePicker').render({readonly: true});
            }
        }
    }

    if(changeType == 'deadline')
    {
        let leftDays = computeLeftDays($row.find('div[data-name="deadline"]').zui('datePicker').$.value);
        if(isNaN(leftDays)) leftDays = '';
        $row.find('[data-name="leftDays"]').val(leftDays);
    }
};

let timer;
window.changeMinBuffering = function(event)
{
    clearTimeout(timer);
    timer = setTimeout(() => {
        const formData = new FormData($(event.target).closest('form').eq(0)[0]);
        const link = $.createLink('task', 'autoSchedule', 'executionID=' + execution.id);

        let form = {};
        for(var d of formData) form[d[0]] = d[1];

        form['type'] = 'updatePage';
        form['mode'] = 'notScheduled';
        loadPartial(link, '#scheduleTable', {method: 'post', data: form});
    }, 500);
}
