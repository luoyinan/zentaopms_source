if(config.vision == 'rnd')
{
    window.batchComputeWorkDays = function()
    {
        const $tr = $(this).closest('tr');
        const end = $tr.find('input[name^=end]').val();
        if(end == longTime) $tr.find('input[name^=days]').val('');
    }

    window.updateWorkDays = function($obj)
    {
        if($obj.length && $obj.val())
        {
            const schedule = JSON.parse($obj.val());
            $obj.closest('tr').find('input[name^=days]').val(Object.keys(schedule.calendar).length);
        }
    }
}
