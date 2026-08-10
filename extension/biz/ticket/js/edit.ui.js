window.changeProduct = function()
{
    const productID = $('input[name=product]').val();
    loadModules(productID);
    loadBuilds(productID);
}

window.loadModules = function(productID)
{
    const moduleLink = $.createLink('tree', 'ajaxGetOptionMenu', 'productID=' + productID + '&viewtype=ticket&branch=all&rootModuleID=0&returnType=items');
    $.getJSON(moduleLink, function(modules)
    {
        const $modulePicker = $('input[name=module]').zui('picker');
        $modulePicker.render({items: modules});
        $modulePicker.$.setValue('');
    })
}

window.loadBuilds = function(productID)
{
    const openedBuild = $('input[name^=openedBuild]').val() ? $('input[name^=openedBuild]').val().toString() : 0;
    const buildLink = $.createLink('build', 'ajaxGetProductBuilds', 'productID=' + productID + '&varName=openedBuilds&build=' + openedBuild);
    $.getJSON(buildLink, function(data)
    {
        const $buildPicker = $('input[name^=openedBuild]').zui('picker');
        $buildPicker.render({items: data});
        $buildPicker.$.setValue(openedBuild);
    })
}
