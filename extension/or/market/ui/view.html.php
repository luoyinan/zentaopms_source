<?php
/**
 * The view file of market module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      sunguangning <sunguangning@chandao.com>
 * @package     market
 * @link        https://www.zentao.net
 */
namespace zin;

$desc = !empty($market->desc) ? $market->desc : "<div class='text-center text-muted'>{$lang->noData}</div>";

$actions = array();
if(!$market->deleted && hasPriv('marketreport', 'browse'))
{
    $actions[] = array('icon' => 'list-alt', 'text' => $lang->market->report, 'hint' => $lang->market->report, 'url' => createLink('marketreport', 'browse', "marketID={$market->id}"));
}
if(!$market->deleted && hasPriv('market', 'edit'))
{
    $actions[] = array('icon' => 'edit', 'text' => $lang->edit, 'hint' => $lang->edit, 'url' => createLink('market', 'edit', "marketID={$market->id}"));
}
if(!$market->deleted && hasPriv('market', 'delete'))
{
    $actions[] = array('icon' => 'trash', 'text' => $lang->delete, 'hint' => $lang->delete, 'url' => createLink('market', 'delete', "marketID={$market->id}"), 'className' => 'ajax-submit', 'data-confirm' => $lang->market->confirmDelete);
}

$reportSections  = array();
$canViewReport   = hasPriv('marketreport', 'view');
$canEditReport   = hasPriv('marketreport', 'edit');
$canDeleteReport = hasPriv('marketreport', 'delete');
foreach((array)$reportGroup as $researchName => $reports)
{
    $cards = array();
    foreach($reports as $report)
    {
        $cardActions = array();
        if($canEditReport)
        {
            $editLink      = createLink('marketreport', 'edit', "marketreportID={$report->id}&fromMarket={$market->id}");
            $cardActions[] = "<a href='{$editLink}' class='btn ghost size-sm text-primary'><i class='icon icon-edit'></i></a>";
        }
        if($canDeleteReport)
        {
            $deleteLink      = createLink('marketreport', 'delete', "marketreportID={$report->id}");
            $confirmDelete   = $lang->marketreport->confirmDelete;
            $cardActions[]   = "<a href='{$deleteLink}' class='btn ghost size-sm text-primary ajax-submit' data-confirm='{$confirmDelete}'><i class='icon icon-trash'></i></a>";
        }

        $reportName = (string)$report->name;
        $cardFace   = "<div class='market-report-card-face'><div class='market-report-card-title'>{$reportName}</div></div>";
        $cardLink   = $canViewReport
            ? "<a href='" . createLink('marketreport', 'view', "marketreportID={$report->id}&fromMarket={$market->id}") . "' class='market-report-card-link'>{$cardFace}</a>"
            : "<div class='market-report-card-link'>{$cardFace}</div>";
        $actionHtml = !empty($cardActions) ? "<div class='market-report-card-actions'>" . implode('', $cardActions) . '</div>' : '';

        $cards[] = "<div class='market-report-card'>{$cardLink}{$actionHtml}</div>";
    }

    $reportSections[] = setting()
        ->title($researchName)
        ->control('html')
        ->content("<div class='market-report-grid'>" . implode('', $cards) . '</div>');
}

$basicInfoItems = array();
$basicInfoItems[$lang->market->industry]    = $market->industry;
$basicInfoItems[$lang->market->scale]       = $market->scale != 0 ? $market->scale . ' ' . $lang->market->hundredMillion : '';
$basicInfoItems[$lang->market->maturity]    = zget($lang->market->maturityList, $market->maturity);
$basicInfoItems[$lang->market->speed]       = zget($lang->market->speedList, $market->speed);
$basicInfoItems[$lang->market->competition] = zget($lang->market->competitionList, $market->competition);
$basicInfoItems[$lang->market->ppm]         = zget($lang->market->ppmList, $market->ppm);
$basicInfoItems[$lang->market->strategy]    = zget($lang->market->strategyList, $market->strategy);
$basicInfoItems[$lang->market->openedDate]  = helper::isZeroDate($market->openedDate) ? '' : $market->openedDate;

$tabs = array();
$tabs[] = setting()
    ->group('basic')
    ->title($lang->market->basicInfo)
    ->control('datalist')
    ->items($basicInfoItems);

$sections = array();
$sections[] = setting()
    ->title($lang->market->desc)
    ->control('html')
    ->content($desc);
$sections = array_merge($sections, $reportSections);

detail
(
    set::object($market),
    set::objectType('market'),
    set::objectID($market->id),
    set::sections($sections),
    set::tabs($tabs),
    set::actions(array_values($actions))
);
