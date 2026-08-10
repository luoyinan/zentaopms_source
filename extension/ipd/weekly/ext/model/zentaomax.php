<?php
public function create($report)
{
    return $this->loadExtension('zentaomax')->create($report);
}

public function getList($projectID = 0, $browseType = 'all', $moduleID = '', $orderBy = 'id_desc', $limit = 0)
{
    return $this->loadExtension('zentaomax')->getList($projectID, $browseType, $moduleID, $orderBy, $limit);
}

public function getBeginAndEnd($period = '')
{
    return $this->loadExtension('zentaomax')->getBeginAndEnd($period);
}

public function isClickable($report, $action)
{
    return $this->loadExtension('zentaomax')->isClickable($report, $action);
}

public function buildSearchForm($queryID, $actionURL)
{
    return $this->loadExtension('zentaomax')->buildSearchForm($queryID, $actionURL);
}

public function getBySearch($projectID = 0, $queryID = 0, $orderBy = 'id_desc')
{
    return $this->loadExtension('zentaomax')->getBySearch($projectID, $queryID, $orderBy);
}

public function getTemplateContent($templateID, $reportID = 0)
{
    return $this->loadExtension('zentaomax')->getTemplateContent($templateID, $reportID);
}

public function deleteReport($reportID)
{
    return $this->loadExtension('zentaomax')->deleteReport($reportID);
}

public function buildSummaryTable($projectID, $end = '')
{
    return $this->loadExtension('zentaomax')->buildSummaryTable($projectID, $end);
}

public function buildWorkloadTable($projectID)
{
    return $this->loadExtension('zentaomax')->buildWorkloadTable($projectID);
}

public function getModuleTree($projectID, $browseType)
{
    return $this->loadExtension('zentaomax')->getModuleTree($projectID, $browseType);
}

public function addCategory($moduleData)
{
    return $this->loadExtension('zentaomax')->addCategory($moduleData);
}

public function updateCategory($moduleID, $moduleData)
{
    return $this->loadExtension('zentaomax')->updateCategory($moduleID, $moduleData);
}
public function deleteCategory($moduleID)
{
    return $this->loadExtension('zentaomax')->deleteCategory($moduleID);
}

public function getModulePairs($projectID, $mode = '')
{
    return $this->loadExtension('zentaomax')->getModulePairs($projectID, $mode);
}

public function copyDocBlock($reportID, $reportContent, $projectID)
{
    return $this->loadExtension('zentaomax')->copyDocBlock($reportID, $reportContent, $projectID);
}
