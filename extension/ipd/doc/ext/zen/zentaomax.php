<?php
public function checkBlockPriv($type)
{
    return $this->loadExtension('zentaomax')->checkBlockPriv($type);
}
