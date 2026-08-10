<?php
/**
 * The browse file of workflowreport module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowreport
 * @link        https://www.zentao.net
 */
namespace zin;
include dirname(__DIR__, 2) . '/workflow/ui/header.html.php';
include dirname(__DIR__, 2) . '/workflow/ui/side.html.php';

$actions = array();
$actions['preview'] = array('icon' => 'eye',   'hint' => $lang->preview, 'url' => array('module' => 'workflowreport', 'method' => 'browse', 'params' => 'module={module}&id={id}'));
$actions['edit']    = array('icon' => 'edit',  'hint' => $lang->edit,    'url' => array('module' => 'workflowreport', 'method' => 'edit',   'params' => 'id={id}'), 'data-toggle' => 'modal');
$actions['delete']  = array('icon' => 'trash', 'hint' => $lang->delete,  'url' => array('module' => 'workflowreport', 'method' => 'delete', 'params' => 'id={id}'), 'className' => 'ajax-submit', 'data-confirm' => $lang->workflowreport->confirmDelete);

$cols = array();
$cols['id']      = array('name' => 'id',   'title' => $lang->idAB,                 'type' => 'id', 'sortType' => false);
$cols['name']    = array('name' => 'name', 'title' => $lang->workflowreport->name, 'type' => 'category');
$cols['type']    = array('name' => 'type', 'title' => $lang->workflowreport->type, 'type' => 'category', 'map' => $lang->workflowreport->typeList);
$cols['actions'] = array('title' => $lang->actions, 'type' => 'actions', 'list' => $actions, 'menu' => array('preview','edit','delete'));

$reports = initTableData($reports, $cols, $this->workflowreport);

div
(
    setClass('flex mt-2'),
    cell
    (
        setClass('shadow mr-6'),
        $sideBar
    ),
    cell
    (
        setClass('shadow canvas p-4 w-1/2'),
        div(setClass('panel-title'), $lang->workflowreport->preview),
        div
        (
            setClass('center h-full'),
            $report ? echarts
            (
                set::title(array('text' => $report->name, 'left' => 'center')),
                set::width('100%'),
                set::height('300px'),
                $report->type != 'pie' ? set::xAxis(array('type' => 'category', 'data' => array_keys($chartData))) : null,
                $report->type != 'pie' ? set::yAxis(array('type' => 'value', 'axisLabel' => $report->displayType == 'percent' ? array('formatter' => '{value} %') : array('formatter' => '{value}'))) : null,
                set::series
                (
                    array
                    (
                        array
                        (
                            'type'  => $report->type,
                            'data'  => array_values($chartData),
                            'label' => $report->type == 'pie' ? array('show' => true, 'position' => 'inside', 'formatter' => $report->displayType == 'percent' ? '{d}%' : '{d}') : array('show' => false)
                        )
                    )
                )
            ) : span
            (
                $lang->workflowreport->tips->noReport,
                hasPriv('workflowreport', 'create') ? a
                (
                    set::href(createLink('workflowreport', 'create', "module=$flow->module")),
                    setData(array('toggle' => 'modal')),
                    $lang->workflowreport->tips->toCreate
                ) : $lang->workflowreport->tips->toCreate
            )
        )
    ),
    cell
    (
        setClass('shadow canvas ml-6 p-4 flex-auto'),
        div
        (
            setClass('panel-title mb-4 justify-between'),
            $lang->workflowreport->property,
            hasPriv('workflowreport', 'create') ? a(set::href(createLink('workflowreport', 'create', "module=$flow->module")), setClass('primary btn pull-right'), icon('plus'), $lang->workflowreport->create, setData(array('toggle' => 'modal'))) : null
        ),
        dtable
        (
            set::data($reports),
            set::cols($cols)
        )
    )
);
