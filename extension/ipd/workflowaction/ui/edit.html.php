<?php
/**
 * The edit view file of workflowaction module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun<sunguangming@chandao.com>
 * @package     workflowaction
 * @link        https://www.zentao.net
 */
namespace zin;

modalHeader();
$openList = $lang->workflowaction->openList;
if($action->action == 'view')  unset($openList['none']);
if($action->type   == 'batch') unset($openList['modal']);

$positionList = $lang->workflowaction->positionList;
if($flow->buildin) unset($positionList['menu']);

$hasStatusRow = !$action->buildin && !in_array($action->action, $config->workflowaction->noDisableActions);
$hidden       = $action->status == 'enable' ? '' : 'hidden';

$groups   = array();
$groups[] = formGroup(
    set::width('1/2'),
    set::label($lang->workflowaction->name),
    set::required(true),
    input(
        set::name('name'),
        set::value($action->name)
    )
);

if($action->buildin)
{
    $groups[] = formGroup(
        set::width('1/2'),
        set::label($lang->workflowaction->extensionType),
        picker(
            set::required(true),
            set::name('extensionType'),
            set::items($lang->workflowaction->extensionTypeList),
            set::value($action->extensionType)
        )
    );

    $groups[] = formHidden('status', $action->status);
}
else
{
    if($hasStatusRow)
    {
        $groups[] = formGroup(
            set::width('1/2'),
            set::label($lang->workflowaction->status),
            radioList(
                set::inline(true),
                set::name('status'),
                set::items($lang->workflowaction->statusList),
                set::value((string)$action->status)
            )
        );
    }
    if(!$action->virtual)
    {
        if(!in_array($action->action, $config->workflowaction->defaultActions))
        {
            $groups[] = formGroup(
                set::hidden($action->type != 'batch'),
                setClass('batch-mode-row', $action->type == 'batch' ? 'action-toggle-row' : ''),
                set::label($lang->workflowaction->batchMode),
                set::width('1/2'),
                picker(
                    setID('batchMode'),
                    set::required(true),
                    set::name('batchMode'),
                    set::items($lang->workflowaction->batchModeList),
                    set::value($action->batchMode)
                )
            );
            $groups[] = formGroup(
                $hasStatusRow ? setClass('action-toggle-row ' . $hidden) : null,
                set::label($lang->workflowaction->open),
                set::width('1/2'),
                picker(
                    set::name('open'),
                    set::items($openList),
                    set::value($action->open)
                )
            );
            $groups[] = formRow(
                set::hidden($action->type == 'batch'),
                $hasStatusRow ? setClass($action->type != 'batch' ? 'action-toggle-row' : '', $hidden) : null,
                formGroup(
                    set::label($lang->workflowaction->position),
                    set::width('1/2'),
                    picker(
                        set::name('position'),
                        set::items($positionList),
                        set::value($action->action == 'browse' ? '' : $action->position)
                    )
                ),
                formGroup(
                    set::width('1/2'),
                    btn
                    (
                        set::icon('help'),
                        toggle::tooltip(array('title' => $lang->workflowaction->tips->position, 'type' => 'white', 'className' => 'text-gray border border-light', 'placement' => 'right')),
                        set::square(true),
                        setClass('ghost h-6 mt-0.5 tooltip-btn')
                    )
                )
            );
        }
        if(!in_array($action->action, $config->workflowaction->noShowActions))
        {
            $groups[] = formRow(
                set::hidden($action->type == 'batch'),
                formGroup(
                    $hasStatusRow ? setClass('action-toggle-row ' . $hidden) : null,
                    set::label($lang->workflowaction->show),
                    set::width('1/2'),
                    picker(
                        set::required(true),
                        set::name('show'),
                        set::items($lang->workflowaction->showList),
                        set::value($action->show)
                    )
                ),
                formGroup(
                    $hasStatusRow ? setClass('action-toggle-row ' . $hidden) : null,
                    btn
                    (
                        set::icon('help'),
                        toggle::tooltip(array('title' => $lang->workflowaction->tips->show, 'type' => 'white', 'className' => 'text-gray border border-light', 'placement' => 'right')),
                        set::square(true),
                        setClass('ghost h-6 mt-0.5 tooltip-btn')
                    )
                )
            );
        }
    }
}

$groups[] = formGroup(
    $hasStatusRow ? setClass('action-toggle-row ' . $hidden) : null,
    set::label($lang->workflowaction->desc),
    textarea(
        set::name('desc'),
        set::value($action->desc),
        set::rows(3)
    )
);

formPanel(
    set::formID('ajaxForm'),
    set::url(inlink('edit', "id=$action->id")),
    set::submitBtnText($lang->save),
    set::actions(array('submit')),
    on::change('[name=status]', 'changeStatus'),
    input(set::type('hidden'), set::name('module'), set::value($action->module)),
    $groups
);

render();
