<?php
namespace zin;

jsVar('window.moduleName', $flow->module);
jsVar('window.setLayout', $lang->workflowaction->setLayout);

include dirname(__DIR__, 2) . '/workflow/ui/header.html.php';

$sortable = false;
if(strpos($orderBy, 'order_asc') !== false)
{
    foreach($actions as $action)
    {
        if($action->extensionType == 'override')
        {
            $sortable = true;
            break;
        }
    }
}

$cols = $config->workflowaction->dtable->fieldList;
if(!$sortable) unset($cols['sort']);

if(!$flow->buildin)
{
    unset($cols['buildin'], $cols['extensionType']);
}

$tableData  = initTableData($actions, $cols, $this->workflowaction);
$firstRowId = '';
foreach($tableData as $row)
{
    $firstRowId = $firstRowId ?: (string)$row->id;
    $row->statusLabel = zget($lang->workflowaction->statusList, $row->status, '');
    if($row->extensionType == 'override') $row->extensionType = '';
}
jsVar('window.selectedRowId', $firstRowId);
jsVar('window.firstRow', reset($tableData));

$dtableProps = array(
    setID('actionList'),
    set::cols(array_values($cols)),
    set::data($tableData),
    set::onCellClick(jsRaw('window.onCellClick')),
    set::onRenderCell(jsRaw('window.renderWorkflowActionCell')),
);


if($sortable)
{
    $dtableProps[] = set::plugins(array('sortable'));
    $dtableProps[] = set::sortable(true);
    $dtableProps[] = set::sortHandler('.sort-handler');
    $dtableProps[] = set::onSortEnd(jsRaw('window.onSortEnd'));
}

div(setClass('space space-sm'));
div(
    setClass('row mt-2'),
    div(
        setClass('w-1/2 bg-white'),
        div(
            setID('previewArea'),
            setClass('panel ring-0'),
            div(setClass('panel-heading font-bold')),
            div(
                setClass('panel-body'),
                div(setClass('layout-buildin-tip text-center text-muted hide'), $lang->workflowaction->tips->buildin),
                div(setClass('layout-empty-tip text-center text-muted hide'), $lang->workflowaction->tips->emptyLayout),
                div(setClass('layout-no-tip text-center text-muted hide'), $lang->workflowaction->tips->noLayout),
                div(setClass('layout-preview hide'))
            )
        )
    ),
    div(
        setClass('w-1/2 bg-white ml-2'),
        div(
            setClass('panel main-table'),
            div(
                setClass('panel-heading'),
                strong($lang->workflowaction->settings),
                div(
                    setClass('panel-actions pull-right'),
                    a(
                        setClass('btn primary'),
                        set::href(inlink('create', "module=$flow->module")),
                        set('data-toggle', 'modal'),
                        set('data-width', '600'),
                        icon('plus'),
                        $lang->workflowaction->create
                    )
                )
            ),
            div(
                setClass('panel-body'),
                dtable($dtableProps)
            )
        )
    )
);

render('page');
