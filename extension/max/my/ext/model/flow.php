<?php
public function getFlowPairs()
{
    return $this->loadExtension('flow')->getFlowPairs();
}

public function appendWorkFlowMenu()
{
    $this->loadExtension('flow')->appendWorkFlowMenu();
}

public function getAssignedFlowCount($module)
{
    return $this->loadExtension('flow')->getAssignedFlowCount($module);
}
