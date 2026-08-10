<?php
/**
 * The edit view file of marketreport module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @package     marketreport
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('sourceData', $report->source);

formPanel
(
    set::title($lang->marketreport->edit),
    set::formID('dataform'),
    set::ajax(array('beforeSubmit' => jsRaw('clickSubmit'))),
    set::actions
    (
        array
        (
            array('id' => 'saveButton',      'text' => $lang->marketreport->save,      'btnType' => 'submit', 'type' => 'primary', 'data-status' => 'published'),
            array('id' => 'saveDraftButton', 'text' => $lang->marketreport->saveDraft, 'btnType' => 'submit', 'className' => 'secondary', 'data-status' => 'draft'),
            'cancel'
        )
    ),
    formGroup
    (
        set::name('name'),
        set::label($lang->marketreport->name),
        set::required(true),
        set::width('1/2'),
        set::value($report->name)
    ),
    formGroup
    (
        set::label($lang->marketreport->source),
        set::width('1/2'),
        radioList
        (
            set::name('source'),
            set::items($lang->marketreport->sourceList),
            set::value($report->source),
            set::inline(true)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->market),
        set::width('1/2'),
        picker
        (
            set::name('market'),
            set::id('market'),
            set::items($marketList),
            set::value((string)$report->market)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->research),
        setClass('showInside'),
        set::width('1/2'),
        picker
        (
            set::name('research'),
            set::id('research'),
            set::items($researchList),
            set::value((string)$report->research)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->owner),
        setClass('showInside'),
        set::width('1/2'),
        picker
        (
            set::name('owner'),
            set::items($users),
            set::value($report->owner)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->participants),
        setClass('showInside'),
        set::width('1/2'),
        picker
        (
            set::name('participants'),
            set::items($users),
            set::value($report->participants),
            set::multiple(true)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->desc),
        editor(set::name('desc'), html($report->desc))
    ),
    formGroup
    (
        set::label($lang->marketreport->files),
        fileSelector
        (
            set::defaultFiles(array_values($report->files))
        )
    )
);
