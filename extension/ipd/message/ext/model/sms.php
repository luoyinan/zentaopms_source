<?php
public function send($objectType, $objectID, $actionType, $actionID, $actor = '', $extra = '')
{
    $this->loadExtension('sms')->send($objectType, $objectID, $actionType, $actionID, $actor, $extra);
}
