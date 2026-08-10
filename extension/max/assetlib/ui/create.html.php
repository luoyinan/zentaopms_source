<?php
/**
 * The create file of assetlib module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang<wangyidong@chandao.net>
 * @package     assetlib
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($title),
    formGroup
    (
        set::label($lang->assetlib->name),
        set::required(true),
        set::name('name')
    ),
    formGroup
    (
        set::label($lang->assetlib->desc),
        editor(set::name('desc'))
    )
);
