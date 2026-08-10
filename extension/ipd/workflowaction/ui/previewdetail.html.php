<?php
namespace zin;

$infos    = [];
$sections = [];

foreach($fields as $field)
{
    if($field->position == 'basic')
    {
        $infos[$field->name] = array('control' => 'html', 'content' => '<div class="example-text-holder" data-size="8"></div>');
    }
    elseif($field->position == 'info')
    {
        $sections[] = setting()
            ->title($field->name)
            ->control('html')
            ->content("<div class='example-text-holder' data-size='8'></div>");
    }
}

/* 初始化侧边栏标签页。Init sidebar tabs. */
$tabs = array();

/* 基本信息。Legend basic items. */
$tabs[] = setting()
    ->group('basic')
    ->title($lang->workflowlayout->positionList['view']['basic'])
    ->control('datalist')
    ->items($infos);

$actions = array();
detail
(
    set::sections($sections),
    set::tabs($tabs),
    set::objectType('workflowaction'),
    set::object($action),
);