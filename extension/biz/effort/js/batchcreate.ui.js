function getEffortExecutionID(objectType)
{
    if(!objectType) return '';
    if(objectType.indexOf('task_') === 0) return executionTask[objectType] || '';
    if(objectType.indexOf('bug_')  === 0) return executionBug[objectType]  || '';

    return '';
}

function getExecutionItems(executionID)
{
    if(!executionID || !executions[executionID]) return {};

    const items = [{text: executions[executionID], value: executionID}];
    return items;
}

function setExecutionPicker($row, items, value)
{
    const $execution = $row.find('input[name^="execution"]');
    if(!$execution.length) return;

    const picker = $execution.zui('picker');

    picker.render({items: items});
    picker.$.setValue(value || '', true);
}

function toggleLeftInput($row, enable)
{
    const $left = $row.find('input[name^="left"]');
    if(!$left.length) return;

    $left.prop('disabled', !enable);
    if(enable) $left.removeAttr('title');
    if(!enable) $left.attr('title', leftTip);
}

function syncEffortRow($row, preserveExecution)
{
    const objectType       = $row.find('input[name^="objectType"]').val() || '';
    const currentExecution = $row.find('input[name^="execution"]').val() || '';
    const executionID      = getEffortExecutionID(objectType);
    const lockExecution    = objectType.indexOf('task_') === 0 || objectType.indexOf('bug_') === 0;
    const isTask           = objectType.indexOf('task_') === 0;

    const items = lockExecution ? getExecutionItems(executionID) : executions;
    const value = lockExecution ? executionID : (preserveExecution ? currentExecution : '');

    setExecutionPicker($row, items, value);
    toggleLeftInput($row, isTask);
}

window.renderEffortRow = function($row)
{
    const actionID = $row.find('input[name^="actionID"]').val();
    $row.toggleClass('effort-row-computed', !!actionID);
    $row.toggleClass('effort-row-new', !actionID);

    setTimeout(function(){syncEffortRow($row, true);}, 0);
};

window.changeObjectType = function(event)
{
    syncEffortRow($(event.target).closest('tr'), false);
};

window.cleanEffort = function()
{
    $('tr.effort-row-computed').each(function()
    {
        $(this).find('button[data-type="delete"]').trigger('click');
    });
};

window.updateAction = function(e)
{
    const value = e.target.value;

    const date = value.replace(/\-/g, '');
    if(!date) return;

    loadModal(batchCreateLink.replace('{date}', date));
};