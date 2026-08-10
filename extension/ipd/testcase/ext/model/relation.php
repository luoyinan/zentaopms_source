<?php
public function create($case)
{
    return $this->loadExtension('relation')->create($case);
}
public function update($case, $oldCase, $testtasks = array())
{
    return $this->loadExtension('relation')->update($case, $oldCase, $testtasks);
}
