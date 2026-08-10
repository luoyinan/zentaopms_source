<?php
namespace zin;
global $lang, $app;

$fields = defineFieldList('demandpool.create');

$fields->field('name')
    ->width('full')
    ->control('input')
    ->required();

$fields->field('owner')
    ->width('full')
    ->control('picker')
    ->multiple(true)
    ->items(data('users'));

$fields->field('reviewer')
    ->width('full')
    ->control('picker')
    ->multiple(true)
    ->value($app->user->account)
    ->items(data('users'));

$fields->field('products')
    ->width('full')
    ->control('picker')
    ->multiple(true)
    ->items(data('products'));

$fields->field('desc')
    ->width('full')
    ->control('editor');

$fields->field('acl')
    ->width('full')
    ->control('radioList')
    ->value('open')
    ->items($lang->demandpool->aclList);
