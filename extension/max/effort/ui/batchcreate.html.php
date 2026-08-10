<?php
/**
 * The batchcreate view file of effort module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     effort
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('leftTip', $lang->effort->leftTip);
jsVar('executions', $executions);
jsVar('executionTask', $executionTask);
jsVar('executionBug', $executionBug);
jsVar('batchCreateLink', createLink('effort', 'batchCreate', 'date={date}'));

$isEn      = $app->getClientLang() == 'en';
$nonRDUser = !empty($_SESSION['user']->feedback) || !empty($_COOKIE['feedbackView']);

$rows  = array();
$index = 1;
foreach($actions as $action)
{
    $rows[] = array(
        'id'         => $index,
        'work'       => $action->work,
        'objectType' => "{$action->objectType}_{$action->objectID}",
        'execution'  => empty($action->execution) ? '' : (string)$action->execution,
        'consumed'   => '',
        'left'       => '',
        'actionID'   => $action->id
    );
    $index++;
}

for($i = 0; $i < 8; $i++, $index++)
{
    $rows[] = array(
        'id'         => $index,
        'work'       => '',
        'objectType' => 'custom',
        'execution'  => '',
        'consumed'   => '',
        'left'       => '',
        'actionID'   => ''
    );
}

$formActions = isonlybody() ? array('submit') : array('submit', array('text' => $lang->goback, 'url' => createLink('my', 'effort', 'type=all')));

formBatchPanel
(
    set::formID('effortBatchAddForm'),
    set::data($rows),
    set::minRows(1),
    set::batchFormOptions(array('fixedActions' => true)),
    set::onRenderRow(jsRaw('window.renderEffortRow')),
    on::change('[data-name="objectType"]', 'window.changeObjectType'),
    set::actions($formActions),
    formHidden('date', $date),
    to::heading
    (
        div
        (
            setClass('effort-batch-heading flex items-center justify-between gap-4 flex-wrap'),
            div(setClass('panel-title text-lg'), $lang->effort->batchCreate),
            div
            (
                setClass('effort-batch-toolbar flex items-center gap-3 flex-wrap'),
                inputGroup
                (
                    span(setClass('input-group-addon'), $lang->effort->date),
                    datePicker
                    (
                        setID('effortBatchDate'),
                        set::name('date'),
                        set::value($date),
                        set::maxDate(helper::today()),
                        on::change('window.updateAction')
                    )
                ),
                btn
                (
                    setClass('primary'),
                    set::title($lang->effort->noticeClean),
                    on::click('window.cleanEffort'),
                    $lang->effort->clean
                ),
            )
        )
    ),
    formBatchItem
    (
        set::name('id'),
        set::label($lang->idAB),
        set::control('index'),
        set::width('50px')
    ),
    formBatchItem
    (
        set::name('id'),
        set::label($lang->idAB),
        set::control('hidden'),
        set::hidden(true)
    ),
    formBatchItem
    (
        set::name('work'),
        set::label($lang->effort->work),
        set::control(array('control' => 'input', 'autocomplete' => 'off')),
        set::width('180px')
    ),
    formBatchItem
    (
        set::name('objectType'),
        set::label($lang->effort->objectType),
        set::control('picker'),
        set::items($typeList),
        set::value('custom'),
        set::width('280px')
    ),
    formBatchItem
    (
        set::name('execution'),
        set::label($lang->effort->execution),
        set::control(array('control' => 'picker', 'items' => $executions, 'maxItemsCount' => 50)),
        set::width('280px'),
        $nonRDUser ? set::hidden(true) : null
    ),
    formBatchItem
    (
        set::name('consumed'),
        set::label($isEn ? $lang->effort->consumed : ($lang->effort->consumed . '(' . $lang->effort->hour . ')')),
        set::control(array('control' => 'input', 'autocomplete' => 'off')),
        set::width('110px'),
        $nonRDUser ? set::hidden(true) : null
    ),
    formBatchItem
    (
        set::name('left'),
        set::label($isEn ? $lang->effort->left : ($lang->effort->left . '(' . $lang->effort->hour . ')')),
        set::control(array('control' => 'input', 'autocomplete' => 'off', 'disabled' => true, 'title' => $lang->effort->leftTip)),
        set::width('110px')
    ),
    formBatchItem
    (
        set::name('actionID'),
        set::label(false),
        set::control('hidden'),
        set::hidden(true)
    )
);
