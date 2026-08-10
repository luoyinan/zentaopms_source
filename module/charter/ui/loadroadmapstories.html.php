<?php
/**
 * The load roadmap stories view file of charter module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @package     charter
 * @author      Gunagming Sun <sungunagming@chandao.com>
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('productID', $productID);
jsVar('roadmapIDList', $roadmapIDList);
jsVar('storyGrades', $storyGrades);

$cols = $config->charter->roadmapStory->fieldList;
if(common::hasPriv('story', 'storyView'))
{
    $cols['title']['link'] = array('url' => helper::createLink('{type}', 'view', 'storyID={id}'), 'target' => '_blank');
}
else
{
    unset($cols['title']['link']);
}

$cols['module']['map']       = $modules;
$cols['status']['statusMap'] = $lang->story->statusList;
modalHeader
(
    set::title($lang->charter->roadmapStory),
);

div
(
    setClass('mt-2 mb-2 flex items-center'),
    picker
    (
        setID('roadmap'),
        set::name('roadmap'),
        set::items($roadmaps),
        set::value($roadmapID),
        set::width('200px'),
        set::placeholder($lang->charter->roadmap),
        on::change("changeRoadmap(event.target)")
    )
);

dtable
(
    setID('storyList'),
    set::cols($cols),
    set::data(array_values($stories)),
    set::checkable(false),
    set::sortType(false),
    set::emptyTip($lang->charter->noData),
    set::onRenderCell(jsRaw('window.renderRoadmapStoryCell'))
);

render();
