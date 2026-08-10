window.onSortEnd = function(from, to, type)
{
    if(!from || !to) return false;

    // 交换键值对
    const entries        = Object.entries(this.state.rowOrders);
    const swappedEntries = entries.map(([key, value]) => [value, key]);
    const swappedObj     = Object.fromEntries(swappedEntries);

    const url  = $.createLink('assetlib', 'libSort', 'type=' + objectType);
    const form = new FormData();
    form.append('assetlib', Object.values(swappedObj).join(','));
    $.ajaxSubmit({url, data: form});

    return true;
};

