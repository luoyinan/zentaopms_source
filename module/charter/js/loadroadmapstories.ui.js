window.changeRoadmap = function(target)
{
    const roadmapID = target.value;
    const link      = $.createLink('charter', 'loadRoadmapStories', 'productID=' + productID + '&roadmapIDList=' + roadmapIDList + '&roadmapID=' + roadmapID, '', true);

    window.location.href = link;
}

window.renderRoadmapStoryCell = function(result, info)
{
    if(info.col.name == 'title' && result)
    {
        const story      = info.row.data;
        const gradeLabel = storyGrades[story.type + '-' + story.grade] || '';

        if(gradeLabel) result.unshift({html: "<span class='label gray-pale'>" + gradeLabel + "</span> "});
    }

    return result;
}
