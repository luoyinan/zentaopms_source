<?php
namespace zin;

formPanel
(
    set::title($lang->import),
    input(set::type('file'), set::name('files'))
);
