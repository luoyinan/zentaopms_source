<?php
namespace zin;
global $lang, $app;

$fields = defineFieldList('demandpool.edit');

$fields->field('name')
    ->width('full')
    ->control('input')
    ->value(data('demandpool.name'))
    ->required();

$fields->field('owner')
    ->width('full')
    ->control('picker')
    ->multiple(true)
    ->value(data('demandpool.owner'))
    ->required()
    ->items(data('users'));

$fields->field('reviewer')
    ->width('full')
    ->control('picker')
    ->multiple(true)
    ->value(data('demandpool.reviewer'))
    ->required()
    ->items(data('users'));

$fields->field('products')
    ->width('full')
    ->control('picker')
    ->multiple(true)
    ->value(data('demandpool.products'))
    ->items(data('products'));

$fields->field('desc')
    ->width('full')
    ->control('editor')
    ->value(data('demandpool.desc'));

$fields->field('acl')
    ->width('full')
    ->control('radioList')
    ->value(data('demandpool.acl'))
    ->items($lang->demandpool->aclList);
