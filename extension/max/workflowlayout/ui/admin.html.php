<?php
namespace zin;

modalHeader(set::title($title . ' - ' . $action->name));

$items = array();
foreach($uiPairs as $id => $label)
{
    $active = $id == $ui ? 'active' : '';
    $items[] = li
    (
        setClass('nav-item'),
        a
        (
            setClass($active),
            set::href(inlink('admin', "module={$action->module}&action={$action->action}&mode=edit&ui={$id}")),
            $label,
            set(array('data-load' => 'modal', 'data-size' => 'lg'))
        )
    );
}

$featureBar = featureBar($items);

$toolbar = null;
if(!isset($emptyCustomFields))
{
    $canAddUI = common::hasPriv('workflowlayout', 'addUI');
    if($action->type == 'batch') $canAddUI = false;
    if(!in_array($action->method, array('edit', 'operate', 'view'))) $canAddUI = false;
    if($canAddUI)
    {
        $toolbar = toolbar(
            btn
            (
                set::type('primary'),
                set::btnType('button'),
                set::url(inlink('addUI', "module={$action->module}&action={$action->action}")),
                icon('plus'),
                $lang->workflowlayout->addUI,
                set(array('data-load' => 'modal', 'data-size' => 'md'))
            )
        );
    }
}

div(set::id('mainMenu'), $featureBar, $toolbar);

$module      = $action->module;
$actionParam = $action->action;
$saveURL     = createLink('workflowlayout', 'admin', "module={$module}&action={$actionParam}&mode=edit&ui={$ui}");

jsVar('saveURL', $saveURL);

$actionMethod = $action->method;
if($action->module == 'product' && in_array($action->method, array('requirement', 'epic'))) $actionMethod = 'browse';
if($action->module == 'caselib' && $action->action == 'editCase') $actionMethod = 'edit';

$layoutScene    = in_array($actionMethod, array('browse', 'view')) ? $actionMethod : 'form';
$disabledFields = in_array($actionMethod, $config->workflowaction->defaultActions) ? zget($config->workflowlayout->disabledFields, $actionMethod, '') : $config->workflowlayout->disabledFields['custom'];
$disabledSub    = $config->workflowlayout->disabledFields['subTables'];

$requiredFields = zget($config->workflowlayout->default->required, $action->action, array());
if($flow->approval == 'enabled') $requiredFields = array_merge($requiredFields, zget($config->workflowlayout->approval->required, $action->action, array()));

$summaryPickerItems = array();
foreach($lang->workflowlayout->summaryList as $summaryKey => $summaryLabel)
{
    if(!$summaryKey) continue;
    $summaryPickerItems[] = array('text' => (string) $summaryLabel, 'value' => (string) $summaryKey);
}

$getDefaultOptions = function ($field): array
{
    $items  = array();
    if(!empty($field->options))
    {
        foreach($field->options as $k => $label)
        {
            if(!$k) continue;
            $items[] = array('text' => (string) $label, 'value' => (string) $k);
        }
    }
    return $items;
};

$rows       = array();
$checkedIds = array();

