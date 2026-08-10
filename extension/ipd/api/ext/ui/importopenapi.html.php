<?php
namespace zin;

formPanel
(
    set::title($lang->api->importOpenAPI),
    set::labelWidth('110px'),
    set::submitBtnText($lang->import),

    formGroup
    (
        set::label($lang->api->currentLib),
        set::control('static'),
        set::value($libName)
    ),
    formGroup
    (
        set::label($lang->api->targetModule),
        picker
        (
            set::name('module'),
            set::items($moduleOptions),
            set::value($moduleID)
        )
    ),
    formGroup
    (
        set::label($lang->api->importFile),
        set::required(true),
        fileSelector
        (
            setID('files'),
            set::name('files'),
            set::accept('.json,.yaml'),
            set::maxFileCount(1),
            set::multiple(false),
            set::required(true)
        ),
        span(setClass('text-gray'), $lang->api->importFileTip)
    ),

    formHidden('mode', 'existingLib'),
    formHidden('libID', (string)$libID),
);
