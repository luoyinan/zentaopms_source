window.refreshGantt = function(link)
{
    $.getJSON(link, function(response)
    {
        const data = JSON.parse(response.data);
        gantt._clear_data();
        gantt.parse(data.executionData);
        initGanttSplitState();
    });
}

window.setMinBuffering = function(event)
{
    const checked = $(event.target).prop('checked');
    $('.scheduleBox input[name=minBuffering]').prop('disabled', !checked);
    if(!checked) $('.scheduleBox input[name=minBuffering]').val('');
}

window.setManualSchedule = function(event)
{
    const checked = $(event.target).prop('checked');
    $('.globalScheduleBox').prop('disabled', checked);
}

window.setGlobalSchedule = function(event)
{
    const checked = $(event.target).prop('checked');
    $('.manualScheduleBox').prop('disabled', checked);

    if(!checked) return true;
    const minBuffering = $('.scheduleBox input[name=minBuffering]').val();
    $.getJSON($.createLink('execution', 'ajaxAutoScheduleForTask', `executionID=${executionID}&minBuffering=${minBuffering}`), function(response)
    {
        if(typeof response.data !== 'undefined')
        {
            zui.Modal.confirm(response.message).then(result =>
            {
                if(result)
                {
                    const form = new FormData();
                    form.append('data', JSON.stringify(response.data));
                    $.ajaxSubmit({url: $.createLink('project', 'ajaxSaveTaskSchedule', 'type=auto&from=execution'), data: form});
                }
            });
        }
        else if(response.result == 'success')
        {
            zui.Messager.show({message: response.message, type: 'success', close: true});
        }
        else
        {
            zui.Modal.alert(response.message);
        }

        $('.manualScheduleBox').prop('disabled', false);
        $(event.target).prop('checked', false);
        $('.scheduleBox menu').removeClass('show');
    })
}
