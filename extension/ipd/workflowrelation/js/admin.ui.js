window.renderRowData = function($row, index, row)
{
    $row.find('[data-name=fieldBox]').find('.picker-box').on('inited', function(e, info)
    {
        const $field = info[0];
        if(row && row.next) $field.render({items: fields[row.next]});
        if(row && row.buildin) $field.render({disabled: true});
    })

    $row.find('[data-name=next]').find('.picker-box').on('inited', function(e, info)
    {
        const $next = info[0];
        if(row && row.buildin) $next.render({disabled: true});
    })

    if(row && row.buildin) $row.find('.input-group-addon').addClass('hidden');
}

window.changeNext = function(event)
{
    const next = $(event.target).val();
    const $object = $(event.target).closest('tr').find('input[name^=field]').zui('picker');
    $object.render({items: fields[next]});
    $object.$.setValue('');
}

window.changeAction = function(event)
{
    const value   = $(event.target).val();
    const checked = $(event.target).prop('checked');

    if(checked)
    {
        if(value == 'one2one')   $(event.target).closest('td').find('[value=one2many]').prop('checked',  false);
        if(value == 'one2many')  $(event.target).closest('td').find('[value=one2one]').prop('checked',   false);
        if(value == 'many2one')  $(event.target).closest('td').find('[value=many2many]').prop('checked', false);
        if(value == 'many2many') $(event.target).closest('td').find('[value=many2one]').prop('checked',  false);
    }
}

window.changeNewField = function(event)
{
    const $parent = $(event.target).closest('.input-group');
    const checked = $(event.target).prop('checked');

    $parent.find('[name^=field]').zui('picker').$.setValue('');
    $parent.find('[name^=newField]').toggleClass('hidden', !checked).val('');
    $parent.find('[data-name=field]').toggle(!checked);
}
