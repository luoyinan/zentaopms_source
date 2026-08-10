window.updateWorkDays = function($obj)
{
    if($obj.length && $obj.val())
    {
        const schedule = JSON.parse($obj.val());
        $obj.closest('tr').find('input[name^=days]').val(Object.keys(schedule.calendar).length);
    }
}

$(document).off('change', '[name^="enabled"]').on('change', '[name^="enabled"]', function()
{
    $(this).closest('tr').find(".btn-calendar").toggleClass('disabled', !$(this).prop('checked'));
})
