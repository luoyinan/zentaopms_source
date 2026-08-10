window.updateWorkingDays = function($obj)
{
    if($obj.length && $obj.val())
    {
        const schedule = JSON.parse($obj.val());
        $('input[name=days]').val(Object.keys(schedule.calendar).length);
    }
}
