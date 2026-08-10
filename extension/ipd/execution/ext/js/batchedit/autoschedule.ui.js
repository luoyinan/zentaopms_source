window.updateWorkDays = function($obj)
{
    if($obj.length && $obj.val())
    {
        const schedule = JSON.parse($obj.val());
        $obj.closest('tr').find('input[name^=days]').val(Object.keys(schedule.calendar).length);
    }
}
