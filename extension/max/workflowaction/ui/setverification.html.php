<?php
/**
 * The set verification view file of workflowaction module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     workflowaction
 * @link        https://www.zentao.net
 */
namespace zin;

modalheader(set::title($title));

jsVar('workflow', $flow->module);

$conditionDatasources = $datasources;
unset($conditionDatasources['form']);
unset($conditionDatasources['record']);
$index = 1;

$genOptions = function($items)
{
    $options = [];
    foreach($items as $key => $value)
    {
        if(!$key) continue;
        $options[] = array('value' => $key, 'text' => $value);
    }
    return $options;
};

$logicalOperatorItems = $genOptions($lang->workflowverification->logicalOperatorList);
$fieldItems           = $genOptions($fields);
$operatorItems        = $genOptions($config->workflowaction->operatorList);
$paramTypeItems       = $genOptions($conditionDatasources);

$dataItems = [];
$dataForm  = null;
$dataItems['logicalOperator'] = array(
    'name' => 'verifications[logicalOperator]',
    'control' => array('control' => 'picker', 'required' => true),
    'items' => $logicalOperatorItems,
    'width' => '60px',
);

$dataItems['field'] = array(
    'name' => 'verifications[field]',
    'label' => '',
    'control' => array('control' => 'picker', 'required' => false),
    'items' => $fieldItems,
    'width' => '100px',
);

$dataItems['operator'] = array(
    'name' => 'verifications[operator]',
    'label' => '',
    'control' => array('control' => 'picker', 'required' => true),
    'items' => $operatorItems,
    'width' => '80px',
);

$dataItems['paramType'] = array(
    'name' => 'verifications[paramType]',
    'control' => array('control' => 'picker', 'required' => true),
    'items' => $paramTypeItems,
    'width' => '100px',
    'value' => 'custom'
);

$dataItems['param'] = array(
    'name' => 'verifications[param]',
    'control' => array('control' => 'input', 'required' => true),
    'width' => '100px',
);

$dataList = [];
if(!empty($action->verifications->fields))
{
    foreach($action->verifications->fields as $key => $verification)
    {
        $data = new stdclass();
        foreach($verification as $key => $value)
        {
            $key  = "verifications[$key]";
            $data->$key = $value;
        }

        $dataList[] = $data;
    }
}

$maxRows = count($dataList) > 1 ? count($dataList) : 1;
$dataForm = formBatch
(
    set::id('dataForm'),
    set::tagName('div'),
    set::mode('add'),
    set::actionsText(''),
    set::actions([]),
    set::maxRows($maxRows),
    set::onRenderRow(jsRaw('renderDataFormRowData')),
    set::items($dataItems),
    set::data($dataList)
);

$sqlItems = [];
$sqlForm  = null;
$sqlItems['varName'] = array(
    'name' => 'varName',
    'control' => 'input',
    'width' => '100px'
);

$sqlItems['paramType'] = array(
    'name' => 'paramType',
    'control' => array('control' => 'picker', 'required' => true),
    'items' => $paramTypeItems,
    'width' => '100px'
);

$sqlItems['param'] = array(
    'name' => 'param',
    'control' => 'input',
    'width' => '100px'
);

$sqlList = !empty($action->verifications->sqlVars) ? $action->verifications->sqlVars : [];
$maxRows = count($sqlList) > 1 ? count($sqlList) : 1;
$sqlForm = formBatch
(
    set::id('sqlForm'),
    set::tagName('div'),
    set::mode('add'),
    set::actionsText(''),
    set::actions([]),
    set::maxRows($maxRows),
    set::onRenderRow(jsRaw('renderSqlFormRowData')),
    set::items($sqlItems),
    set::data($sqlList)
);

$type = !empty($action->verifications->type) ? $action->verifications->type : 'no';
$dataHidden    = $type == 'data' ? '' : 'hidden';
$sqlHidden     = $type == 'sql' ? '' : 'hidden';
$messageHidden = $type == 'no' ? 'hidden' : '';
formPanel
(
    set::actions(array('submit')),
    on::change('[name="type"]', 'changeType'),
    on::change('[name*=field]', 'changeField'),
    on::change('[name*=paramType]', 'changeParamType'),
    on::change('[name^=varName]', 'changeVarName'),
    formGroup
    (
        set::label($lang->workflowverification->type),
        set::width('1/2'),
        picker
        (
            set::name('type'),
            set::required(true),
            set::items($lang->workflowverification->typeList),
            set::value($type)
        )
    ),
    formGroup
    (
        set::label($lang->workflowverification->field),
        setClass('dataLine ' . $dataHidden),
        $dataForm,
    ),
    formGroup
    (
        set::label($lang->workflowverification->sql),
        setClass('sqlLine ' . $sqlHidden),
        textarea
        (
            set::name('sql'),
            set::value(!empty($action->verifications->sql) ? $action->verifications->sql : ''),
            set::placeholder($lang->workflowverification->placeholder->sql)
        )
    ),
    formGroup
    (
        set::label($lang->workflowverification->varName),
        setClass('sqlLine ' . $sqlHidden),
        $sqlForm,
    ),
    formGroup
    (
        set::label($lang->workflowverification->result),
        setClass('sqlLine ' . $sqlHidden),
        picker
        (
            set::name('sqlResult'),
            set::items($lang->workflowverification->resultList),
            set::required(true),
            set::value(!empty($action->verifications->sqlResult) ? $action->verifications->sqlResult : '')
        )
    ),
    formRow
    (
        setClass('messageLine ' . $messageHidden),
        formGroup
        (
            set::label($lang->workflowverification->message),
            set::required(true),
            input
            (
                set::name('message'),
                set::value(!empty($action->verifications->message) ? $action->verifications->message : ''),
                set::placeholder($lang->workflowverification->placeholder->message)
            )
        )
    ),
);
