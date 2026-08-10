function submitTodoFilter(form)
{
    const dept  = $('[name="dept"]').val();
    let   begin = $('[name="begin"]').val();
    let   end   = $('[name="end"]').val();

    begin = begin.replace(/-/g, '');
    end   = end.replace(/-/g, '');

    const url   = $.createLink('company', 'todo', `dept=${dept}&begin=${begin}&end=${end}`);
    const data  = new FormData(form);

    postAndLoadPage(url, data);
}

const mainContent = document.querySelector('#mainContent');

if(mainContent)
{
    mainContent.addEventListener('submit', function(event)
    {
        const form = event.target;
        if(form.tagName !== 'FORM') return;

        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();

        submitTodoFilter(form);
    }, true);
}
