<?php
public function getRelationByID($id)
{
    return $this->loadExtension('relation')->getRelationByID($id);
}

public function getAllRelationName($excludedID = 0)
{
    return $this->loadExtension('relation')->getAllRelationName($excludedID);
}

public function createRelation($formData)
{
    $this->loadExtension('relation')->createRelation($formData);
}

public function editRelation($id, $formData)
{
    return $this->loadExtension('relation')->editRelation($id, $formData);
}

public function getRelationObjectCount($key = 0)
{
    return $this->loadExtension('relation')->getRelationObjectCount($key);
}

public function getObjects($objectType, $browseType = '', $orderBy = 'id_desc', $pager = null, $excludedID = 0)
{
    return $this->loadExtension('relation')->getObjects($objectType, $browseType, $orderBy, $pager, $excludedID);
}

public function getObjectCols($objectType)
{
    return $this->loadExtension('relation')->getObjectCols($objectType);
}

public function getRelationList($getParis = false, $addDefault = false)
{
    return $this->loadExtension('relation')->getRelationList($getParis, $addDefault);
}

public function relateObject($objectID, $objectType, $objectRelation, $relatedObjectType)
{
    return $this->loadExtension('relation')->relateObject($objectID, $objectType, $objectRelation, $relatedObjectType);
}

public function removeObjects($objectID, $objectType, $relationName, $relatedObjectID, $relatedObjectType)
{
    return $this->loadExtension('relation')->removeObjects($objectID, $objectType, $relationName, $relatedObjectID, $relatedObjectType);
}

public function getObjectInfoByType($objectList)
{
    return $this->loadExtension('relation')->getObjectInfoByType($objectList);
}

public function getRelatedObjectList($objectID, $objectType, $browseType = 'byRelation', $getCount = false)
{
    return $this->loadExtension('relation')->getRelatedObjectList($objectID, $objectType, $browseType, $getCount);
}

public function setConfig4Workflow()
{
    return $this->loadExtension('relation')->setConfig4Workflow();
}

public function canSearch($objectType)
{
    return $this->loadExtension('relation')->canSearch($objectType);
}
