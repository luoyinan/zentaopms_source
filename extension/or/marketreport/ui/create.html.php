<?php
/**
 * The create view file of marketreport module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      sunguangming <sunguangming@chandao.com>
 * @package     marketreport
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->marketreport->create),
    set::ajax(array('beforeSubmit' => jsRaw('clickSubmit'))),
    formHidden('status', 'draft'),
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
        set::width('1/2')
    ),
    formGroup
    (
        set::label($lang->marketreport->source),
        set::width('1/2'),
        radioList
        (
            set::name('source'),
            set::items($lang->marketreport->sourceList),
            set::value('inside'),
            set::inline(true)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->market),
        set::width('1/2'),
        set::id('marketBox'),
        inputGroup
        (
            div
            (
                setID('marketPickerBox'),
                setClass('w-full'),
                picker
                (
                    set::name('market'),
                    set::id('market'),
                    set::items($marketList),
                    set::value($marketID),
                )
            ),
            div
            (
                setID('marketNameBox'),
                setClass('w-full hidden'),
                input
                (
                    set::name('marketName'),
                    set::id('marketName'),
                    set::placeholder($lang->market->name)
                )
            ),
            common::hasPriv('market', 'create') ? div
            (
                setClass('input-group-addon flex'),
                checkbox
                (
                    set::name('newMarket'),
                    set::id('newMarket'),
                    set::text($lang->market->create),
                    on::change('toggleMarketPickerBox')
                )
            ) : null
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
            set::items($researchList)
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
            set::value($app->user->account)
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
            set::value($app->user->account),
            set::multiple(true)
        )
    ),
    formGroup
    (
        set::label($lang->marketreport->desc),
        editor(set::name('desc'))
    ),
    formGroup
    (
        set::label($lang->marketreport->files),
        fileSelector()
    )
);
