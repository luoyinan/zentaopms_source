<?php
namespace zin;

jsVar('untitledText', $lang->api->untitled);

formPanel
(
    setID('exportOpenAPIPanel'),
    set::title($lang->api->exportOpenAPI),
    set::ajax(array('beforeSubmit' => jsRaw("clickSubmit"))),
    set::submitBtnText($lang->export),
    formGroup
    (
        set::label($lang->api->exportFileName),
        input(setID('fileName'), set::name('fileName'), set::value($fileName))
    ),
    formGroup
    (
        set::label($lang->api->exportScopeLabel),
        picker
        (
            set::name('range'),
            set::items($scopeOptions),
            set::required(true),
            set::value($defaultRange)
        )
    ),
    formGroup
    (
        set::label($lang->api->exportVersionLabel),
        radioList(set::name('openAPIVersion'), set::items($versionOptions), set::value('3.2'), set::inline(true))
    ),
    formGroup
    (
        set::label($lang->api->exportFormatLabel),
        radioList(set::name('fileType'), set::items($formatOptions), set::value('json'), set::inline(true))
    ),
    formHidden('libID', (string)$libID),
    formHidden('version', (string)$version),
    formHidden('release', (string)$release),
    formHidden('moduleID', (string)$moduleID),
    formHidden('apiID', (string)$apiID)
);
