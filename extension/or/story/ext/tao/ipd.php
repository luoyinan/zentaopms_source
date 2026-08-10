<?php
public function buildTrackCols($storyType)
{
    return $this->loadExtension('ipd')->buildTrackCols($storyType);
}

public function buildTrackItems($allStories, $leafNodes, $storyType, $demands = array())
{
    return $this->loadExtension('ipd')->buildTrackItems($allStories, $leafNodes, $storyType, $demands);
}

public function buildTrackLanes($leafNodes, $storyType, $demands = array())
{
    return $this->loadExtension('ipd')->buildTrackLanes($leafNodes, $storyType, $demands);
}
