$(document).off('click', '[data-formaction]').on('click', '[data-formaction]', function()
{
    const $this       = $(this);
    const dtable      = zui.DTable.query($('#docs'));
    const checkedList = dtable.$.getChecks();
    if(!checkedList.length) return;

    const postData = new FormData();
    checkedList.forEach((id) => postData.append('docIdList[]', id));

    if($this.data('page') == 'batch')
    {
        postAndLoadPage($this.data('formaction'), postData);
    }
    else
    {
        $.ajaxSubmit({"url": $this.data('formaction'), "data": postData});
    }
});

window.changeProject = function(e)
{
    const projectID = e.target.value;
    const link      = $.createLink('assetlib', 'import' + objectType, `libID=${libID}&projectID=${projectID}`);

    loadPage(link);
};

window.changeDocLib = function(e)
{
    const docLibID  = e.target.value;
    const projectID = $('[name="fromProject"]').val();
    const link      = $.createLink('assetlib', 'import' + objectType, `libID=${libID}&projectID=${projectID}&docLibID=${docLibID}`);

    loadPage(link);
};
