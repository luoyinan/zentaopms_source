<?php
/**
 * The autoSchedule view file of execution module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Fangzhou Hu<hufangzhou@chandao.com>
 * @package     execution
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('projectID', $projectID);
jsVar('weekend', $config->execution->weekend);

formPanel
(
    formGroup
    (
        div
        (
            setClass('my-2'),
            formRow
            (
                set::width($this->app->clientLang == 'zh-cn' || $this->app->clientLang == 'zh-tw' ? '260px' : '300px'),
                formGroup
                (
                    setClass('buffer-box'),
                    set::width('200px'),
                    set::labelClass('w-10 mr-2'),
                    set::label($lang->execution->minBuffering),
                    set::control(array('control' => 'number', 'min' => 0, 'oninput' => "validity.valid || (value='');")),
                    set::value(0),
                    set::name('minBuffering')
                ),
                div
                (
                    setClass('align-middle leading-8'),
                    $lang->project->day
                ),
                btn
                (
                    setClass('btn secondary ml-2.5'),
                    setData(array('on' => 'click', 'call' => 'clickAutoSchedule', 'params' => 'event')),
                    $lang->project->autoSchedule
                )
            )
        ),
        formBatchPanel
        (
            set::id('scheduleTable'),
            set::data(array_values($executions)),
            set::mode('edit'),
            set::tagName('div'),
            set::actions(''),
            set::morph(true),
            set::onRenderRow(jsRaw('renderRowData')),
            formBatchItem
            (
                set::name('id'),
                set::label($lang->idAB),
                set::control('hidden'),
                set::hidden(true)
            ),
            formBatchItem
            (
                set::name('id'),
                set::label($lang->idAB),
                set::control('index'),
                set::width('50px')
            ),
            formBatchItem
            (
                set::name('name'),
                set::label($lang->execution->execName),
                set::width('160px')
            ),
            formBatchItem
            (
                set::name('preBegin'),
                set::label($lang->project->preBegin),
                set::width('100px')
            ),
            formBatchItem
            (
                set::name('preEnd'),
                set::label($lang->project->preEnd),
                set::width('100px')
            ),
            formBatchItem
            (
                set::name('preLeftDays'),
                set::label($lang->project->preLeftDays),
                set::width('120px')
            ),
            formBatchItem
            (
                set::name('begin'),
                set::label($lang->execution->begin),
                set::control('date'),
                set::required(true),
                set::width('160px')
            ),
            formBatchItem
            (
                set::name('endBox'),
                set::label($lang->execution->end),
                set::control('inputGroup'),
                set::width('180px'),
                set::required(true),
                inputGroup
                (
                    datePicker
                    (
                        setClass('end-date-picker'),
                        set::name('end')
                    ),
                    schedule
                    (
                        set::type('batchForm'),
                        set::callback('computeLeftDays'),
                        set::projectID($projectID),
                        set::begin('input[name^="begin"]'),
                        set::end('input[name^="end"]')
                    )
                )
            ),
            formBatchItem
            (
                set::name('leftDays'),
                set::label($lang->project->leftDays),
                set::width('100px'),
                set::readonly(true)
            ),
            formBatchItem
            (
                set::name('days'),
                set::hidden(true)
            ),
            formBatchItem
            (
                set::name('parent'),
                set::control('hidden'),
                set::hidden(true)
            ),
            formBatchItem
            (
                set::name('grade'),
                set::control('hidden'),
                set::hidden(true)
            )
        )
    )
);
