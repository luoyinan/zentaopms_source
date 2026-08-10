<?php
/**
 * The admin file of workflowrelation module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowrelation
 * @link        https://www.zentao.net
 */
namespace zin;
include dirname(__DIR__, 2) . '/workflow/ui/header.html.php';
include dirname(__DIR__, 2) . '/workflow/ui/side.html.php';

jsVar('fields', $fields);

if($flow->buildin)
{
    unset($lang->workflowrelation->relationActionList['many2one']);
    unset($lang->workflowrelation->relationActionList['many2many']);
}

$items = array();
$items[] = array('label' => $lang->workflowrelation->next,       'name' => 'next',   'control' => array('control' => 'picker', 'shareSelections' => true, 'data-on' => 'change', 'data-call' => 'changeNext', 'data-params' => 'event'), 'items' => $flows);
$items[] = array('label' => $lang->workflowrelation->foreignKey, 'name' => 'fieldBox',  'control' => array('control' => 'inputGroup', 'items' => array(array('control' => 'picker', 'name' => 'field', 'items' => array()), array('control' => 'input', 'name' => 'newField', 'class' => 'hidden'), array('control' => 'checkbox', 'name' => 'createField', 'text' => $lang->workflowrelation->createForeignKey, 'rootClass' => 'input-group-addon', 'data-on' => 'change', 'data-call' => 'changeNewField', 'data-params' => 'event'))));
$items[] = array('label' => $lang->workflowrelation->action,     'name' => 'action', 'control' => array('control' => 'checkList', 'inline' => true, 'data-on' => 'change', 'data-call' => 'changeAction', 'data-params' => 'event'), 'items' => $lang->workflowrelation->relationActionList);
$items[] = array('label' => '', 'name' => 'buildin', 'class' => 'hidden');

div
(
    setClass('flex mt-2'),
    cell
    (
        setClass('shadow mr-6'),
        $sideBar
    ),
    div
    (
        setClass('panel panel-form panel-form-batch size-lg shadow is-lite'),
        setCssVar('--zt-panel-form-max-width', 'auto'),
        div
        (
            setClass('panel-heading'),
            div(setClass('panel-title'), $title)
        ),
        div
        (
            setClass('px-4 py-3 bg-warning bg-opacity-10 text-warning'),
            html($lang->workflowrelation->tips->foreignKey)
        ),
        formBatchPanel
        (
            set::shadow(false),
            setClass('ring-0 bg-transparent rounded-none'),
            set::onRenderRow(jsRaw('renderRowData')),
            set::actions(array('submit')),
            set::data(array_values($relations)),
            set::items($items),
            set::minRows(1)
        )
    )
);
