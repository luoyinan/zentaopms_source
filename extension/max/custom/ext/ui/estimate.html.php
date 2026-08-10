<?php
/**
 * The hours view file of custom module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian<tianshujie@easycorp.ltd>
 * @package     custom
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('workingHours', $lang->custom->conceptOptions->hourPoint[0]);
jsVar('storyPoint', $lang->custom->conceptOptions->hourPoint[1]);
jsVar('functionPoint', $lang->custom->conceptOptions->hourPoint[2]);
jsVar('efficiency', $lang->custom->unitList['efficiency']);
jsVar('convertRelationTitle', $lang->custom->convertRelationTitle);
jsVar('convertRelationTips', $lang->custom->convertRelationTips);
jsVar('notempty', sprintf($this->lang->error->notempty, $this->lang->custom->convertFactor));
jsVar('isNumber', sprintf($this->lang->error->float, $this->lang->custom->convertFactor));
jsVar('saveTips', $lang->custom->saveTips);
jsVar('unit', $unit);

$lang->custom->object   = array();
$lang->custom->system   = array();
$lang->custom->system[] = 'estimate';

$efficiencySuffix = $lang->custom->conceptOptions->hourPoint[0];
if($unit != 0) $efficiencySuffix = $lang->custom->unitList['efficiency'] . $lang->custom->conceptOptions->hourPoint[$unit];

formPanel
(
    set::actions(array('submit')),
    formGroup
    (
        set::label($lang->custom->estimateUnit),
        set::width('full'),
        radioList
        (
            set::name('hourPoint'),
            set::items($lang->custom->conceptOptions->estimateUnit),
            set::value($unit),
            on::click()->call('changeUnit', jsRaw('event')),
            set::inline(true)
        )
    ),
    formGroup
    (
        setClass('efficiencyBox', $unit == 0 ? 'hidden' : ''),
        set::label($lang->custom->estimateEfficiency),
        set::width('1/3'),
        inputControl
        (
            input(set::name('efficiency'), set::value($efficiency)),
            to::suffix($efficiencySuffix)
        )
    ),
    formGroup
    (
        set::label($lang->custom->estimateCost),
        set::width('1/3'),
        inputControl
        (
            input(set::name('cost'), set::value($cost)),
            to::suffix($lang->custom->unitList['cost'])
        )
    ),
    formGroup
    (
        set::label($lang->custom->estimateHours),
        set::width('1/3'),
        inputControl
        (
            input(set::name('defaultWorkhours'), set::value($hours)),
            to::suffix($lang->custom->unitList['hours'])
        )
    ),
    formGroup
    (
        set::label($lang->custom->estimateDays),
        set::width('1/3'),
        inputControl
        (
            input(set::name('days'), set::value($days)),
            to::suffix($lang->custom->unitList['days'])
        )
    ),
    formHidden('scaleFactor', '')
);
modal
(
    set::id('convertRelations'),
    set::title($lang->custom->convertRelationTitle),
    set::size('sm'),
    form
    (
        set::actions(false),
        formGroup
        (
            set::label($lang->custom->oneUnit),
            set::width('full'),
            inputControl
            (
                set::prefix('='),
                set::prefixWidth('25'),
                input
                (
                    set::name('convertFactor'),
                    set::required(true),
                    set::value($scaleFactor)
                ),
                to::suffix('')
            )
        ),
        h::div(setID('tips'), setClass('alert secondary'), $lang->custom->convertRelationTips)
    ),
    to::footer
    (
        setClass('justify-center form-actions'),
        btn
        (
            $lang->confirm,
            setClass('primary wide'),
            on::click()->call('setScaleFactor')
        ),
        btn($lang->cancel, setData('dismiss', 'modal'))
    )
);
