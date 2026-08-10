<?php
namespace zin;

include __DIR__ . '/header.html.php';

jsVar('defaultConfirmDelete', $lang->confirmDelete);
jsVar('confirmDeleteHasQuote', $lang->workflow->tips->confirmDeleteHasQuote);
jsVar('confirmDeleteInQuote', $lang->workflow->tips->confirmDeleteInQuote);
jsVar('browseDBCurrentModule', $currentTable ? $currentTable->module : '');
jsVar('browseDBNotEditTip', $lang->workflow->tips->notEditTable);
jsVar('browseDBRemoveTitle', $lang->workflow->title->remove);

$flowModel  = $this->loadModel('flow');
$formGroups = [];
foreach($fields as $field)
{
    if($field->field == 'id' || $field->field == 'parent')
    {
        $formGroups[] = formGroup
        (
            set::label($field->name),
            input
            (
                set::name($field->field),
                set::value($lang->workflowfield->placeholder->auto),
                set::disabled(true)
            )
        );
    }
    else
    {
        $control = $this->flow->buildFormControl($field);
        $options = $this->workflowfield->getFieldOptions($field, true);
        $formGroups[] = formGroup
        (
            set::label($field->name),
            set::control($control['control']),
            set::items($options)
        );
    }
}

$headingActions = null;
if(in_array($flow->belong, array('product', 'project', 'exectuion')) && hasPriv('workflow', 'quoteDB')) $headingActions[] = a(
    setClass('btn secondary mr-2'),
    set::href(createLink('workflow', 'quoteDB', "module={$flow->module}&groupID={$this->session->workflowGroupID}")),
    set(array('data-toggle' => 'modal')),
    $lang->workflow->quoteDB
);
if(hasPriv('workflow', 'create')) $headingActions[] = a(
    setClass('btn primary'),
    set::href(createLink('workflow', 'create', "type=table&parent={$flow->module}")),
    set(array('data-toggle' => 'modal')),
    icon('plus'),
    $lang->workflowtable->create
);

$cols       = $config->workflow->dtable->browseDB;
$tablesData = initTableData($tables, $cols, $this->workflow);

div(setClass('space space-sm'));

div(
    setClass('warning-pale'),
    html("<p><i class='icon-alert icon-md'></i> {$lang->workflow->tips->subTable}</p>")
);

div(
    setClass('row'),
    div(
        setClass('w-1/2'),
        formPanel(
            set::title($currentTable ? $currentTable->name : $lang->workflow->subTable . ' ' . $lang->workflow->field),
            set::titleClass('panel-title'),
            set::actions(array()),
            $formGroups
        )
    ),
    div(
        setClass('w-1/2 ml-2'),
        panel(
            set::title($lang->workflow->subTableSettings),
            to::headingActions($headingActions),
            set::bodyClass('main-table no-padding'),
            dtable
            (
                set::id('workflowBrowseDBSubTables'),
                set::cols($cols),
                set::data($tablesData)
            )
        )
    )
);
