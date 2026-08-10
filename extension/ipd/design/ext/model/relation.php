<?php
public function create($design)
{
    return $this->loadExtension('relation')->create($design);
}
public function update($designID = 0, $design = null)
{
    return $this->loadExtension('relation')->update($designID, $design);
}
