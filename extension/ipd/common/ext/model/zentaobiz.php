<?php
public function checkExtLicense($ext, $checkDate = '')
{
    return $this->loadExtension('zentaobiz')->checkExtLicense($ext, $checkDate);
}
