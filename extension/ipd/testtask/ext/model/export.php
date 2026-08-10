<?php
public function getBugInfo($taskID, $productID)
{
    return $this->loadExtension('export')->getBugInfo($taskID, $productID);
}
