<?php
public function fetchTesttaskList($productID, $branch = '', $projectID = 0, $unit = 'no', $scope = '', $status = '', $begin = '', $end = '', $orderBy = '', $pager = null)
{
    return $this->loadExtension('zentaomax')->fetchTesttaskList($productID, $branch, $projectID, $unit, $scope, $status, $begin, $end, $orderBy, $pager);
}
