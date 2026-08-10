<?php
public function linkStory($buildID, $storyIdList)
{
    return $this->loadExtension('relation')->linkStory($buildID, $storyIdList);
}

public function unlinkStory($buildID, $storyID)
{
    return $this->loadExtension('relation')->unlinkStory($buildID, $storyID);
}

public function batchUnlinkStory($buildID, $storyIDList)
{
    return $this->loadExtension('relation')->batchUnlinkStory($buildID, $storyIDList);
}
