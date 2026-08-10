<?php
/**
 * The create file of workflowreport module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowreport
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('currentModule', $module);

$createFields = defineFieldList('workflowreport');
$createFields->field('name')->required(true)->width('full');
$createFields->field('type')->control(array('control' => 'radioList', 'inline' => true))->items($lang->workflowreport->iconList)->value($type)->width('full');
$createFields->field('countType')->control(array('control' => 'radioList', 'inline' => true))->items($lang->workflowreport->countTypeList)->value($countType)->width('1/2');
$createFields->field('displayType')->control(array('control' => 'radioList', 'inline' => true))->items($lang->workflowreport->displayTypeList)->value('value')->width('1/2');
$createFields->field('dimension')->control('picker')->items($dimensionList)->value($dimension)->width($isDate ? '1/2' : 'full');
$createFields->field('granularity')->class($isDate ? '' : 'hidden')->label('')->control('picker')->items($lang->workflowreport->granularityList)->value('')->width('1/2');
$createFields->field('fields')->control('picker')->class($countType == 'count' ? 'hidden' : '')->items($fields)->multiple($type == 'pie' ? false : true)->width('full');

$createFields->autoLoad('type', 'fields');
$createFields->autoLoad('countType', 'fields');
$createFields->autoLoad('dimension', 'dimension,granularity,fields');

formPanel
(
    set::title($title),
    set::layout('grid'),
    set::fields($createFields),
    set::loadUrl(createLink('workflowreport', 'create', "module={$module}&type={type}&dimension={dimension}&countType={countType}"))
);
