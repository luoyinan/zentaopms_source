<?php
namespace zin;

set::zui(true);

jsVar('flowModule', $flow->module);
jsVar('defaultField', $config->workflowfield->default);
jsVar('maxField', $config->workflowfield->max);
jsVar('minField', $config->workflowfield->min);
jsVar('tips', $lang->workflowfield->tips);
jsVar('placeholder', $lang->workflowfield->placeholder);
jsVar('formulaLang', $lang->workflowfield->formula);
jsVar('determine', $lang->determine);
jsVar('expression', array());
jsVar('defaultConfirmDelete', $lang->workflowfield->alert->confirmDelete);
jsVar('confirmDeleteHasQuote', $lang->workflowfield->alert->confirmDeleteHasQuote);
jsVar('confirmDeleteInQuote', $lang->workflowfield->alert->confirmDeleteInQuote);
jsVar('quotedFields', array_values($quotedFields));

include dirname(__DIR__, 2) . '/workflow/ui/header.html.php';

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
        $options = array_filter($options);
        $formGroups[] = formGroup
        (
            set::label($field->name),
            set::control($control['control']),
            set::items($options)
        );
    }
}

$canImport         = commonModel::hasPriv('workflowfield', 'import');
$canExportTemplate = commonModel::hasPriv('workflowfield', 'exportTemplate');

$headingLeft = null;
if($flow->type == 'flow')
{
    $headingLeft = strong($lang->workflowfield->settings);
}
else
{
    $headingLeft = div(
        setClass('toolbar'),
        a(
            setClass('btn btn-back'),
            set::href(createLink('workflow', 'browsedb', "parent={$flow->parent}&table={$flow->module}")),
            $lang->goback
        ),
        div(setClass('divider')),
        div(
            setClass('page-title'),
            span(setClass('text'), $flow->name)
        )
    );
}

$headingActions = null;
if($flow->type != 'table' || $flow->role != 'quote')
{
    $actionNodes = array();
    if($flow->type == 'flow' && hasPriv('workflowfield', 'quote'))
    {
        $actionNodes[] = a(
            setClass('btn secondary'),
            set::href(createLink('workflowfield', 'quote', "module={$flow->module}&groupID={$groupID}")),
            set('data-toggle', 'modal'),
            set('data-width', '600'),
            $lang->workflowfield->quote
        );
    }

    if($canImport || $canExportTemplate)
    {
        $importItems = array();
        if($canImport)
        {
            $importItems[] = array(
                'text'       => $lang->workflowfield->import,
                'url'        => inlink('import', "module={$flow->module}&type={$flow->type}"),
                'data-toggle'=> 'modal'
            );
        }
        if($canExportTemplate)
        {
            $importItems[] = array(
                'text'        => $lang->workflowfield->exportTemplate,
                'url'         => inlink('exportTemplate', "module={$flow->module}&type={$flow->type}"),
                'data-toggle' => 'modal'
            );
        }

        $actionNodes[] = dropdown(
            btn(
                setClass('btn secondary ml-2'),
                set::caret(true),
                $lang->import
            ),
            set::items($importItems),
            set::placement('bottom-end')
        );
    }

    $actionNodes[] = a(
        setClass('btn primary ml-2'),
        set::href(inlink('create', "module=$flow->module")),
        set('data-toggle', 'modal'),
        icon('plus'),
        $lang->workflowfield->create
    );

    $headingActions = div(setClass('panel-actions pull-right'), ...$actionNodes);
}

$cols = $config->workflowfield->dtable->fieldList;
if($flow->type == 'flow')
{
    $cols['groupName'] = array(
        'name'     => 'groupName',
        'title'    => $lang->workflowfield->group,
        'type'     => 'text',
        'sortType' => false
    );
}

if($flow->buildin)
{
    $cols['buildin'] = array(
        'name'     => 'buildin',
        'title'    => $lang->workflowfield->buildin,
        'type'     => 'html',
        'width'    => 60,
        'sortType' => false,
    );
}

$tableData = array();
foreach($fields as $field)
{
    $row = new stdClass();
    $row->id        = $field->id;
    $row->name      = $field->name;
    $row->module    = $flow->module;
    $row->fieldCode = $field->field;
    $row->control   = zget($lang->workflowfield->controlTypeList, $field->control, '');
    $row->isBuiltIn = !empty($field->buildin);
    $row->role      = $field->role;

    if($flow->type == 'flow') $row->groupName = $field->groupName;

    if($flow->buildin)
    {
        $row->buildin = "<span class='text-center buildin{$field->buildin}'>" . ($field->buildin ? "<i class='icon icon-check'></i>" : "<i class='icon icon-times'></i>") . '</span>';
    }

    $tableData[] = $row;
}

$tableData = initTableData($tableData, $cols, $this->workflowfield);

div(setClass('space space-sm'));
div(
    setClass('row mt-2'),
    div(
        setClass('w-1/2 bg-white'),
        div(
            setID('previewArea'),
            setClass('panel'),
            div(setClass('panel-heading'), strong($flow->name)),
            div(
                setClass('panel-body'),
                formPanel(
                    set::actions(array()),
                    $formGroups
                )
            )
        )
    ),
    div(
        setClass('w-1/2 bg-white ml-2'),
        div(
            setClass('panel'),
            div(
                setClass('panel-heading'),
                $headingLeft,
                $headingActions
            ),
            div(
                setClass('panel-body'),
                dtable(
                    setID('fieldList'),
                    set::cols(array_values($cols)),
                    set::data($tableData),
                    set::plugins(array('sortable')),
                    set::sortHandler('.move-field'),
                    set::height('auto'),
                    set::onSortEnd(jsRaw('window.onSortEnd')),
                    set::onRenderCell(jsRaw('window.renderFieldCell')),
                )
            )
        )
    )
);

render('page');
