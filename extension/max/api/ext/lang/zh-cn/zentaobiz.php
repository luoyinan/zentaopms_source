<?php
$lang->api->export = 'API导出';

$lang->api->exportScope['single'] = '当前API';
$lang->api->exportScope['all']    = '所有API';

$lang->api->exportListAll     = '列表中接口文档';
$lang->api->exportProjectAll  = '关联该项目的接口文档';
$lang->api->exportProductAll  = '关联该产品的接口文档';
$lang->api->exportNoLinkAll   = '未关联产品和项目的所有接口文档';
$lang->api->untitled          = '未命名';

$lang->api->exportOpenAPI      = '导出 OpenAPI';
$lang->api->exportFileName     = '文件名';
$lang->api->exportScopeLabel   = '导出范围';
$lang->api->exportVersionLabel = 'OpenAPI 版本';
$lang->api->exportFormatLabel  = '文件格式';

$lang->api->exportScopeList = array();
$lang->api->exportScopeList['current']    = '当前接口';

$lang->api->exportVersionList = array();
$lang->api->exportVersionList['3.2'] = '3.2';
$lang->api->exportVersionList['3.1'] = '3.1';
$lang->api->exportVersionList['3.0'] = '3.0';

$lang->api->exportFormatList = array();
$lang->api->exportFormatList['json'] = 'JSON';
$lang->api->exportFormatList['yaml'] = 'YAML';

$lang->api->exportError = new stdClass();
$lang->api->exportError->editionLimited  = '当前版本不支持导出 OpenAPI。';
$lang->api->exportError->libNotFound     = '未找到接口空间。';
$lang->api->exportError->noPriv          = '你没有当前接口空间的访问权限。';
$lang->api->exportError->moduleNotFound  = '未找到接口目录。';
$lang->api->exportError->releaseNotFound = '未找到发布版本。';
$lang->api->exportError->invalidParam    = '导出参数不正确。';
$lang->api->exportError->apiNotFound     = '未找到接口。';
$lang->api->exportError->dupPath         = '存在重复的请求路径和请求方式，无法导出 OpenAPI。';

$lang->api->importOpenAPI  = '导入 OpenAPI';
$lang->api->createMode     = '创建方式';
$lang->api->createModeList = array('create' => '手动创建', 'import' => $lang->api->importOpenAPI);
$lang->api->importFile     = 'OpenAPI 文件';
$lang->api->importFileTip  = '支持导入 OpenAPI 3.* 格式的 JSON 或 YAML 文件。';
$lang->api->currentLib     = '当前接口库';
$lang->api->targetModule   = '导入目录';
$lang->api->rootDir        = '根目录';
$lang->api->importResult   = '导入结果';
$lang->api->importCreated  = '成功创建';
$lang->api->importSkipped  = '跳过';
$lang->api->importFailed   = '失败';
$lang->api->importSummary  = '导入结果：成功创建 %d，跳过 %d，失败 %d';

$lang->api->importError = new stdClass();
$lang->api->importError->noFile         = '请选择要导入的文件';
$lang->api->importError->fileType       = '仅支持 .json, .yaml 格式';
$lang->api->importError->parseFail      = '文件解析失败';
$lang->api->importError->invalidOAS     = '无效的 OpenAPI 文档';
$lang->api->importError->noPaths        = '文档中未找到接口定义';
$lang->api->importError->libNotFound    = '接口库不存在';
$lang->api->importError->noPriv         = '无权访问该库';
$lang->api->importError->moduleNotFound = '目录不存在';
$lang->api->importError->editionLimited = 'OpenAPI 导入仅企业版可用';
$lang->api->importError->moduleExists   = '目录名“%s”已经存在！';
$lang->api->importError->apiTitleExists = '接口名称“%s”已经存在！';

$lang->api->importError->apiPathMethodExists          = '请求路径“%s”和请求方式“%s”已经存在！';
$lang->api->importError->duplicateModuleInFile        = '导入文件中存在重复目录名“%s”！';
$lang->api->importError->duplicateApiTitleInFile      = '导入文件中存在重复接口名称“%s”！';
$lang->api->importError->duplicateApiPathMethodInFile = '导入文件中存在重复请求路径“%s”和请求方式“%s”！';
