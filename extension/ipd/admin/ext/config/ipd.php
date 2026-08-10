<?php
$key = array_search('custom|mode', $config->admin->menuGroup['system']);
unset($config->admin->menuGroup['system'][$key]);

$config->admin->menuGroup['feature'][] = 'custom|storygrade';
$config->admin->menuGroup['feature'][] = 'custom|epicgrade';
$config->admin->menuGroup['feature'][] = 'custom|requirementgrade';

$config->admin->menuModuleGroup['feature']['custom|set'][] = 'stage';

$config->admin->navsGroup['feature']['execution'] .= ',stage,';
