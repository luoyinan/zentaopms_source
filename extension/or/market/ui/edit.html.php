<?php
/**
 * The edit view file of market module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      sunguangning <sunguangning@chandao.com>
 * @package     market
 * @link        https://www.zentao.net
 */
namespace zin;

formPanel
(
    set::title($lang->market->edit),
    formGroup
    (
        set::name('name'),
        set::label($lang->market->name),
        set::required(true),
        set::width('1/2'),
        set::value($market->name)
    ),
    formGroup
    (
        set::name('industry'),
        set::label($lang->market->industry),
        set::width('1/2'),
        set::value($market->industry)
    ),
    formGroup
    (
        set::label($lang->market->scale),
        set::width('1/2'),
        inputGroup
        (
            input(set::name('scale'), set::value($market->scale != 0.00 ? (string)$market->scale : '')),
            inputGroupAddon($lang->market->hundredMillion)
        )
    ),
    formGroup
    (
        set::name('speed'),
        set::label($lang->market->speed),
        set::control('picker'),
        set::items($lang->market->speedList),
        set::width('1/2'),
        set::value($market->speed)
    ),
    formGroup
    (
        set::name('maturity'),
        set::label($lang->market->maturity),
        set::control('picker'),
        set::items($lang->market->maturityList),
        set::width('1/2'),
        set::value($market->maturity)
    ),
    formGroup
    (
        set::name('competition'),
        set::label($lang->market->competition),
        set::control('picker'),
        set::items($lang->market->competitionList),
        set::width('1/2'),
        set::value($market->competition)
    ),
    formGroup
    (
        set::name('ppm'),
        set::label($lang->market->ppm),
        set::labelHint(array('html' => $lang->market->tips)),
        set::control('picker'),
        set::items($lang->market->ppmList),
        set::width('1/2'),
        set::value($market->ppm)
    ),
    formGroup
    (
        set::name('strategy'),
        set::label($lang->market->strategy),
        set::control('picker'),
        set::items($lang->market->strategyList),
        set::width('1/2'),
        set::value($market->strategy)
    ),
    formGroup
    (
        set::label($lang->market->desc),
        editor(set::name('desc'), html($market->desc))
    )
);
