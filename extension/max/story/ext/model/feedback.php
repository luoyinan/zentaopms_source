<?php
public function create($story, $executionID = 0, $bugID = 0, $extra = '', $todoID = 0)
{
    return $this->loadExtension('feedback')->create($story, $executionID, $bugID, $extra, $todoID);
}

public function update($storyID, $story, $comment = '')
{
    return $this->loadExtension('feedback')->update($storyID, $story, $comment);
}

public function change($storyID, $story)
{
    return $this->loadExtension('feedback')->change($storyID, $story);
}

public function recallChange($storyID)
{
    $this->loadExtension('feedback')->recallChange($storyID);
}

public function getByID($storyID, $version = 0, $setImgSize = false)
{
    return $this->loadExtension('feedback')->getById($storyID, $version, $setImgSize);
}

public function relieveTwins($productID, $storyID)
{
    return $this->loadExtension('feedback')->relieveTwins($productID, $storyID);
}

public function getExecutionStories($executionID = 0, $productID = 0, $orderBy = 't1.`order`_desc', $browseType = 'byModule', $param = '0', $storyType = 'story', $excludeStories = '', $pager = null)
{
    return $this->loadExtension('feedback')->getExecutionStories($executionID, $productID, $orderBy, $browseType, $param, $storyType, $excludeStories, $pager);
}
