<?php
/**
 * The assignto view file of ticket module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     ticket
 * @link        https://www.zentao.net
 */
namespace zin;

modalHeader();

formPanel
(
    formGroup
    (
        set::width('1/2'),
        set::label($lang->ticket->assignedTo),
        set::name('assignedTo'),
        set::items($users),
        set::value($assignedTo)
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