foreach($fields as $key => $field)
{
    if(strpos(",{$disabledFields},", ",{$key},") !== false) continue;
    if($key == 'actions') $field->role = 'default';
    if(strpos($key, 'prev_') === 0) continue;

    $isSubHeader = !empty($subTables[$key]);

    $row = clone $field;
    $row->id                = $key;
    $row->parent            = 0;
    $row->rowKind           = $isSubHeader ? 'subHeader' : 'main';
    $row->ditto             = zget($field, 'ditto', '0');
    $row->readonly          = zget($field, 'readonly', '0');
    $row->position          = zget($field, 'position', '');
    $row->summary           = zget($field, 'summary', '');
    $row->defaultValue      = zget($field, 'defaultValue', '');
    $row->defaultValueItems = $getDefaultOptions($field);
    $row->buildin           = !empty($field->buildin) ? "<i class='icon-check text-success'></i>" : "<i class='icon-close text-danger'></i>";
    $row->skipFormExtras    = $isSubHeader || ($layoutScene == 'form' && is_numeric($key));
    $row->summaryEligible   = $layoutScene == 'browse'
        && !$isSubHeader
        && in_array($field->type, $config->workflowfield->numberTypes)
        && strpos(",{$config->workflowlayout->noTotalFields},", ",{$field->field},") === false;

    $row->summaryItems       = $row->summaryEligible ? $summaryPickerItems : array();
    $row->summaryPickerValue = '';
    if($row->summaryEligible && $field->summary)
    {
        $row->summaryPickerValue = strpos((string) $field->summary, ',') !== false ? explode(',', (string) $field->summary) : $field->summary;
    }

    $row->checkRequired = in_array($key, $requiredFields);
    if((!empty($field->show) && $field->show == '1' && !$isSubHeader) || $row->checkRequired) $checkedIds[] = $key;

    $rows[] = $row;

    if($isSubHeader && $action->method != 'browse' && $action->type == 'single')
    {
        foreach($subTables[$key] as $childKey => $childField)
        {
            if(strpos(",{$disabledSub},", ",{$childKey},") !== false) continue;

            $subRow                     = clone $childField;
            $subId                      = $key . '::' . $childKey;
            $subRow->id                 = $subId;
            $subRow->parent             = $key;
            $subRow->rowKind            = 'subField';
            $subRow->ditto              = zget($childField, 'ditto', '0');
            $subRow->readonly           = zget($childField, 'readonly', '0');
            $subRow->position           = zget($childField, 'position', '');
            $subRow->summary            = zget($childField, 'summary', '');
            $subRow->defaultValue       = zget($childField, 'defaultValue', '');
            $subRow->defaultValueItems  = $getDefaultOptions($childField);
            $subRow->buildin            = !empty($childField->buildin) ? "<i class='icon-check text-success'></i>" : "<i class='icon-close text-danger'></i>";
            $subRow->skipFormExtras     = is_numeric($childKey);
            $subRow->summaryEligible    = false;
            $subRow->summaryItems       = array();
            $subRow->summaryPickerValue = '';

            if(!empty($childField->show) && $childField->show == '1') $checkedIds[] = $subId;

            $rows[] = $subRow;
        }
    }
}

if($action->method != 'browse' && $action->type == 'single' && !empty($prevModules))
{
    foreach($prevModules as $prevModule => $prevFields)
    {
        $headerRow          = new stdClass();
        $headerRow->id      = 'prev_' . $prevModule;
        $headerRow->parent  = 0;
        $headerRow->rowKind = 'subHeader';
        $headerRow->name    = $lang->workflowrelation->prev . $lang->hyphen . zget($flowPairs, $prevModule);
        $rows[] = $headerRow;

        foreach($prevFields as $childKey => $childField)
        {
            if(strpos(",{$disabledSub},", ",{$childKey},") !== false) continue;

            $subRow                     = clone $childField;
            $subId                      = 'prev_' . $prevModule . '::' . $childKey;
            $subRow->id                 = $subId;
            $subRow->parent             = 'prev_' . $prevModule;
            $subRow->rowKind            = 'subField';
            $subRow->prevLayoutShowOnly = true;

            if(!empty($childField->show) && $childField->show == '1') $checkedIds[] = $subId;

            $rows[] = $subRow;
        }
    }
}

$pinnedRows = array();
$normalRows = array();
foreach($rows as $row)
{
    if($row->rowKind == 'main' && !empty($row->checkRequired))
    {
        $pinnedRows[] = $row;
        continue;
    }
    $normalRows[] = $row;
}

if($pinnedRows)
{
    $insertAt = count($normalRows);
    foreach($normalRows as $index => $row)
    {
        if($row->rowKind == 'subHeader')
        {
            $insertAt = $index;
            break;
        }
    }
    array_splice($normalRows, $insertAt, 0, $pinnedRows);
    $rows = $normalRows;
}

