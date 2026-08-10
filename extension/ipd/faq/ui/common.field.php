<?php
namespace zin;
global $lang, $config;

$fields = defineFieldList('faq');

$fields->field('product')
    ->control(array('control' => 'picker', 'required' => true))
    ->items(data('products'))
    ->value(data('productID'))
    ->width('1/2');

$fields->field('module')
    ->control(array('control' => 'picker', 'required' => true))
    ->items(data('modules'))
    ->value(data('moduleID'))
    ->width('1/2');

$fields->field('question')
    ->control('input')
    ->width('full');

$fields->field('answer')
    ->control('editor')
    ->width('full');
