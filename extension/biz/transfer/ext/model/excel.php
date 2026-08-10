<?php
public function readExcel($module = '', $pagerID = 1, $insert = '', $filter = '')
{
    return $this->loadExtension('excel')->readExcel($module, $pagerID, $insert, $filter);
}
