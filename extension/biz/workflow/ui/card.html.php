<?php
namespace zin;

$cards  = array();
$colors = array('primary', 'warning', 'success', 'important', 'secondary', 'danger', 'special');
foreach($flows as $flow)
{
    $btnGroup       = array();
    $actionItems    = array();
    $canEdit        = $this->workflow->isClickable(null, 'edit');
    $canCopy        = $this->workflow->isClickable($flow, 'copy');
    $canDelete      = $this->workflow->isClickable($flow, 'delete');
    $canRelease     = $this->workflow->isClickable($flow, 'release');
    $canDeactivate  = $this->workflow->isClickable($flow, 'deactivate');
    $canActivate    = $this->workflow->isClickable($flow, 'activate');
    $canBrowseField = commonModel::hasPriv('workflowfield', 'browse');
    $canPreview     = !$flow->buildin && $flow->status == 'normal' && commonModel::hasPriv($flow->module, 'browse');
    $labelClass     = 'gray';

    if($flow->status == 'normal') $labelClass = 'success';
    if($flow->status == 'wait')   $labelClass = 'warning';

    if(!empty($flow->app) && in_array($flow->app, array('scrum', 'waterfall'))) $flow->app = 'project';

    $color = current($colors);
    next($colors);
    if($color == 'special') reset($colors);

    $direction = strpos($flow->position, 'after') === 0 ? 'after' : 'before';
    $position  = strpos($flow->position, '|') !== false ? substr($flow->position, strpos($flow->position, '|') + 1) : substr($flow->position, strlen($direction));
    $cards[] = div
    (
        setClass('col flex-none w-1/4'),
        div
        (
            setClass('border pl-2 pr-4 py-4 ml-4 mt-4'),
            div
            (
                setClass('flex justify-between items-center'),
                div
                (
                    setClass('name ml-2 flex-1 flex items-center mr-2 overflow-hidden'),
                    label(setClass("{$color}-pale mr-2 size-lg"), icon(setClass('text-xl'), $flow->icon)),
                    commonModel::hasPriv('workflow', 'view') ? a(setClass('nowrap'), set::href(createLink('workflow', 'view', "id={$flow->id}")), setData(array('toggle' => 'modal')), h::strong($flow->name), set::title($flow->name)) : span(setClass('text-xl'), h::strong($flow->name), set::title($flow->name)),
                    $flow->buildin ? span(setClass('ml-2 text-warning'), "[{$lang->workflow->buildin}]") : null
                ),
                div
                (
                    label(setClass("capitalize $labelClass"), zget($lang->workflow->statusList, $flow->status))
                )
            ),
            div
            (
                set::className('h-16 ml-2 mt-4 overflow-hidden'),
                div
                (
                    setClass('nowrap'),
                    span(setClass('text-gray-400'), $lang->workflow->app . ':'),
                    span(setClass('text-gray-400 ml-1'), zget($apps, $flow->app, $flow->name)),
                    $flow->position ? span(setClass('typeBox text-gray-400 mx-2'), '|') : null,
                    $flow->position ? span(setClass('text-gray-400'), $lang->workflow->position . ':') : null,
                    $flow->position && $flow->navigator == 'secondary' ? span(setClass('text-gray-400 ml-1'), zget($apps, $flow->app, $flow->name)) : null,
                    $flow->position && $flow->navigator == 'secondary' ? span(setClass('text-gray-400 ml-2 mr-1'), '>') : null,
                    $flow->position ? span(setClass('text-gray-400 ml-1'), $flow->navigator == 'secondary' ? zget($appMenus, $position) : zget($menus, $position), zget($lang->workflow->positionList, $direction)) : null
                ),
                div
                (
                    setClass('mt-2'),
                    span(setClass('text-gray'), $lang->workflow->desc . ':'),
                    span(setClass('text-gray ml-1'), set::title($flow->desc), $flow->desc ? html(nl2br($flow->desc)) : $lang->noData)
                )
            ),
            div
            (
                setClass('flex items-center mt-2'),
                $canBrowseField ? a(setClass('text-primary ml-2'), set::href(createLink('workflowfield', 'browse', "module=$flow->module")), set::title($lang->workflow->design), icon(setClass('text-xl'), 'design')) : null,
                $canPreview     ? a(setClass('text-primary ml-2'), set::href(createLink($flow->module, 'browse', "mode=browse")), set::title($lang->workflow->preview), icon(setClass('text-xl'), 'eye')) : null,
                $canEdit        ? a(setClass('text-primary ml-2'), set::href(inlink('edit', "id=$flow->id")), setData(array('toggle' => 'modal', 'size' => 'sm')), set::title($lang->edit), icon(setClass('text-xl'), 'edit')) : null,
                $canRelease     ? a(setClass('text-primary ml-2'), set::href(inlink('release', "id=$flow->id")), setData(array('toggle' => 'modal', 'size' => 'sm')), set::title($lang->workflow->release), icon(setClass('text-xl'), 'send')) : null,
                $canCopy        ? a(setClass('text-primary ml-2'), set::href(inlink('copy', "id=$flow->id")), setData(array('toggle' => 'modal', 'size' => 'sm')), set::title($lang->workflow->copyFlow), icon(setClass('text-xl'), 'copy')) : null,
                $canDeactivate  ? a(setClass('text-primary ml-2'), set::href(inlink('deactivate', "id=$flow->id")), setData($flow->belong ? array('confirm' => $lang->workflow->tips->syncDeactivate) : array()), set::title($lang->workflow->deactivate), icon(setClass('text-xl'), 'off')) : null,
                $canActivate    ? a(setClass('text-primary ml-2'), set::href($flow->belong ? 'javascript:activate(' . $flow->id . ')' : $this->createLink('workflow', 'activate', "id={$flow->id}&type=all")), set::title($lang->workflow->activate), icon(setClass('text-xl'), 'play')) : null,
                $canDelete      ? a(setClass('text-primary ml-2'), set::href(inlink('delete', "id=$flow->id")), setData(array('confirm' => array('message' => array('html' => $lang->workflow->tips->deleteConfirm), 'icon' => 'icon-exclamation-sign', 'iconClass' => 'warning-pale rounded-full icon-2x'))), setClass('ajax-submit'), set::title($lang->delete), icon(setClass('text-xl'), 'trash')) : null
            )
        )
    );
}

panel
(
    setID('cards'),
    setClass('row cell canvas mb-4'),
    set::bodyClass('w-full'),
    div
    (
        setClass('flex flex-wrap mb-2'),
        $cards
    ),
    div(set::className('table-footer'), setKey('pager'), pager(set(usePager()), set::className('pull-right')))
);
