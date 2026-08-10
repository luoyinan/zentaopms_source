<?php
namespace zin;
global $lang;

$story          = data('story');
$canEditContent = str_contains(',draft,changing,', ",{$story->status},");
$docField       = array();
$docField[] = section
(
    set::title($lang->story->docs),
    doclist(set::data($story), set::mode($canEditContent ? 'edit' : 'view'))
);
query('#files')->before($docField);
