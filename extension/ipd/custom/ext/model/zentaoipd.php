<?php
public function setStoryGrade($module, $data)
{
    return $this->loadExtension('zentaoipd')->setStoryGrade($module, $data);
}
