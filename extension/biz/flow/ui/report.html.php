<?php
/**
 * The report view file of flow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Guangming Sun <sunguangming@chandao.com>
 * @package     flow
 * @link        https://www.zentao.net
 */
namespace zin;

jsVar('moduleName', $flow->module);

detailHeader
(
    to::title
    (
        entityLabel
        (
            set::level(1),
            set::text($lang->report->common)
        )
    )
);

$reports = array();
foreach($reportPairs as $id => $name) $reports[] = array('text' => $name, 'value' => $id);

function formatChartDatas($datas)
{
    global $app;

    $items = array();
    foreach($datas as $data)
    {
        $item        = new stdClass();
        $item->name  = $data->label;
        $value = $data->value;
        if(is_array($value) || is_object($value))
        {
            $array = (array)$value;
            $value = reset($array);
        }
        $item->value = $value;
        $items[]     = $item;
    }

    return $app->control->loadModel('report')->computePercent($items);
}

function buildChartWidgets($charts, $chartData)
{
    $widgets = array();
    foreach($charts as $chart)
    {
        $dataKey = 'chart-' . $chart->id;
        $datas   = zget($chartData, $dataKey, array());
        if(empty($datas)) continue;

        $widgets[] = div
        (
            setClass('mb-4'),
            tableChart
            (
                set::item($dataKey),
                set::type($chart->type),
                set::title($chart->name),
                set::datas(formatChartDatas((array)$datas)),
                set::tableWidth('40%')
            )
        );
    }

    return $widgets;
}

div
(
    setClass('flex items-start'),
    cell
    (
        set::width('240'),
        setClass('bg-white p-4 mr-5'),
        div(setClass('pb-2 font-bold'), $lang->workflowreport->select),
        div
        (
            setClass('pb-2'),
            checkList
            (
                set::name('reports[]'),
                set::items($reports),
                set::value((array)$checkedReports)
            )
        ),
        btn
        (
            bind::click('selectAll'),
            $lang->selectAll
        ),
        btn
        (
            setClass('primary ml-4'),
            bind::click('clickInit'),
            $lang->workflowreport->generate
        )
    ),
    cell
    (
        set::flex('1'),
        setClass('bg-white px-4 py-2'),
        setID('report'),
        div
        (
            setClass('pb-4'),
            span(setClass('font-bold'), $lang->workflowreport->report),
            span(setClass('text-warning ml-2'), $lang->workflowreport->tips->source)
        ),
        div(buildChartWidgets((array)$charts, (array)$chartData))
    )
);
