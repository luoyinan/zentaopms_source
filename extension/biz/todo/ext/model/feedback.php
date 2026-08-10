<?php
public function create($todo)
{
    return $this->loadExtension('feedback')->create($todo);
}
