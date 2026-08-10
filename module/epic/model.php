<?php
class epicModel extends model
{
    public static function isClickable($data, $action)
    {
        global $app;
        $app->control->loadModel('story');
        return call_user_func_array(array('storyModel', 'isClickable'), array($data, $action));
    }

    public function getToAndCcList($story, $actionType)
    {
        return $this->loadModel('story')->getToAndCcList($story, $actionType);
    }
}
