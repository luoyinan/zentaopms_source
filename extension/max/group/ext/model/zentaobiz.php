<?php
public function create($group)
{
    return $this->loadExtension('zentaobiz')->create($group);
}

public function getPairs($projectID = 0)
{
    return $this->loadExtension('zentaobiz')->getPairs($projectID);
}

public function checkMenuModule($menu, $moduleName)
{
    return $this->loadExtension('zentaobiz')->checkMenuModule($menu, $moduleName);
}

public function getPrivManagerPairs($type, $parent = '')
{
    return $this->loadExtension('zentaobiz')->getPrivManagerPairs($type, $parent);
}
