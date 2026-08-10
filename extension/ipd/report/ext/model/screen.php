<?php
public function buildPieChartConfig($title, $dataMap, &$xAxis = 0, &$yAxis = 0, $index = 0, $itemCount = 3, $label = '')
{
    return $this->loadExtension('screen')->buildPieChartConfig($title, $dataMap, $xAxis, $yAxis, $index, $itemCount, $label);
}

public function buildBarChartConfig($title, $dataMap, &$yAxis = 0, $type = 'cluBarX', $index = 0, $itemNum = 1, $height = 0)
{
    return $this->loadExtension('screen')->buildBarChartConfig($title, $dataMap, $yAxis, $type, $index, $itemNum, $height);
}

public function addBorderChart($height, $yAxis, $attr, $multiplier = 10, $divider = 0)
{
    return $this->loadExtension('screen')->addBorderChart($height, $yAxis, $attr, $multiplier, $divider);
}

public function buildTitleChartConfig($title, $xAxis, $yAxis)
{
    return $this->loadExtension('screen')->buildTitleChartConfig($title, $xAxis, $yAxis);
}

public function buildTextChartConfig($title, $subTitle, &$xAxis, &$yAxis, $index = 0, $width = 0, $gap = 0, $tips = '')
{
    return $this->loadExtension('screen')->buildTextChartConfig($title, $subTitle, $xAxis, $yAxis, $index, $width, $gap, $tips);
}

public function buildWaterChartConfig($title, $rate, &$xAxis, &$yAxis, $index = 0, $tips = '', $lineNum = 2)
{
    return $this->loadExtension('screen')->buildWaterChartConfig($title, $rate, $xAxis, $yAxis, $index, $tips, $lineNum);
}

public function addHelperChart($xAxis, $yAxis, $tips)
{
    return $this->loadExtension('screen')->addHelperChart($xAxis, $yAxis, $tips);
}

public function buildTableChartConfig($title, $headers, $dataset, &$yAxis = 0, $lineNum = 0, $rowspan = array(), $noDataTip = '', $titleTip = '')
{
    return $this->loadExtension('screen')->buildTableChartConfig($title, $headers, $dataset, $yAxis, $lineNum, $rowspan, $noDataTip, $titleTip);
}

public function buildTextGroupChartConfig($contents, &$xAxis, &$yAxis, $width = 0, $height = 0)
{
    return $this->loadExtension('screen')->buildTextGroupChartConfig($contents, $xAxis, $yAxis, $width, $height);
}

public function buildSunburstChartConfig($title, $dataMap, &$xAxis = 0, &$yAxis = 0, $tips = '')
{
    return $this->loadExtension('screen')->buildSunburstChartConfig($title, $dataMap, $xAxis, $yAxis, $tips);
}

public function getWaterEchartsOptions($percent)
{
    return $this->loadExtension('screen')->getWaterEchartsOptions($percent);
}

public function getBarEchartsOptions($settings)
{
    return $this->loadExtension('screen')->getBarEchartsOptions($settings, false);
}

public function getBarYEchartsOptions($settings)
{
    return $this->loadExtension('screen')->getBarEchartsOptions($settings, true);
}

public function getPieEchartsOptions($settings)
{
    return $this->loadExtension('screen')->getPieEchartsOptions($settings);
}

public function getSunburstEchartsOptions($dataMap)
{
    return $this->loadExtension('screen')->getSunburstEchartsOptions($dataMap);
}

public function getLineEchartsOptions($settings)
{
    return $this->loadExtension('screen')->getLineEchartsOptions($settings);
}
