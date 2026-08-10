<?php
public function assignForCases($product, $testtask, $runs, $scenes, $moduleID, $browseType, $param, $orderBy, $pager)
{
    $this->loadExtension('zentaomax')->assignForCases($product, $testtask, $runs, $scenes, $moduleID, $browseType, $param, $orderBy, $pager);
}

public function setDropMenu($productID, $task)
{
    $this->loadExtension('zentaomax')->setDropMenu($productID, $task);
}

public function setMenu($productID, $branch, $projectID, $executionID,  $testtask = null)
{
    $this->loadExtension('zentaomax')->setMenu($productID, $branch, $projectID, $executionID, $testtask);
}
