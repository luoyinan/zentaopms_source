window.clickDate = function(event)
{
    if($(event.target).closest('td').hasClass('disabled')) return false;

    const date = $(event.target).closest('td').data('date');
    $("#panel-schedule td[data-date='" + date + "']").toggleClass('active');

    checkWorkDays($(event.target).closest('td').data('week'));
    checkWorkingDays();
    checkOutSideDays();
}

window.clickPrevMonth = function(event)
{
    if($('.table.active').prev('.table').length)
    {
        $('.table.active').removeClass('active').prev().addClass('active');
    }
    checkMonth();
}

window.clickNextMonth = function(event)
{
    if($('.table.active').next('.table').length)
    {
        $('.table.active').removeClass('active').next('.table').addClass('active');
    }
    checkMonth();
}

window.queryYear = function(event)
{
    const currentYear = $('#panel-schedule .table.active').data('date').substr(0,4);
    const year        = $(event.target).closest('a').data('year');
    let month         = $('#panel-schedule .table.active').data('date').substr(5);
    if(currentYear != year) month = $("a.months[data-date^='" + year + "']").first().data('date').substr(5);

    $('#panel-schedule .table.active').removeClass('active');
    $("#panel-schedule .table[data-date='" + year + '-' + month + "']").addClass('active');

    checkMonth();
}

window.queryMonth = function(event)
{
    const year  = $('#panel-schedule .table.active').data('date').substr(0,4);
    const month = $(event.target).closest('a').data('date').substr(5);

    $('#panel-schedule .table.active').removeClass('active');
    $("#panel-schedule .table[data-date='" + year + '-' + month + "']").addClass('active');

    checkMonth();
}

window.changeWorkDays = function(event)
{
    if($(event.target).val() == '1')
    {
        $(event.target).closest('#panel-schedule').find("table td[data-week='6']:not(.disabled)").each(function()
        {
            $(this).toggleClass('active', $(event.target).prop('checked'));
        });
    }
    else if($(event.target).val() == '2')
    {
        $(event.target).closest('#panel-schedule').find("table td[data-week='0']:not(.disabled)").each(function()
        {
            $(this).toggleClass('active', $(event.target).prop('checked'));
        });
    }
    checkWorkingDays();
    checkOutSideDays();
}

window.clickOutSide = function(event)
{
    const date = $(event.target).closest('.outside').data('date');
    $("#panel-schedule td[data-date='" + date + "']").toggleClass('active');

    $(event.target).closest('.outside').remove();

    checkWorkDays($(event.target).closest('.outside').data('week'));
    checkWorkingDays();
    checkOutSideHeader();
}

window.checkMonth = function()
{
    const year  = $('#panel-schedule .table.active').data('date').substr(0,4);
    const month = $('#panel-schedule .table.active').data('date').substr(5);
    $('#panel-schedule .query-year').text(year);
    $('#panel-schedule .query-month').text(month);

    $('#panel-schedule a.years').removeClass('active');
    $("#panel-schedule a.years[data-year^='" + year + "']").addClass('active');

    $('#panel-schedule a.months').addClass('hidden');
    $('#panel-schedule a.months').removeClass('active');
    $("#panel-schedule a.months[data-date^='" + year + "']").removeClass('hidden');
    $("#panel-schedule a.months[data-date^='" + year + '-' + month + "']").addClass('active');

    $('#panel-schedule .btn.prev').toggleClass('disabled', !$('.table.active').prev('.table').length);
    $('#panel-schedule .btn.next').toggleClass('disabled', !$('.table.active').next('.table').length);
}

window.checkWorkDays = function(week)
{
    if(week !== 6 && week !== 0) return false;
    let allActive = true;
    $('#panel-schedule').find("table td.main[data-week='" + week + "']:not(.disabled,.active)").each(function()
    {
        allActive = false;
    });

    const value = week == 6 ? '1' : '2';
    $("input[name='workDays'][value='" + value + "']").prop('checked', allActive);
}

window.checkOutSideDays = function()
{
    let outSideTable = '';
    $('#panel-schedule').find("table td.main:not(.disabled,.active)").each(function()
    {
        const date = $(this).data('date');
        const week = fullWeeks[$(this).data('week')];

        outSideTable += "<div class='flex cursor-pointer outside' data-on='click' data-call='clickOutSide' data-params='event' data-date='" + date + "' data-week='" + $(this).data('week') + "'><div class='cell setWorking border p-2 flex-1'>" + setWorking + "</div><div class='cell flex-1 border p-2 label-date'>" + date + "</div><div class='cell w-12 center border p-2 label-week'>" + week + "</div></div>";
    });

    $('#outSideBox').html("<div class='border p-2 outside-header'></div>" + outSideTable);
    checkOutSideHeader();
}

window.checkOutSideHeader = function()
{
    $('.outside-header').text(outSideDays.replace('%s', $('.outside').length));
}

window.checkWorkingDays = function()
{
    $('#workingDays').html(workingDays.replace('%s', $('#panel-schedule').find("table td.main.active:not(.disabled)").length));
}

window.saveCalendar = function(event)
{
    let minWorkHours = 0;
    let maxWorkHours = 0;
    let workDays     = '';
    const formData   = new FormData($(event.target).closest('form').eq(0)[0]);
    for(var d of formData)
    {
        if(d[0] == 'minWorkHours') minWorkHours = d[1];
        if(d[0] == 'maxWorkHours') maxWorkHours = d[1];
        if(d[0] == 'workDays')     workDays     = workDays + d[1] + ',';
    }

    if(!$('#minWorkHours')[0].reportValidity() || !$('#maxWorkHours')[0].reportValidity()) return false;
    if(parseFloat(minWorkHours) > parseFloat(maxWorkHours))
    {
        zui.Messager.show(WorkHoursError, {type: 'danger', time: 2000});
        return false;
    }

    let schedule = {begin, end, minWorkHours, maxWorkHours, workDays, calendar: {}};
    $(event.target).closest('#panel-schedule').find('table td.active.main').each(function()
    {
        schedule.calendar[$(this).data('date')] = $(this).data('date');
    })

    $("input[name='" + sessionStorage.getItem('schedule') + "']").val(JSON.stringify(schedule));
    if(callback) window[callback]($("input[name='" + sessionStorage.getItem('schedule') + "']"));
    zui.Modal.hide();
}
