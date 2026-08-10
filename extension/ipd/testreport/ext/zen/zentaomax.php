<?php
public function assignTesttaskReportData($objectID, $begin = '', $end = '', $productID = 0, $task = null, $method = 'create')
{
    return $this->loadExtension('zentaomax')->assignTesttaskReportData($objectID, $begin, $end, $productID, $task, $method);
}

public function assignProjectReportDataForCreate($objectID, $objectType, $extra, $begin = '', $end = '', $executionID = 0)
{
    return $this->loadExtension('zentaomax')->assignProjectReportDataForCreate($objectID, $objectType, $extra, $begin, $end, $executionID);
}

public function buildReportDataForView($report)
{
    return $this->loadExtension('zentaomax')->buildReportDataForView($report);
}
