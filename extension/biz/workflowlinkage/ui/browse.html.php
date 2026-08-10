<?php
/**
 * The browse view file of workflowlinkage module of ZDOO.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Guangming Sun <sunguangming@zentao.net>
 * @package     workflowlinkage
 * @version     $Id$
 * @link        http://www.zdoo.com
 */
namespace zin;

jsVar('action', $action->id);
jsVar('confirmDeleteLinkage', $lang->confirmDelete);
jsVar('deletingTextLinkage', $lang->deleteing);

modalHeader();

$createUrl = createLink('workflowlinkage', 'create', "action={$action->id}&ui={$ui}");
$gobackUrl = createLink('workflowlayout', 'admin', "module={$action->module}&action={$action->action}&mode=edit&ui={$ui}");

$linkages = zget($action->linkages, $ui, array());
$dataList = [];
foreach($linkages as $key => $linkage)
{
    $sources = zget($linkage, 'sources', array());
    $targets = zget($linkage, 'targets', array());
    $data    = new stdClass();

    $data->key    = $key;
    $data->ui     = $ui;
    $data->action = $action->id;
    $data->source = '';
    foreach($sources as $source)
    {
        if(is_array($source)) $source = (object) $source;
        if(!isset($fields[$source->field])) continue;

        $field = $fields[$source->field];
        $data->source .= $field->name . zget($config->workflowlinkage->operatorList, $source->operator);
        if($field->control == 'multi-select' or $field->control == 'checkbox')
        {
            $values = explode(',', (string) $source->value);
            foreach($values as $value) $data->source .= zget($field->options, $value) . ' ';
        }
        else
        {
            $data->source .= zget($field->options, $source->value);
        }
    }

    $data->target = '';
    foreach($targets as $target)
    {
        if(is_array($target)) $target = (object) $target;
        if(!isset($fields[$target->field])) continue;

        $field = $fields[$target->field];
        $data->target .= $field->name . "[{$lang->workflowlinkage->statusList[$target->status]}];";
    }

    $dataList[] = $data;
}

$cols      = $config->workflowlinkage->dtable->fieldList;
$tableData = initTableData($dataList, $cols, $this->workflowlinkage);

dtable
(
    set::data($tableData),
    set::cols($cols)
);

div
(
    setClass('text-center mt-4'),
    a(
        setClass('btn primary'),
        set(array('data-load' => 'modal')),
        set::href($createUrl),
        icon('plus'),
        $lang->workflowlinkage->create
    ),
    a(
        setClass('btn ml-2'),
        set::href($gobackUrl),
        set(array('data-load' => 'modal', 'data-size' => 'lg')),
        $lang->goback
    )
);
