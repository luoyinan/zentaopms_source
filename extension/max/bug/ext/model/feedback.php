<?php
public function create($bug, $from = '')
{
    return $this->loadExtension('feedback')->create($bug, $from);
}

public function getByID($bugID, $setImgSize = false)
{
    return $this->loadExtension('feedback')->getById($bugID, $setImgSize);
}
