<?php
/**
 * The autoSchedule view file of task module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Fangzhou Hu<hufangzhou@chandao.com>
 * @package     task
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('weekend',   $config->execution->weekend);
jsVar('execution', $execution);
jsVar('tasks',     $tasks);

$tab = empty($execution->multiple) ? 'project' : 'execution';
formPanel
(
    formGroup
    (
        div
        (
            setClass('form-horz my-2 w-full'),
            $taskError ? div
            (
                setClass('pl-1 pb-2 text-danger'),
                $lang->execution->dateConflictTip
            ) : null,
            formRow
            (
                set::width('full'),
                div
                (
                    setClass('flex w-full'),
                    formGroup
                    (
                        setClass('buffer-box'),
                        set::style(array('max-width' => '120px')),
                        set::labelClass('w-8 mr-2'),
                        set::label($lang->task->minBuffering),
                        set::labelWidth('64px'),
                        set::control(array('control' => 'number', 'min' => 0, 'oninput' => "validity.valid || (value='');")),
                        set::value(!empty($_SESSION['minBuffering']) ? $this->session->minBuffering : 0),
                        set::name('minBuffering'),
                        setData(array('on' => 'change', 'call' => 'changeMinBuffering', 'params' => 'event'))
                    ),
                    div
                    (
                        setClass('align-middle leading-8'),
                        $lang->project->day
                    ),
                    formGroup
                    (
                        setClass('autoSchedule-box ml-6 mt-1'),
                        set::style(array('max-width' => '140px')),
                        set::control(array('control' => 'switcher', 'text' => $lang->task->schedule->autoMode, 'checked' => !empty($_SESSION['autoSchedule']) ? true : false)),
                        set::name('auto')
                    ),
                    btn
                    (
                        setClass('btn secondary ml-2.5'),
                        setData(array('on' => 'click', 'call' => 'clickAutoSchedule', 'params' => 'event')),
                        $lang->task->globalSchedule
                    )
                ),
                hasPriv('execution', 'relation') ? div
                (
                    setClass('w-32 pull-right'),
                    a
                    (
                        setClass('btn ghost'),
                        set::href(createLink('execution', 'relation', "executionID=$executionID") . "#app={$tab}"),
                        icon('list-alt'),
                        set::target('_blank'),
                        $lang->execution->maintainRelation
                    )
                ) : null
            )
        ),
        formBatchPanel
        (
            set::id('scheduleTable'),
            set::data(array_values($tasks)),
            set::mode('edit'),
            set::tagName('div'),
            set::morph(true),
            set::actions(''),
            set::onRenderRow(jsRaw('renderRowData')),
            setData('showTips', (int)$showTips),
            formBatchItem
            (
                set::name('errorTip'),
                set::width('20px')
            ),
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
                set::label($lang->task->name),
                set::width('160px')
            ),
            formBatchItem
            (
                set::name('preEstStarted'),
                set::label($lang->task->preEstStarted),
                set::width('100px')
            ),
            formBatchItem
            (
                set::name('preDeadline'),
                set::label($lang->task->preDeadline),
                set::width('100px')
            ),
            formBatchItem
            (
                set::name('preLeftDays'),
                set::label($lang->task->preLeftDays),
                set::width('120px')
            ),
            formBatchItem
            (
                set::name('estStarted'),
                set::label($lang->task->estStarted),
                set::control(array('control' => 'datePicker', 'data-on' => 'change', 'data-call' => 'changeDateRange', 'data-params' => 'event', 'required' => true)),
                set::width('160px')
            ),
            formBatchItem
            (
                set::name('deadline'),
                set::label($lang->task->deadline),
                set::control(array('control' => 'datePicker', 'data-on' => 'change', 'data-call' => 'changeDateRange', 'data-params' => 'event', 'required' => true)),
                set::width('160px')
            ),
            formBatchItem
            (
                set::name('leftDays'),
                set::label($lang->task->leftDays),
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
                set::name('status'),
                set::hidden(true)
            ),
            formBatchItem
            (
                set::name('parent'),
                set::hidden(true)
            ),
            formBatchItem
            (
                set::name('left'),
                set::hidden(true)
            ),
            formBatchItem
            (
                set::name('mode'),
                set::hidden(true)
            )
        )
    )
);
