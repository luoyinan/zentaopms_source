<?php
$lang->api->export = 'API Export';

$lang->api->exportScope['single'] = 'Current API';
$lang->api->exportScope['all']    = 'All API';

$lang->api->exportListAll     = 'Interface documents in the list';
$lang->api->exportProjectAll  = 'Interface documents for link product';
$lang->api->exportProductAll  = 'Interface documents for link project';
$lang->api->exportNoLinkAll   = 'Interface documents for no link';
$lang->api->untitled          = 'Untitled';

$lang->api->exportOpenAPI      = 'Export OpenAPI';
$lang->api->exportFileName     = 'File Name';
$lang->api->exportScopeLabel   = 'Export Scope';
$lang->api->exportVersionLabel = 'OpenAPI Version';
$lang->api->exportFormatLabel  = 'File Format';

$lang->api->exportScopeList = array();
$lang->api->exportScopeList['current']    = 'Current API';

$lang->api->exportVersionList = array();
$lang->api->exportVersionList['3.2'] = '3.2';
$lang->api->exportVersionList['3.1'] = '3.1';
$lang->api->exportVersionList['3.0'] = '3.0';

$lang->api->exportFormatList = array();
$lang->api->exportFormatList['json'] = 'JSON';
$lang->api->exportFormatList['yaml'] = 'YAML';

$lang->api->exportError = new stdClass();
$lang->api->exportError->editionLimited  = 'OpenAPI export is not available in this edition.';
$lang->api->exportError->libNotFound     = 'API space not found.';
$lang->api->exportError->noPriv          = 'You do not have access to this API space.';
$lang->api->exportError->moduleNotFound  = 'API module not found.';
$lang->api->exportError->releaseNotFound = 'Release not found.';
$lang->api->exportError->invalidParam    = 'Invalid export parameter.';
$lang->api->exportError->apiNotFound     = 'API not found.';
$lang->api->exportError->dupPath         = 'Duplicate request path and method were found. OpenAPI export cannot continue.';

$lang->api->importOpenAPI  = 'Import OpenAPI';
$lang->api->createMode     = 'Create Method';
$lang->api->createModeList = array('create' => 'Manual Create', 'import' => $lang->api->importOpenAPI);
$lang->api->importFile     = 'OpenAPI File';
$lang->api->importFileTip  = 'Supports importing OpenAPI 3.* JSON or YAML files.';
$lang->api->currentLib     = 'Current Library';
$lang->api->targetModule   = 'Import Directory';
$lang->api->rootDir        = 'Root Directory';
$lang->api->importResult   = 'Import Result';
$lang->api->importCreated  = 'Created';
$lang->api->importSkipped  = 'Skipped';
$lang->api->importFailed   = 'Failed';
$lang->api->importSummary  = 'Import Result: %d created, %d skipped, %d failed';

$lang->api->importError = new stdClass();
$lang->api->importError->noFile         = 'Please select a file to import';
$lang->api->importError->fileType       = 'Only .json, .yaml formats are supported';
$lang->api->importError->parseFail      = 'File parsing failed';
$lang->api->importError->invalidOAS     = 'Invalid OpenAPI document';
$lang->api->importError->noPaths        = 'No API definitions found in the document';
$lang->api->importError->libNotFound    = 'API library not found';
$lang->api->importError->noPriv         = 'Access denied';
$lang->api->importError->moduleNotFound = 'Module not found';
$lang->api->importError->editionLimited = 'OpenAPI import is only available in enterprise edition';
$lang->api->importError->moduleExists   = 'Directory "%s" already exists.';
$lang->api->importError->apiTitleExists = 'API name "%s" already exists.';

$lang->api->importError->apiPathMethodExists          = 'Request path "%s" and method "%s" already exist.';
$lang->api->importError->duplicateModuleInFile        = 'Duplicate directory name "%s" found in the imported file.';
$lang->api->importError->duplicateApiTitleInFile      = 'Duplicate API name "%s" found in the imported file.';
$lang->api->importError->duplicateApiPathMethodInFile = 'Duplicate request path "%s" and method "%s" found in the imported file.';
