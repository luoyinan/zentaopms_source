window.changeOwner = function()
{
    const $ownerPicker  = $('#owner').zui('picker');
    let currentOwners = $ownerPicker.$.state.value.split(',');
    if(!currentOwners) currentOwners = [];
    if(!oldOwners)     oldOwners     = [];

    var diff = oldOwners.reduce((result, value) => {
        if (!currentOwners.includes(value)) result.push(value);
        return result;
    }, []);

    if(diff.length)
    {
        var account = diff[0];
        if(oldReviewers && oldReviewers.includes(account))
        {
            oldOwners = $ownerPicker.$.state.value.split(',');
            return false;
        }
        var link = $.createLink('demandpool', 'ajaxCheckReviewer', "poolID=" + poolID + "&account=" + account);
        $.get(link, function(data)
        {
            if(data)
            {
                zui.Modal.alert(hasReview);
                $ownerPicker.$.setValue(oldOwners);
            }
            else
            {
                oldOwners = $ownerPicker.$.state.value.split(',');
            }
        })
    }
    else
    {
        oldOwners = $ownerPicker.$.state.value.split(',');
    }
};

window.changeReviewer = function()
{
    const $reviewerPicker = $('#reviewer').zui('picker');
    var currentReviewers = $reviewerPicker.$.state.value.split(',');
    if(!currentReviewers) currentReviewers = [];

    var diff = oldReviewers.reduce((result, value) => {
        if(!currentReviewers.includes(value)) result.push(value);
        return result;
    }, []);

    if(diff.length)
    {
        var account = diff[0];
        if(oldOwners && oldOwners.includes(account))
        {
            oldReviewers = $reviewerPicker.$.state.value.split(',');
            return false;
        }

        var link = $.createLink('demandpool', 'ajaxCheckReviewer', "poolID=" + poolID + "&account=" + account);
        $.get(link, function(data)
        {
            if(data)
            {
                zui.Modal.alert(hasReview);
                $reviewerPicker.$.setValue(oldReviewers);
            }
            else
            {
                oldReviewers = $reviewerPicker.$.state.value.split(',');
            }
        })
    }
    else
    {
        oldReviewers = $reviewerPicker.$.state.value.split(',');
    }
};
