<?php
/**
 * The quote file of workflowfield module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflowfield
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('module',  $module);
jsVar('groupID', $groupID);

if(!empty($fieldGroups))
{
    $showFields = array('type', 'default', 'rules');
    if(in_array($field->control, $config->workflowfield->optionControls)) $showFields[] = 'datasource';
    if($field->type == 'file') $showFields = array();
    if($field->type == 'varchar' || $field->type == 'char') $showFields[] = 'length';
    if($field->control == 'formula') $showFields[] = 'expression';
    if($field->type == 'decimal')
    {
        $showFields[] = 'integerDigits';
        $showFields[] = 'decimalDigits';
        list($integerDigits, $decimalDigits) = explode(',', $field->length);
    }

    if(in_array('expression', $showFields))
    {
        $numberFields = $this->workflowfield->getNumberFields($flow->module);
        $formulaLang  = $lang->workflowfield->formula;
        $modules      = array($flow->module => $flow->name);
        $moduleFields = array($flow->module => $numberFields);
        $expression   = json_decode($field->expression, true);
        if($expression)
        {
            $expressionHtml = "<span class='item-name'>{$field->name}</span><span> = </span>";
            foreach($expression as $key => $current)
            {
                $text = $current['text'];
                if($current['type'] == 'target')
                {
                    $text = zget($modules, $current['module']) . '_' . zget(zget($moduleFields, $current['module'], array()), $current['field']);
                    if(!empty($current['function'])) $text = sprintf($formulaLang->functions[$current['function']], zget($modules, $current['module']), zget(zget($moduleFields, $current['module'], array()), $current['field']));
                }
                $expressionHtml .= "<span class='item-expression item-{$current['type']}'>{$text}</span>";
            }
        }
    }

    if(in_array('rules', $showFields))
    {
        $ruleLabels = '';
        foreach(explode(',', $field->rules) as $ruleID) $ruleLabels .= zget($rules, $ruleID, '') . ' ';
    }
}

set::title($title);
if(empty($fieldGroups))
{
    div(setClass('bg-secondary-50 text-secondary p-4'), $lang->workflowfield->tips->noQuoteFields);
}
else
{
    $treeItems = array();
    foreach($fieldGroups as $group)
    {
        $childItem = array('text' => $group->text);
        foreach($group->items as $item)
        {
            $childItem['items'][] = array('text' => $item->text, 'data-field' => $item->field, 'actions' => array(array('icon' => 'eye', 'data-on' => 'click', 'data-call' => 'showField', 'data-params' => 'event', 'data-id' => $item->id)));
        }
        $treeItems[] = $childItem;
    }
    formPanel
    (
        set::actions(array(array('text' => $lang->workflowfield->use, 'class' => 'primary ajax-btn not-open-url', 'data-on' => 'click', 'data-call' => 'useField'))),
        div
        (
            setClass('flex'),
            div
            (
                setClass('flex-1'),
                zui::tree
                (
                    set::defaultNestedShow(true),
                    set::checkOnClick(true),
                    set::checkbox(true),
                    set::items($treeItems)
                )
            ),
            div
            (
                setID('fieldInfo'),
                setClass('flex-1 bg-surface p-4'),
                tableData
                (
                    set::title(sprintf($lang->workflowfield->detail, $field->name)),
                    item(set::name($lang->workflowfield->name),    $field->name),
                    item(set::name($lang->workflowfield->field),   $field->field),
                    item(set::name($lang->workflowfield->control), zget($lang->workflowfield->controlTypeList, $field->control)),
                    in_array('type', $showFields)          ? item(set::name($lang->workflowfield->type),          $field->type)   : null,
                    in_array('length', $showFields)        ? item(set::name($lang->workflowfield->length),        $field->length) : null,
                    in_array('integerDigits', $showFields) ? item(set::name($lang->workflowfield->integerDigits), $integerDigits) : null,
                    in_array('decimalDigits', $showFields) ? item(set::name($lang->workflowfield->decimalDigits), $decimalDigits) : null,
                    in_array('datasource', $showFields)    ? item(set::name($lang->workflowfield->datasource),    is_string($field->options) ? zget($datasources, $field->options) : 'custom') : null,
                    in_array('datasource', $showFields) && is_array($field->options) ? item(set::name($lang->workflowfield->options), json_encode($field->options, JSON_UNESCAPED_UNICODE)) : null,
                    in_array('datasource', $showFields) && $field->options == 'sql'  ? item(set::name($lang->workflowfield->sql), $field->sql) : null,
                    in_array('expression', $showFields) ? item(set::name($lang->workflowfield->expression),    html($expressionHtml)) : null,
                    in_array('default', $showFields)    ? item(set::name($lang->workflowfield->defaultValue),  $field->default)       : null,
                    in_array('rules', $showFields)      ? item(set::name($lang->workflowfield->rules),         $ruleLabels)           : null,
                ),
            )
        )
    );
}
