window.changeAccounts = function(event)
{
    const account = $(event.target).val();
    if(account == 'allGrantDevlop' || account == 'allGrantFeedback' || account == 'allNoGrantDevelop' || account == 'allNoGrantFeedback')
    {
        $(event.target).closest('.check-list-inline').find('input[type=checkbox]').prop('checked', $(event.target).prop('checked'));
    }
}
