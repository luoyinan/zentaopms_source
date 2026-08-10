<?php
public function getPairsByProduct($productID, $branch = 0)
{
    return $this->loadExtension('ops')->getPairsByProduct($productID, $branch);
}

public function linkStory($releaseID, $stories)
{
    return $this->loadExtension('ops')->linkStory($releaseID, $stories);
}

public function unlinkStory($releaseID, $storyID)
{
    return $this->loadExtension('ops')->unlinkStory($releaseID, $storyID);
}

public function batchUnlinkStory($releaseID, $storyIdList)
{
    return $this->loadExtension('ops')->batchUnlinkStory($releaseID, $storyIdList);
}
