<?php
public function editMiniProgram($appID)
{
    return $this->loadExtension('zentaobiz')->editMiniProgram($appID);
}

public function createZtAppJson($appID)
{
    return $this->loadExtension('zentaobiz')->createZtAppJson($appID);
}

public function createZtAppZip($file)
{
    return $this->loadExtension('zentaobiz')->createZtAppZip($file);
}

public function deleteMiniProgram($appID, $deleted = '1')
{
    return $this->loadExtension('zentaobiz')->deleteMiniProgram($appID, $deleted);
}

public function createKnowledge($knowledge, $skipUpdateExternal = false)
{
    return $this->loadExtension('zentaobiz')->createKnowledge($knowledge, $skipUpdateExternal);
}

public function updateExternalKnowledge($knowledge, $knowledgeLib = null)
{
    return $this->loadExtension('zentaobiz')->updateExternalKnowledge($knowledge, $knowledgeLib);
}

public function updateKnowledge($id, $knowledge)
{
    return $this->loadExtension('zentaobiz')->updateKnowledge($id, $knowledge);
}

public function getKnowledgeItemByID($id)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeItemByID($id);
}

public function updateKnowledgeItem($id, $data, $skipUpdateExternal = false)
{
    return $this->loadExtension('zentaobiz')->updateKnowledgeItem($id, $data, $skipUpdateExternal);
}

public function updateKnowledgeItemFromSource($knowledge, $skipUpdateExternal = 'no')
{
    return $this->loadExtension('zentaobiz')->updateKnowledgeItemFromSource($knowledge, $skipUpdateExternal);
}

public function getKnowledgeObjectByID($objectType, $objectID)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeObjectByID($objectType, $objectID);
}

public function deleteKnowledgeItem($id)
{
    return $this->loadExtension('zentaobiz')->deleteKnowledgeItem($id);
}

public function checkKnowledgeLibPriv($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->checkKnowledgeLibPriv($knowledgeLib);
}

public function getKnowledgeLibs($type = 'my', $category = '', $published = '', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibs($type, $category, $published, $orderBy, $pager);
}

public function getKnowledgeLibByID($id)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibByID($id);
}

public function getKnowledgeLibsByIDs($ids)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibsByIDs($ids);
}

public function getKnowledgeLibStats($libID)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibStats($libID);
}

public function getTextFileItems($libID)
{
    return $this->loadExtension('zentaobiz')->getTextFileItems($libID);
}

public function publishKnowledgeLib($id)
{
    return $this->loadExtension('zentaobiz')->publishKnowledgeLib($id);
}

public function unpublishKnowledgeLib($id)
{
    return $this->loadExtension('zentaobiz')->unpublishKnowledgeLib($id);
}

public function deleteKnowledgeLib($id)
{
    return $this->loadExtension('zentaobiz')->deleteKnowledgeLib($id);
}

public function buildKnowledgeLibSearchForm($type, $queryID, $actionURL)
{
    $this->loadExtension('zentaobiz')->buildKnowledgeLibSearchForm($type, $queryID, $actionURL);
}

public function getKnowledgeLibsBySearch($type, $queryID, $orderBy, $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeLibsBySearch($type, $queryID, $orderBy, $pager);
}

public function browseKnowledgeLib($type, $category, $published, $orderBy, $param, $recTotal = 0, $recPerPage = 20, $pageID = 1)
{
    return $this->loadExtension('zentaobiz')->browseKnowledgeLib($type, $category, $published, $orderBy, $param, $recTotal, $recPerPage, $pageID);
}

public function createKnowledgeLib($knowledgeLib, $actionType = 'created')
{
    return $this->loadExtension('zentaobiz')->createKnowledgeLib($knowledgeLib, $actionType);
}

public function ensureExternalKnowledgeLib($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->ensureExternalKnowledgeLib($knowledgeLib);
}

public function editKnowledgeLib($id, $knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->editKnowledgeLib($id, $knowledgeLib);
}

public function importFromDoc($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->importFromDoc($knowledgeLib);
}

public function importFromAsset($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->importFromAsset($knowledgeLib);
}

public function buildKnowledgeObjectData($objectType, $source)
{
    return $this->loadExtension('zentaobiz')->buildKnowledgeObjectData($objectType, $source);
}

public function prepareMarkdownLangMap($objectType)
{
    return $this->loadExtension('zentaobiz')->prepareMarkdownLangMap($objectType);
}

public function getKnowledgeItems($libID, $type, $objectType, $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeItems($libID, $type, $objectType, $orderBy, $pager);
}

public function getKnowledgeItemsByObjectType($libID, $objectType, $pager = null)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeItemsByObjectType($libID, $objectType, $pager);
}

public function isKnowledgeNeedSync($knowledge)
{
    return $this->loadExtension('zentaobiz')->isKnowledgeNeedSync($knowledge);
}

public function getKnowledgeByObjectIdList($lib, $objectType, $objectIdList)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeByObjectIdList($lib, $objectType, $objectIdList);
}

public function batchDeleteKnowledgeItem($idList)
{
    return $this->loadExtension('zentaobiz')->batchDeleteKnowledgeItem($idList);
}

public function getKnowledgeObjectCols($objectType)
{
    return $this->loadExtension('zentaobiz')->getKnowledgeObjectCols($objectType);
}

public function prepareReleaseKnowledgeImportList($items)
{
    return $this->loadExtension('zentaobiz')->prepareReleaseKnowledgeImportList($items);
}

public function checkExistKnowledgeLib($knowledgeLib)
{
    return $this->loadExtension('zentaobiz')->checkExistKnowledgeLib($knowledgeLib);
}
