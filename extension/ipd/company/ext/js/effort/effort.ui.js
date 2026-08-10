window.renderCell = function(result, info)
{
    const data = info.row.data;
    if(info.col.name !== 'objectTitle') return result;
    if(!data.objectTitle) return [{html: ''}];

    const canView = !!companyEffortCanViewList[data.objectType];
    if(!canView) return [{html: data.objectTitle}];

    const method  = companyEffortVision !== 'lite' && data.objectType === 'feedback' ? 'adminView' : 'view';
    const params  = method === 'adminView' ? 'feedbackID=' + data.objectID : 'id=' + data.objectID;
    const dataApp = companyEffortTypeAppList[data.objectType] ? ` data-app="${companyEffortTypeAppList[data.objectType]}"` : '';

    result[0] = {html: `<a href="${$.createLink(data.objectType, method, params)}"${dataApp} data-toggle='modal' data-size='lg'>${data.objectTitle}</a>`};
    return result;
}

function submitCalendarFilter(form)
{
    const action = form.getAttribute('action') || window.location.href;
    const data   = new FormData(form);

    postAndLoadPage(action, data);
}

window.loadDeptUsers = function(e)
{
    const deptID = e.target.value;
    const link   = $.createLink('dept', 'ajaxGetUsers', `dept=${deptID}`);

    $.getJSON(link, function(data)
    {
        $('[name="user"]').zui('picker').render({items: data});
        $('[name="user"]').zui('picker').$.setValue('');
    });
};

window.loadProductProject = function(e)
{
    const productID = $('[name="product"]').val();
    const link      = $.createLink('product', 'ajaxGetProjects', `productID=${productID}`);

    $.getJSON(link, function(data)
    {
        $('[name="project"]').zui('picker').render({items: data});
    });
};

window.loadProductExecutions = function(e)
{
    const productID = $('[name="product"]').val();
    const link      = $.createLink('product', 'ajaxGetProjects', `productID=${productID}`);

    $.getJSON(link, function(data)
    {
        $('[name="execution"]').zui('picker').render({items: data});
    });
};

window.loadProductExecutions = function(e)
{
    const productID   = $('[name="product"]').val();
    const projectID   = $('[name="project"]').val();
    const executionID = $('[name="execution"]').val();

    const link = $.createLink('product', 'ajaxGetExecutions', `productID=${productID}&project=${projectID}&branch=0&pageType=&executionID=${executionID}&from=&mode=multiple,leaf`);

    $.getJSON(link, function(data)
    {
        $('[name="execution"]').zui('picker').render({items: data});
    });
};

const mainContent = document.querySelector('#mainContent');
mainContent.addEventListener('submit', function(event)
{
    const form = event.target;

    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();

    submitCalendarFilter(form);
}, true);