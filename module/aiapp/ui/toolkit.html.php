<?php
namespace zin;

$menuItems = array();
foreach($lang->aiapp->toolkitItems as $key => $item) $menuItems[] = array('text' => $item['title'], 'url' => createLink('aiapp', 'toolkit', "tab=$key"), 'selected' => $key == $tab, 'icon' => isset($item['icon']) ? $item['icon'] : $key);

sidebar
(
    set::toggleBtn(false),
    set::width(160),
    div
    (
        setClass('cell canvas rounded p-2.5'),
        menu
        (
            setClass('--menu-bg', 'transparent'),
            set::items($menuItems)
        )
    )
);

div
(
    setClass('cell canvas rounded'),
    setClass('p-5 max-h-full overflow-y-auto scrollbar-hover'),
    style::height('calc(100vh - 72px)'),
    style::backgroundImage('linear-gradient(to bottom left, transparent 0%, #fff 40%), repeating-radial-gradient(circle at 0 0, transparent 0, #fff 27px), repeating-linear-gradient(#D9EAFF55, #D9EAFF)'),
    div
    (
        setClass('relative m-auto'),
        setCssVar('--article-p-space', '0.5rem'),
        style::maxWidth(900),
        img
        (
            setClass('absolute right-0 top-0'),
            style::marginTop('-8px'),
            set::src($config->webRoot . $current['image']),
            set::width(214)
        ),
        h3(setClass('text-aurora mb-2'), style::animationDuration('10s'), $current['title']),
        p(setClass('text-gray mb-5'), $current['subtitle']),
        hr(),
        markdown
        (
            set::assetBaseUrl($config->webRoot),
            $current['intro']
        )
    )
);
