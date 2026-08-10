window.getDefaultValueControl = function(cell)
{
    const row = cell.row.data || {};

    if(['select', 'checkbox', 'radio', 'multi-select'].includes(row.control))
    {
        return {
            type: 'picker',
            props: {
                items: row.defaultValueItems || [],
                multiple: ['multi-select', 'checkbox'].includes(row.control),
            },
        };
    }

    return {
        type: 'input',
        props: {type: 'text'},
    };
}

window.readonlyControlMap = {
    readonlyCheckbox: {
        component: 'input',
        props(cell)
        {
            const table = this;
            const name  = `${cell.col.name}[${cell.row.id}]`;
            let raw     = typeof table.getFormData === 'function' ? table.getFormData(name) : table.data?.formData?.[name];
            if(raw === undefined || raw === null) raw = cell.row.data?.readonly;
            const checked = (raw == '1');
            const disabled = cell.row.data?.control === 'file';
            return {
                type: 'checkbox',
                name,
                value: '1',
                className: 'form-control ring-0 h-auto',
                checked,
                disabled,
                onChange(e)
                {
                    table.setFormData(name, e.currentTarget.checked ? '1' : '0');
                },
            };
        },
    },
};

window.workflowlayoutCanRowCheckable = function(rowID)
{
    const row = this.getRowInfo(rowID)?.data;
    if(row?.checkRequired) return 'disabled';
    return true;
};

window.workflowlayoutGetRequiredRowIds = function(dtable)
{
    return (dtable.options.data || []).filter(row => row.checkRequired).map(row => String(row.id)).filter(Boolean);
};

window.workflowlayoutEnsureRequiredChecks = function(dtable)
{
    const requiredIds = window.workflowlayoutGetRequiredRowIds(dtable);
    if(!requiredIds.length || !dtable.$) return;

    const checkedRows = {...dtable.$.state.checkedRows};
    let changed = false;
    requiredIds.forEach((id) =>
    {
        if(!checkedRows[id])
        {
            checkedRows[id] = true;
            changed = true;
        }
    });
    if(changed) dtable.$.setState({checkedRows});
};

/* 默认勾选已经选中的行。 */
window.workflowlayoutAfterRender = function(idList)
{
    const $table = $('#workflowlayout-admin_table');
    if($table.data('workflowlayoutChecksApplied')) return;

    const dtable = zui.DTable.query($table);
    if(!dtable || !dtable.$ || typeof dtable.$.toggleCheckRows !== 'function') return;

    const ids = String(idList || '').split(',').map(s => s.trim()).filter(Boolean);
    if(!ids.length) return;

    $table.data('workflowlayoutChecksApplied', 1);

    const allIds = (dtable.options.data || []).map(r => r.id).filter(Boolean);
    if(allIds.length) dtable.$.toggleCheckRows(allIds, false);
    dtable.$.toggleCheckRows(ids, true);
    window.workflowlayoutEnsureRequiredChecks(dtable);
};

window.bindCellControlKey = function(result, info)
{
    const cell = result?.[0];
    const key  = `${info.row.id}:${info.col.name}`;
    if(!cell || !cell.children) return;

    cell.key = key;
    if(!cell.children.props) cell.children.props = {};
    cell.children.key       = key;
    cell.children.props.key = key;
};

