<?php
protected function afterMerge($productID, $targetBranch, $mergedBranches, $data)
{
    return $this->loadExtension('ipd')->afterMerge($productID, $targetBranch, $mergedBranches, $data);
}
