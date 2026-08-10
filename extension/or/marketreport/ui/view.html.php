<?php
/**
 * The view file of marketreport module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      sunguangming <sunguangming@chandao.com>
 * @package     marketreport
 * @link        https://www.zentao.net
 */
namespace zin;

$isInModal    = isAjaxRequest('modal');
$marketLink   = empty($report->market) ? '' : createLink('market', 'view', "marketID={$report->market}");
$researchLink = empty($report->research) ? '' : createLink('marketresearch', 'task', "researchID={$report->research}");
$statusText   = zget($lang->marketreport->statusList, $report->status, '');

$headerSuffix = array();
if(!$isInModal && hasPriv('marketreport', 'create'))
{
    $headerSuffix[] = btn
    (
        set::icon('plus'),
        set::type('primary'),
        set::url(createLink('marketreport', 'create', "marketID={$report->market}")),
        $lang->marketreport->create
    );
}

$actions = array();
if(!$report->deleted && $report->status != 'published' && hasPriv('marketreport', 'publish'))
{
    $actions[] = array('icon' => 'publish', 'text' => $lang->marketreport->publish, 'hint' => $lang->marketreport->publish, 'url' => createLink('marketreport', 'publish', "reportID={$report->id}&confirm=yes"), 'className' => 'ajax-submit', 'data-confirm' => $lang->marketreport->confirmPublish);
}
if(!$report->deleted && hasPriv('marketreport', 'edit'))
{
    $actions[] = array('icon' => 'edit', 'text' => $lang->edit, 'hint' => $lang->edit, 'url' => createLink('marketreport', 'edit', "reportID={$report->id}&fromMarket={$fromMarket}"));
}
if(!$report->deleted && hasPriv('marketreport', 'delete'))
{
    $actions[] = array('icon' => 'trash', 'text' => $lang->delete, 'hint' => $lang->delete, 'url' => createLink('marketreport', 'delete', "reportID={$report->id}&confirm=yes"), 'className' => 'ajax-submit', 'data-confirm' => $lang->marketreport->confirmDelete);
}

detailHeader
(
    !$isInModal ? to::prefix(backBtn(set::icon('back'), set::className('secondary'), set::url($browseLink), $lang->goback)) : null,
    to::title
    (
        div
        (
            setClass('flex items-center gap-2 flex-wrap'),
            entityLabel(set::entityID($report->id), set::text($report->name), set::level(1)),
            $report->deleted ? label(setClass('danger'), $lang->marketreport->deleted) : (!empty($statusText) ? label(setClass($report->status == 'published' ? 'success' : 'info'), $statusText) : null)
        )
    ),
    !empty($headerSuffix) ? to::suffix($headerSuffix) : null
);

detailBody
(
    sectionList
    (
        section
        (
            set::title($lang->marketreport->legendBasic),
            tableData
            (
                item(set::name($lang->marketreport->market),     empty($marketLink)   ? zget($marketList, $report->market, '')       : a(set::href($marketLink),   zget($marketList, $report->market, ''))),
                item(set::name($lang->marketreport->source),     zget($lang->marketreport->sourceList, $report->source, '')),
                $report->source == 'inside' ? item(set::name($lang->marketreport->research),     empty($researchLink) ? zget($researchList, $report->research, '') : a(set::href($researchLink), zget($researchList, $report->research, ''))) : null,
                $report->source == 'inside' ? item(set::name($lang->marketreport->owner),        zget($users, $report->owner)) : null,
                $report->source == 'inside' ? item(set::name($lang->marketreport->participants), $report->participants) : null,
                item(set::name($lang->marketreport->desc),       html($report->desc))
            )
        ),
        !empty($report->files) ? section
        (
            set::title($lang->marketreport->files),
            fileList(set::files($report->files), set::fieldset(false), set::object($report), set::showDelete(true))
        ) : null
    ),
    history
    (
        set::objectID($report->id),
        set::objectType('marketreport')
    ),
    !$isInModal ? floatToolbar
    (
        set::suffix($actions)
    ) : null
);