window.renderFieldCell = function(result, info)
{
    const colName   = info.col.name;
    const row       = info.row.data;
    const keyedCols = new Set(['layoutRules', 'defaultValue', 'readonly', 'summary', 'position', 'ditto']);

    if(colName == 'id')
    {
        result[0] = '';
        return result;
    }

    if(colName == 'name')
    {
        if(row.rowKind == 'subHeader') return result;
        if(row.prevLayoutShowOnly) return result;
        if(row.checkRequired)
        {
            result[0] = {html: row.name};
            return result;
        }
        const html = `${row.name} <i class='icon-move text-gray cursor-move move-field'></i>`;
        result[0] = {html: html};
        return result;
    }

    if(row.prevLayoutShowOnly) return []; // 前置流程只能控制显隐

    if(row.rowKind == 'subHeader')
    {
        if(['layoutRules', 'defaultValue', 'readonly', 'buildin', 'summary', 'position'].includes(colName)) return [{html: ''}];
        return result;
    }

    if((colName === 'layoutRules' || colName === 'defaultValue') && row.skipFormExtras)
    {
        result[0] = {html: ''};
        return result;
    }

    if(colName == 'ditto' && !['input', 'select', 'multi-select', 'date', 'datetime'].includes(row.control))
    {
        result[0].children.props.disabled = true;
    }

    if(colName === 'readonly' && row.skipFormExtras)
    {
        result[0] = {html: ''};
        return result;
    }

    /* 操作列、子表不展示位置设置。*/
    if(colName === 'position' && (row.field == 'actions' || row.rowKind == 'subField'))
    {
        result[0] = {html: ''};
        return result;
    }

    if(colName === 'summary')
    {
        if(!row.summaryEligible)
        {
            result[0] = {html: ''};
            return result;
        }
        const ch = result[0].children;
        if(ch && ch.props)
        {
            ch.props.items = row.summaryItems || [];
            ch.props.multiple = true;
            if(row.summaryPickerValue !== undefined && row.summaryPickerValue !== '') ch.props.defaultValue = row.summaryPickerValue;
        }
        window.bindCellControlKey(result, info);
        return result;
    }

    if(colName == 'defaultValue')
    {
        result[0].children.props.items = row.defaultValueItems || [];
        const multiControls = ['multi-select', 'checkbox'];
        if(multiControls.includes(row.control)) result[0].children.props.multiple = true;
        window.bindCellControlKey(result, info);
        return result;
    }

    if(keyedCols.has(colName)) window.bindCellControlKey(result, info);

    return result;
};

/**
 * getChecks() 的顺序来自 checkedRows 的键序，与界面行序无关。
 * 开启sortable插件后，重排后的顺序在 layout.rows 中，按照拖放后的顺序重排checkedList。
 */
window.sortChecksByRowOrder = function(dtable, checks)
{
    const rows = dtable.$.layout?.rows;
    if(rows && rows.length)
    {
        const selected = new Set(checks);
        const sorted   = [];
        rows.forEach((row) =>
        {
            const id = row.id;
            if(id && selected.has(String(id))) sorted.push(String(id));
        });
        if(sorted.length < checks.length)
        {
            const have = new Set(sorted);
            checks.forEach((id) => { if(!have.has(String(id))) sorted.push(String(id)); });
        }
        return sorted;
    }

    return checks;
};

$(document).off('click', '#workflowlayoutSaveBtn').on('click', '#workflowlayoutSaveBtn', function()
{
    const dtable      = zui.DTable.query($('#workflowlayout-admin_table'));
    const checkedList = window.sortChecksByRowOrder(dtable, dtable.$.getChecks());
    const formData    = dtable.$.getFormData();

    checkedList.forEach((id) => {
        if(id.includes('::'))
        {
            const sep   = id.indexOf('::');
            const mod   = id.slice(0, sep);
            const field = id.slice(sep + 2);
            if(mod.startsWith('sub_'))
            {
                formData[`show[${mod}]`] = 1;
                formData[`subTables[${mod}][show][${field}]`]         = 1;
                formData[`subTables[${mod}][readonly][${field}]`]     = formData[`readonly[${id}]`];
                formData[`subTables[${mod}][defaultValue][${field}]`] = formData[`defaultValue[${id}]`];
                formData[`subTables[${mod}][layoutRules][${field}]`]  = formData[`layoutRules[${id}]`];
                formData[`subTables[${mod}][summary][${field}]`]      = formData[`summary[${id}]`];
                formData[`subTables[${mod}][position][${field}]`]     = formData[`position[${id}]`];
            }
            else if(mod.startsWith('prev_'))
            {
                const module = mod.slice(5);
                console.log(module);
                formData[`prevModules[${module}][show][${field}]`] = 1;
            }
        }
        else
        {
            formData[`show[${id}]`] = 1;
        }
    });

    $.ajaxSubmit({
        url: saveURL,
        data: formData,
        onFail(result)
        {
            const msg = result.message || result.alert;
            if(msg) zui.Modal.alert(typeof msg === 'object' ? Object.values(msg).join('\n') : msg);
        }
    });
});

window.canSortTo = function(from, to, sortingSide)
{
    if(from.data.parent != to.data.parent) return false;
    if(from.data.checkRequired) return false;
    if(to.data.checkRequired && sortingSide === 'after') return false;
    return true;
}
