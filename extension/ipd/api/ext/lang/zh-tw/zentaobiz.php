<?php
$lang->api->export = 'API導出';

$lang->api->exportScope['single'] = '當前API';
$lang->api->exportScope['all']    = '所有API';

$lang->api->exportListAll     = '列表中介面文檔';
$lang->api->exportProjectAll  = '關聯該項目的介面文檔';
$lang->api->exportProductAll  = '關聯該產品的介面文檔';
$lang->api->exportNoLinkAll   = '未關聯產品和項目的所有介面文檔';
$lang->api->untitled          = '未命名';

$lang->api->exportOpenAPI      = '導出 OpenAPI';
$lang->api->exportFileName     = '檔案名';
$lang->api->exportScopeLabel   = '導出範圍';
$lang->api->exportVersionLabel = 'OpenAPI 版本';
$lang->api->exportFormatLabel  = '檔案格式';

$lang->api->exportScopeList = array();
$lang->api->exportScopeList['current']    = '當前介面';

$lang->api->exportVersionList = array();
$lang->api->exportVersionList['3.2'] = '3.2';
$lang->api->exportVersionList['3.1'] = '3.1';
$lang->api->exportVersionList['3.0'] = '3.0';

$lang->api->exportFormatList = array();
$lang->api->exportFormatList['json'] = 'JSON';
$lang->api->exportFormatList['yaml'] = 'YAML';

$lang->api->exportError = new stdClass();
$lang->api->exportError->editionLimited  = '當前版本不支持導出 OpenAPI。';
$lang->api->exportError->libNotFound     = '未找到介面空間。';
$lang->api->exportError->noPriv          = '你沒有當前介面空間的訪問權限。';
$lang->api->exportError->moduleNotFound  = '未找到介面目錄。';
$lang->api->exportError->releaseNotFound = '未找到發佈版本。';
$lang->api->exportError->invalidParam    = '導出參數不正確。';
$lang->api->exportError->apiNotFound     = '未找到介面。';
$lang->api->exportError->dupPath         = '存在重複的請求路徑和請求方式，無法導出 OpenAPI。';

$lang->api->importOpenAPI  = '導入 OpenAPI';
$lang->api->createMode     = '創建方式';
$lang->api->createModeList = array('create' => '手動創建', 'import' => $lang->api->importOpenAPI);
$lang->api->importFile     = 'OpenAPI 檔案';
$lang->api->importFileTip  = '支持導入 OpenAPI 3.* 格式的 JSON 或 YAML 檔案。';
$lang->api->currentLib     = '當前介面庫';
$lang->api->targetModule   = '導入目錄';
$lang->api->rootDir        = '根目錄';
$lang->api->importResult   = '導入結果';
$lang->api->importCreated  = '成功創建';
$lang->api->importSkipped  = '跳過';
$lang->api->importFailed   = '失敗';
$lang->api->importSummary  = '導入結果：成功創建 %d，跳過 %d，失敗 %d';

$lang->api->importError = new stdClass();
$lang->api->importError->noFile         = '請選擇要導入的檔案';
$lang->api->importError->fileType       = '僅支持 .json, .yaml 格式';
$lang->api->importError->parseFail      = '檔案解析失敗';
$lang->api->importError->invalidOAS     = '無效的 OpenAPI 文檔';
$lang->api->importError->noPaths        = '文檔中未找到介面定義';
$lang->api->importError->libNotFound    = '介面庫不存在';
$lang->api->importError->noPriv         = '無權訪問該庫';
$lang->api->importError->moduleNotFound = '目錄不存在';
$lang->api->importError->editionLimited = 'OpenAPI 導入僅企業版可用';
$lang->api->importError->moduleExists   = '目錄名“%s”已經存在！';
$lang->api->importError->apiTitleExists = '介面名稱“%s”已經存在！';

$lang->api->importError->apiPathMethodExists          = '請求路徑“%s”和請求方式“%s”已經存在！';
$lang->api->importError->duplicateModuleInFile        = '導入檔案中存在重複目錄名“%s”！';
$lang->api->importError->duplicateApiTitleInFile      = '導入檔案中存在重複介面名稱“%s”！';
$lang->api->importError->duplicateApiPathMethodInFile = '導入檔案中存在重複請求路徑“%s”和請求方式“%s”！';
