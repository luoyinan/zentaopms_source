$(function()
{
    $('.blockList').sortable({trigger: '.sort-block-handler', selector: '> li.block', dragCssClass: ''});
    $('.blockList .tabList').sortable({trigger: '.sort-tab-handler', selector: 'li.tab', dragCssClass: ''});
});

window.addBlock = function(e)
{
    const copyRow = $(e.target).closest('li.block').clone();
    const rows    = $('.blockList > li.block').length;
    const newKey  = rows + 1;

    copyRow.find('ul.tabList').remove();
    copyRow.find('input').val('');
    copyRow.find('input[name^="key"]').val('').attr('name', `key[${newKey}]`);
    copyRow.find('input[name^="showName"]').val('').attr('name', `showName[${newKey}]`);
    copyRow.find('input[name^="blockName"]').val('').attr('name', `blockName[${newKey}]`);
    copyRow.find('input[name^="showName"]').prop('checked', true);

    $(e.target).closest('.block').after(copyRow);
};

window.addTab = function(e)
{
    const parentKey = $(e.target).closest('li.block').find('input[name^="key"]').attr('name').replace(/[^\d]/g, '');
    const rows      = $('.blockList li.tab').length;
    const newTabKey = rows + 1;
    const html      =
    `<ul class="tabList">
      <li class="tab">
        <div class='form-row wf-block-tab-row items-center'>
          <div class="form-group w-1/12 sort-box mr-4"><label class="form-label" title=""><span class="text"></span></label><i class="icon icon-move text-muted sort-block-handler"></i></div>
          <div class="form-group w-1/4 no-label">
           <div class="col-sm-6"><input type="text" name="tabName[${newTabKey}]" class="form-control" placeholder="${langTabName}"></div>
          </div>
          <div class="form-group w-1/6 no-label">
            <div class="col-sm-6">
              <input type="hidden" name="parent[${newTabKey}]" class="parent" value="${parentKey}">
              <a href="javascript:;" class="btn ghost removeTab text-sm">${langDelete}</a>
            </div>
          </div>
          <div class="form-group w-1/4 no-label"> </div>
          <div class="form-group w-1/6 no-label"> </div>
        </div>
      </li>
    </ul>`;

    $(e.target).closest('li.block').append(html);
};

window.removeBlock = function(e)
{
    if($('.blockList > li.block').length > 1)
    {
        $(e.target).closest('li.block').remove();
    }
}

window.removeTab = function(e)
{
    $(e.target).closest('li.tab').remove();
};