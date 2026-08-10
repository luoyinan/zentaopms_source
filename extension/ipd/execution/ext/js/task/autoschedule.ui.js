$(function()
{
    if(!isTplProject && hasSchedulePriv && projectModel != 'kanban' && hasTasks)
    {
        const scheduleLink = $.createLink('task', 'autoSchedule', 'executionID=' + executionID) + '#app=' + currentApp;

        if($('#actionBar .btn-group > .btn.primary').length)
        {
            $('#actionBar .btn-group > .btn.primary').parent().before('<a class="btn btn-primary ghost" href="' + scheduleLink + '">' + autoScheduleLang + '</a>');
        }
        else if($('#actionBar > .btn.primary').length)
        {
            $('#actionBar > .btn.primary').before('<a class="btn btn-primary ghost" href="' + scheduleLink + '">' + autoScheduleLang + '</a>');
        }
        else
        {
            $('#actionBar').append('<a class="btn btn-primary ghost" href="' + scheduleLink + '">' + autoScheduleLang + '</a>');
        }
    }
})
