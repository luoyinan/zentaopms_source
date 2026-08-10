<?php
/**
 * The set notice view file of workflowaction module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     workflowaction
 * @link        https://www.zentao.net
 */
namespace zin;

modalheader(set::title($title));
formPanel
(
    set::actions(array('submit')),
    formGroup
    (
        set::label($lang->workflowaction->toList),
        mailto
        (
            set::name('toList'),
            set::multiple(true),
            set::value($action->toList),
        )
    )
);
