<?php
/**
 * The finish view file of ticket module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     ticket
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('consumed', $ticket->consumed);
modalHeader();

formPanel
(
    formGroup
    (
        set::width('1/2'),
        set::label($lang->ticket->hasConsumed),
        inputControl
        (
            input
            (
                set::disabled(true),
                set::value($ticket->consumed)
            ),
            to::suffix($lang->workingHour),
            set::suffixWidth(20)
        )
    ),
    formRow
    (
        formGroup
        (
            set::width('1/2'),
            set::label($lang->ticket->currentConsumed),
            inputControl
            (
                input
                (
                    set::name('currentConsumed'),
                    set::value('0'),
                    setData(array('on' => 'change', 'call' => 'updateConsumed'))
                ),
                to::suffix($lang->ticket->hour),
                set::suffixWidth(20)
            ),
        ),
        formGroup
        (
            set::width('1/2'),
            set::label($lang->ticket->consumed),
            inputControl
            (
                input
                (
                    set::disabled(true),
                    set::name('consumed'),
                    set::value($ticket->consumed),
                ),
                to::suffix($lang->ticket->hour),
                set::suffixWidth(20)
            )
        )
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->ticket->resolvedBy),
        set::name('resolvedBy'),
        set::items($users),
        set::value($app->user->account)
    ),
    formGroup
    (
        set::width('1/2'),
        set::label($lang->ticket->resolvedDate),
        set::required(true),
        datetimePicker
        (
            set::name('resolvedDate'),
            set::value(helper::now())
        )
    ),
    formGroup
    (
        set::label($lang->files),
        fileSelector()
    ),
    formGroup
    (
        set::label($lang->ticket->resolution),
        set::required(true),
        set::name('resolution'),
        set::control('editor')
    ),
    formGroup
    (
        set::label($lang->comment),
        set::name('comment'),
        set::control('editor')
    )
);

history();

render();
