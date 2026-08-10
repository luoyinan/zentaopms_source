window.addRow = function(e)
{
    $(e.target).closest('.form-row').after($('#rowTemplate').html().replace(/%rowIndex%/g, rowIndex));
    $(e.target).closest('.form-row').next('.form-row').find('.add-item').on('click', addRow);
    $(e.target).closest('.form-row').next('.form-row').find('.del-item').on('click', removeRow);
    rowIndex++;
}

window.removeRow = function()
{
    $(this).closest('.form-row').remove();
}