$checkedList = implode(',', array_unique($checkedIds));

$dtable    = $this->app->config->workflowlayout->dtable;
$fieldList = $dtable->fieldList;
if($layoutScene === 'browse' || $layoutScene === 'view')
{
    $sceneColKeys = $dtable->sceneCols[$layoutScene];
}
else
{
    $sceneColKeys = array('id', 'name', 'layoutRules', 'defaultValue');
    if($action->layout == 'side')        $sceneColKeys[] = 'position';
    if($action->method == 'batchcreate') $sceneColKeys[] = 'ditto';
    $sceneColKeys[] = 'readonly';
    $sceneColKeys[] = 'buildin';
    if($action->type != 'single' || in_array($actionMethod, $config->workflowaction->readonlyActions))
    {
        $sceneColKeys = array_values(array_filter($sceneColKeys, function ($colKey)
        {
            return $colKey !== 'readonly';
        }));
    }
}

$cols = array();
foreach($sceneColKeys as $colKey)
{
    if(!isset($fieldList[$colKey])) continue;
    $cols[$colKey] = $fieldList[$colKey];
}

if(isset($cols['layoutRules'])) $cols['layoutRules']['controlItems'] = $rules;
if(isset($cols['position']))
{
    if(in_array($action->module, array('productplan', 'build', 'release'))) unset($positionList['info']);
    $cols['position']['controlItems'] = $positionList;
    if($layoutScene == 'browse') $cols['position']['title'] = $lang->workflowlayout->alignment;
}
if(isset($cols['defaultValue'])) $cols['defaultValue']['control'] = jsRaw('window.getDefaultValueControl');

dtable
(
    setID('workflowlayout-admin'),
    set::userMap(array()),
    set::cols($cols),
    set::data($rows),
    set::controlMap(jsRaw('window.readonlyControlMap')),
    set::plugins(array('form', 'sortable')),
    set::sortHandler('.move-field'),
    set::canSortTo(jsRaw('window.canSortTo')),
    set::checkable(true),
    set::canRowCheckable(jsRaw('window.workflowlayoutCanRowCheckable')),
    set::onRenderCell(jsRaw('window.renderFieldCell')),
    set::checkInfo(jsRaw("function(){return '{$lang->workflowlayout->tips->checkInfo}';}")),
    set::afterRender(jsRaw('function () { window.workflowlayoutAfterRender(' . json_encode($checkedList, JSON_UNESCAPED_UNICODE) . '); }'))
);

$footerNodes = array(
    btn(set::type('primary'), set::btnType('button'), set::id('workflowlayoutSaveBtn'), $lang->save)
);

$canSetLinkage = hasPriv('workflowlayout', 'browse') && $this->loadModel('workflowaction')->isClickable($action, 'browseLinkage');
if($action->type == 'batch') $canSetLinkage = false;
if(!in_array($action->method, array('edit', 'operate', 'create'))) $canSetLinkage = false;

$linkageURL = $canSetLinkage ? createLink('workflowlinkage', 'browse', "action={$action->id}&ui={$ui}") : '';
if($canSetLinkage) $footerNodes[] = a(setClass('btn'), set::href($linkageURL), $lang->workflowaction->linkage, set(array('data-load' => 'modal', 'data-size' => 'md')));
if(hasPriv('workflowlayout', 'block') && $action->method == 'view' && $flow->role == 'custom') $footerNodes[] = a(setClass('btn'), set::href(createLink('workflowlayout', 'block', "module=$action->module")), $lang->workflowlayout->block, set(array('data-load' => 'modal', 'data-size' => 'md')));
if($ui && hasPriv('workflowlayout', 'editUI')) $footerNodes[] = a(setClass('btn'), set::href(inlink('editUI', "ui={$ui}")), $lang->workflowlayout->editUI, set(array('data-load' => 'modal', 'data-size' => 'md')));

div(setClass('modal-footer flex justify-center gap-2 items-center'), $footerNodes);
