<?php
/**
 * The browse file of workflowlabel module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowlabel
 * @link        https://www.zentao.net
 */
namespace zin;
include dirname(__DIR__, 2) . '/workflow/ui/header.html.php';

$cols     = array();
$dataList = array();
$data     = new stdclass();
foreach($fields as $field)
{
    if(!$field->show) continue;
    if($field->field == 'actions') continue;
    $cols[$field->field] = array('name' => $field->field, 'title' => $field->name, 'type' => $field->field == 'id' ? 'checkID' : 'html', 'sortType' => false);

    $size = mt_rand(2, 9);
    $data->{$field->field} = "<div class='example-text-holder' data-size='{$size}'></div>";
}

$actionList = array();
foreach($actions as $actionCode => $action)
{
    if(!in_array($action->method, array('operate', 'delete', 'edit'))) continue;
    $actionList[$actionCode]['text'] = $action->name;
}

$cols['actions'] = array('title' => $lang->actions, 'type' => 'actions', 'width' => count($actionList) * 60, 'list' => $actionList, 'menu' => array_keys($actionList));

for($i = 0; $i < 3 ; $i++)
{
    $data->id = $i + 1;
    $dataList[$i] = clone $data;
}

$dataList = initTableData($dataList, $cols, $this->workflowlabel);

$labelActions = array();
$labelActions['edit']    = array('icon' => 'edit',  'hint' => $lang->edit,    'url' => array('module' => 'workflowlabel', 'method' => 'edit',   'params' => 'id={id}'), 'data-toggle' => 'modal');
$labelActions['delete']  = array('icon' => 'trash', 'hint' => $lang->delete,  'url' => array('module' => 'workflowlabel', 'method' => 'delete', 'params' => 'id={id}'), 'className' => 'ajax-submit', 'data-confirm' => $lang->workflowlabel->confirmDelete);

$labelCols = array();
$labelCols['id']      = array('name' => 'id',     'title' => $lang->sort,                  'type' => 'id', 'sortType' => false);
$labelCols['name']    = array('name' => 'label',  'title' => $lang->workflowlabel->label,  'type' => 'text', 'width' => '100');
$labelCols['type']    = array('name' => 'params', 'title' => $lang->workflowlabel->params, 'type' => 'text', 'width' => '400');
$labelCols['actions'] = array('title' => $lang->actions, 'type' => 'actions', 'list' => $labelActions, 'menu' => array('edit','delete'));

foreach($labels as $label)
{
    if($label->type == 'sql')
    {
        $label->params = $label->sql;
        continue;
    }

    $params = '';
    foreach($label->params as $param)
    {
        $params .= $param['field'] . ' ' . zget($lang->workflowlabel->operatorList, $param['operator']) . ' ' . $param['value'] . ' ' . (isset($param['value2']) ? $param['value2'] . ' ' : '') . '&& ';
    }
    $label->params = rtrim($params, '&& ');
}

$labels = initTableData($labels, $labelCols, $this->workflowlabel);

$footToolbar = array();
if(!empty($actions['batchedit']))   $footToolbar['items'][] = array('text' => $actions['batchedit']->name,   'className' => 'primary batch-btn');
if(!empty($actions['batchassign'])) $footToolbar['items'][] = array('text' => $actions['batchassign']->name, 'className' => 'primary batch-btn');

div
(
    setClass('flex mt-2'),
    cell
    (
        setClass('shadow canvas p-4 mr-6 w-3/5'),
        div(setClass('panel-title'), $flow->name),
        div
        (
            set::id('mainMenu'),
            featureBar
            (
                set::current($browseType),
                set::linkParams("module={$module}&browseType={key}")
            ),
            toolbar
            (
                !empty($actions['export']) ? dropdown
                (
                    btn(setClass('btn ghost dropdown-toggle'), set::icon('export'), $actions['export']->name),
                    set::items(array(array('text' => $lang->exportAll), array('text' => $lang->exportThisPage))),
                    set::placement('bottom-end')
                ) : null,
                !empty($actions['import']) ? dropdown
                (
                    btn(setClass('btn ghost dropdown-toggle'), set::icon('import'), $lang->import),
                    set::items(array(array('text' => $actions['import']->name))),
                    set::placement('bottom-end')
                ) : null,
                !empty($actions['create']) && !empty($actions['batchcreate']) ? btngroup
                (
                    btn(setClass('btn primary create-activity-btn'), set::icon('plus'), $actions['create']->name),
                    dropdown
                    (
                        btn(setClass('btn primary dropdown-toggle'), setStyle(array('padding' => '6px', 'border-radius' => '0 2px 2px 0'))),
                        set::items(array(array('text' => $actions['create']), array('text' => $actions['batchcreate']->name))),
                        set::placement('bottom-end')
                    )
                ) : null,
                !empty($actions['create']) && empty($actions['batchcreate'])  ? item(set(array('text' => $actions['create']->name,      'class' => 'btn primary', 'icon' => 'plus'))) : null,
                empty($actions['create'])  && !empty($actions['batchcreate']) ? item(set(array('text' => $actions['batchcreate']->name, 'class' => 'btn primary', 'icon' => 'plus'))) : null
            ),
        ),
        dtable
        (
            set::id('labelBrowse'),
            set::data($dataList),
            set::cols($cols),
            set::checkable(true),
            set::footToolbar($footToolbar),
            set::footPager(usePager())
        )
    ),
    cell
    (
        setClass('shadow canvas p-4 w-2/5'),
        div
        (
            setClass('panel-title mb-4 justify-between'),
            $lang->workflowlabel->settings,
            hasPriv('workflowlabel', 'create') ? a(set::href(createLink('workflowlabel', 'create', "module=$flow->module")), setClass('primary btn pull-right'), icon('plus'), $lang->workflowlabel->create, setData(array('toggle' => 'modal'))) : null
        ),
        dtable
        (
            set::id('label'),
            set::data($labels),
            set::cols($labelCols),
            set::plugins(array('sortable')),
            set::sortHandler('.move-process'),
            set::onSortEnd(jsRaw('window.onSortEnd')),
            set::onRenderCell(jsRaw('window.onRenderCell'))
        )
    )
);
