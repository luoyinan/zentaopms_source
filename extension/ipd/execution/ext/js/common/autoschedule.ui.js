window.updateWorkingDays = function($obj)
{
    if($obj.length && $obj.val())
    {
        const schedule = JSON.parse($obj.val());
        $('input[name=days]').val(Object.keys(schedule.calendar).length);
    }
}

if(config.vision != 'lite')
{
    window.computeWorkDays = function(currentID)
    {
        const begin = $('input[name=begin]').val();
        const end   = $('input[name=end]').val();

        if(!computeDaysDelta(begin, end)) $('[name=days]').val(computeDaysDelta(begin, end)).trigger('change');
        return false;
    }
}
