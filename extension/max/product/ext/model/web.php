<?php
public function setMenu($productID = 0, $branch = '', $extra = '')
{
    return $this->loadExtension('web')->setMenu($productID, $branch, $extra);
}
