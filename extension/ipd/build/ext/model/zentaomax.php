<?php
public function getBuildPairs($productIdList, $branch = 'all', $params = 'noterminate, nodone', $objectID = 0, $objectType = 'execution', $buildIdList = '', $replace = true, $system = 0)
{
    return $this->loadExtension('zentaomax')->getBuildPairs($productIdList, $branch, $params, $objectID, $objectType, $buildIdList, $replace, $system);
}
