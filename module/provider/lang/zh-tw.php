<?php
$lang->provider->browse = '瀏覽服務';
$lang->provider->create = '添加服務';
$lang->provider->edit   = '編輯服務';
$lang->provider->delete = '刪除服務';

$lang->provider->browseAction = '服務列表';
$lang->provider->createAction = '新建服務';
$lang->provider->editAction   = '編輯服務';
$lang->provider->deleteAction = '刪除服務';

$lang->provider->name        = '服務名稱';
$lang->provider->type        = '服務類型';
$lang->provider->url         = '伺服器地址';
$lang->provider->token       = '令牌';
$lang->provider->account     = '用戶名';
$lang->provider->createdBy   = '創建人';
$lang->provider->createdDate = '創建時間';

$lang->provider->error = new stdclass();
$lang->provider->error->api            = '『伺服器地址』無法訪問伺服器。';
$lang->provider->error->apiWithMessage = '『伺服器地址』無法訪問伺服器：%s';
$lang->provider->error->svnClient      = '無法找到 Subversion 客戶端。';

$lang->provider->typeList = array();
$lang->provider->typeList['GitLab']     = 'GitLab';
$lang->provider->typeList['Gitea']      = 'Gitea';
$lang->provider->typeList['Gogs']       = 'Gogs';
$lang->provider->typeList['Subversion'] = 'Subversion';
$lang->provider->typeList['Jenkins']    = 'Jenkins';

$lang->provider->notice = new stdclass();
$lang->provider->notice->confirmDelete = '你確定要刪除該服務嗎？';
$lang->provider->notice->emptyProvider = '暫無服務。';
$lang->provider->notice->svnPath       = '伺服器地址或檔案路徑';
$lang->provider->notice->hasRepos      = '該服務已經關聯了倉庫, 請先刪除關聯的倉庫。';
