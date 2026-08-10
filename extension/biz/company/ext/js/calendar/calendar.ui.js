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
        $('[name="account"]').zui('picker').render({items: data});
        $('[name="account"]').zui('picker').$.setValue('');
    });
};

window.loadProductProject = function(e)
{
    const productID = e.target.value;
    const link      = $.createLink('product', 'ajaxGetProjects', `productID=${productID}`);

    $.getJSON(link, function(data)
    {
        $('[name="project"]').zui('picker').render({items: data});
    });
};

window.loadProductExecutions = function(e)
{
    const productID = e.target.value;
    const link      = $.createLink('product', 'ajaxGetProjects', `productID=${productID}`);

    $.getJSON(link, function(data)
    {
        $('[name="execution"]').zui('picker').render({items: data});
    });
};

window.loadProductExecutions = function(e)
{
    const productID   = e.target.value;
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