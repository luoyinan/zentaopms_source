<?php
protected function updateTwins($storyIdList, $mainStoryID)
{
    $this->loadExtension('relation')->updateTwins($storyIdList, $mainStoryID);
}
