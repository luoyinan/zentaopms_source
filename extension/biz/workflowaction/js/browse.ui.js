window.renderWorkflowActionCell = function(result, info, props)
{
    const col = info.col.name;

    const pushSelectedRowHighlight = function(res)
    {
        const selected = window.selectedRowId;
        if(selected !== undefined && selected !== '' && String(info.row.id) === String(selected))
        {
            res.push({outer: true, className: 'is-checked'});
        }
        return res;
    };

    if(col == 'sort')
    {
        result[0] = {html: "<i class='icon icon-move text-muted'></i>", className: 'text-center sort-handler'};
        return pushSelectedRowHighlight(result);
    }
    if(col == 'name')
    {
        let html = '';
        if(info.row.data.status !== 'enable' && info.row.data.statusLabel) html += `<span class='label gray-pale'>${info.row.data.statusLabel}</span> `;
        html += info.row.data.name;
        result[0] = {html: html, className: 'select-action'};
        return pushSelectedRowHighlight(result);
    }
    if(col == 'buildin')
    {
        const v = info.row.data.buildin;
        const iconHtml = v ? "<i class='icon icon-check'></i>" : "<i class='icon icon-times'></i>";
        result[0] = {html: iconHtml, className: 'text-center buildin' + v};
        return pushSelectedRowHighlight(result);
    }

    return pushSelectedRowHighlight(result);
};

window.onSortEnd = function(from, to, type)
{
    if(!from || !to) return false;

    $.post($.createLink('workflowaction', 'sort'), {fieldIdList: JSON.stringify(this.state.rowOrders)}, function(response)
    {
        if(response.result === 'success') return loadCurrentPage();
        if(response.message) zui.Modal.alert(response.message);
    }, 'json');
    return true;
};

window.refreshWorkflowActionRowHighlight = function()
{
    const dtable = zui.DTable.query($('#actionList_table'));
    if(dtable && dtable.$) dtable.$.update();
};

window.onCellClick = function(event, data)
{
    const payload = data && data.rowInfo !== undefined ? data : (event && event.rowInfo !== undefined ? event : null);
    const rowInfo = payload && payload.rowInfo;
    if(!rowInfo) return;

    window.selectedRowId = rowInfo.id;
    window.refreshWorkflowActionRowHighlight();

    const rowData = rowInfo.data;
    loadPreview(rowData);
}

function loadPreview(rowData)
{
    $('#previewArea .panel-heading').text(rowData.name);
    if(rowData.buildin == '1')
    {
        $('.layout-buildin-tip').show();
        $('.layout-no-tip').hide();
        $('.layout-preview').hide();
        $('.layout-empty-tip').hide();
        return;
    }

    if(rowData.open == 'none')
    {
        $('.layout-buildin-tip').hide();
        $('.layout-no-tip').show();
        $('.layout-preview').hide();
        $('.layout-empty-tip').hide();
        return;
    }

    let previewLink;
    if(rowData.virtual)
    {
        const nextModule = rowData.action.substring(0, rowData.action.lastIndexOf('_'));
        const nextAction = rowData.action.substring(rowData.action.lastIndexOf('_') + 1);
        previewLink = $.createLink('workflowaction', 'ajaxPreview', 'module=' + nextModule + '&action=' + nextAction);
    }
    else
    {
        previewLink = $.createLink('workflowaction', 'ajaxPreview', 'module=' + window.moduleName + '&action=' + rowData.action);
    }

    loadTarget(previewLink, '#previewArea .layout-preview', {
        success: function(data)
        {
            if(!data)
            {
                $('#previewArea .layout-preview').empty();
                $('.layout-empty-tip').show();
            }
        }
    });

    $('.layout-buildin-tip').hide();
    $('.layout-empty-tip').hide();
    $('.layout-no-tip').hide();
    $('.layout-preview').show();
}

$(function(){
    loadPreview(window.firstRow);
});
