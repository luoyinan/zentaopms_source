<?php
$lang->gitfox->common            = 'GitFox';
$lang->gitfox->browse            = '瀏覽GitFox';
$lang->gitfox->search            = '搜索';
$lang->gitfox->create            = '添加GitFox';
$lang->gitfox->edit              = '編輯GitFox';
$lang->gitfox->view              = 'GitFox詳情';
$lang->gitfox->bindUser          = '權限設置';
$lang->gitfox->webhook           = '介面：允許Webhook調用';
$lang->gitfox->importIssue       = '關聯Issue';
$lang->gitfox->delete            = '刪除GitFox';
$lang->gitfox->confirmDelete     = '確認刪除該GitFox嗎？';
$lang->gitfox->gitfoxAvatar      = '頭像';
$lang->gitfox->gitfoxAccount     = 'GitFox用戶';
$lang->gitfox->gitfoxEmail       = 'GitFox用戶郵箱';
$lang->gitfox->zentaoEmail       = '禪道用戶郵箱';
$lang->gitfox->zentaoAccount     = '禪道用戶';
$lang->gitfox->accountDesc       = '(系統會將相同郵箱地址的用戶自動匹配)';
$lang->gitfox->bindingStatus     = '綁定狀態';
$lang->gitfox->all               = '全部';
$lang->gitfox->notBind           = '未綁定';
$lang->gitfox->binded            = '已綁定';
$lang->gitfox->bindedError       = '綁定的用戶已刪除或者已修改，請重新綁定';
$lang->gitfox->bindDynamic       = '%s與禪道用戶%s';
$lang->gitfox->serverFail        = '連接GitFox伺服器異常，請檢查GitFox伺服器。';
$lang->gitfox->lastUpdate        = '最後更新';
$lang->gitfox->confirmAddWebhook = '您確定創建Webhook嗎？';
$lang->gitfox->addWebhookSuccess = 'Webhook創建成功';
$lang->gitfox->failCreateWebhook = 'Webhook創建失敗，請查看日誌';
$lang->gitfox->placeholderSearch = '請輸入名稱';

$lang->gitfox->bindStatus['binded']      = $lang->gitfox->binded;
$lang->gitfox->bindStatus['notBind']     = "<span class='text-danger'>{$lang->gitfox->notBind}</span>";
$lang->gitfox->bindStatus['bindedError'] = "<span class='text-danger'>{$lang->gitfox->bindedError}</span>";

$lang->gitfox->browseAction         = 'GitFox列表';
$lang->gitfox->deleteAction         = '刪除GitFox';
$lang->gitfox->gitfoxProject        = "{$lang->gitfox->common}項目";
$lang->gitfox->browseProject        = "GitFox項目列表";
$lang->gitfox->browseUser           = "用戶";
$lang->gitfox->browseGroup          = "GitFox群組列表";
$lang->gitfox->browseBranch         = "GitFox分支列表";
$lang->gitfox->browseTag            = "GitFox標籤列表";
$lang->gitfox->browseTagPriv        = "標籤保護管理";
$lang->gitfox->gitfoxIssue          = "{$lang->gitfox->common} issue";
$lang->gitfox->zentaoProduct        = '禪道產品';
$lang->gitfox->objectType           = '類型'; // task, bug, story
$lang->gitfox->manageProjectMembers = '項目成員管理';
$lang->gitfox->createProject        = '添加GitFox項目';
$lang->gitfox->editProject          = '編輯GitFox項目';
$lang->gitfox->deleteProject        = '刪除GitFox項目';
$lang->gitfox->createGroup          = '添加群組';
$lang->gitfox->editGroup            = '編輯群組';
$lang->gitfox->deleteGroup          = '刪除群組';
$lang->gitfox->createUser           = '添加用戶';
$lang->gitfox->editUser             = '編輯用戶';
$lang->gitfox->deleteUser           = '刪除用戶';
$lang->gitfox->createBranch         = '創建分支';
$lang->gitfox->manageGroupMembers   = '群組成員管理';
$lang->gitfox->createWebhook        = '創建Webhook';
$lang->gitfox->browseBranchPriv     = '分支保護管理';
$lang->gitfox->createTag            = '創建標籤';
$lang->gitfox->deleteTag            = '刪除標籤';
$lang->gitfox->deleteTagFail        = "標籤刪除失敗";
$lang->gitfox->saveFailed           = '『%s』保存失敗';

$lang->gitfox->id             = 'ID';
$lang->gitfox->name           = "應用名稱";
$lang->gitfox->url            = '伺服器地址';
$lang->gitfox->token          = 'Token';
$lang->gitfox->defaultProject = '預設項目';
$lang->gitfox->private        = 'MD5驗證';

$lang->gitfox->server        = "伺服器列表";
$lang->gitfox->lblCreate     = '添加GitFox伺服器';
$lang->gitfox->desc          = '描述';
$lang->gitfox->tokenFirst    = 'Token不為空時，優先使用Token。';
$lang->gitfox->tips          = '使用密碼時，請在GitFox全局安全設置中禁用"防止跨站點請求偽造"選項。';
$lang->gitfox->emptyError    = "不能為空";
$lang->gitfox->createSuccess = "創建成功";
$lang->gitfox->mustBindUser  = '您還未綁定GitFox用戶，請聯繫管理員進行綁定';
$lang->gitfox->noAccess      = '權限不足';
$lang->gitfox->notCompatible = '當前GitFox版本與禪道不兼容，請升級GitFox版本後重試';
$lang->gitfox->deleted       = '已刪除';

$lang->gitfox->placeholder = new stdclass;
$lang->gitfox->placeholder->name        = '';
$lang->gitfox->placeholder->url         = "請填寫GitFox Server首頁的訪問地址，如：https://gitfox.zentao.net。";
$lang->gitfox->placeholder->token       = "請填寫具有root權限賬戶的access token";
$lang->gitfox->placeholder->projectPath = "項目標識串只能包含字母、數字、“_”、“-”和“.”。不能以“-”開頭，以.git或者.atom結尾";

$lang->gitfox->noImportableIssues = "目前沒有可供導入的issue。";
$lang->gitfox->tokenError         = "當前token非root權限。";
$lang->gitfox->tokenLimit         = "GitFox Token權限不足。請更換為有root權限的GitFox Token。";
$lang->gitfox->hostError          = "當前GitFox伺服器地址無效或當前GitFox版本與禪道不兼容，請確認當前伺服器可被訪問或聯繫管理員升級GitFox至%s及以上版本後重試";
$lang->gitfox->bindUserError      = "不能重複綁定用戶 %s";
$lang->gitfox->importIssueError   = "未選擇該issue所屬的執行。";
$lang->gitfox->importIssueWarn    = "存在導入失敗的issue，可再次嘗試導入。";

$lang->gitfox->accessLevels[10] = 'Guest';
$lang->gitfox->accessLevels[20] = 'Reporter';
$lang->gitfox->accessLevels[30] = 'Developer';
$lang->gitfox->accessLevels[40] = 'Maintainer';
$lang->gitfox->accessLevels[50] = 'Owner';

$lang->gitfox->apiError[0]  = 'internal is not allowed in a private group.';
$lang->gitfox->apiError[1]  = 'public is not allowed in a private group.';
$lang->gitfox->apiError[2]  = 'is too short (minimum is 8 characters)';
$lang->gitfox->apiError[3]  = "can contain only letters, digits, '_', '-' and '.'. Cannot start with '-', end in '.git' or end in '.atom'";
$lang->gitfox->apiError[4]  = 'Branch already exists';
$lang->gitfox->apiError[5]  = 'Failed to save group {:path=>["has already been taken"]}';
$lang->gitfox->apiError[6]  = 'Failed to save group {:path=>["已經被使用"]}';
$lang->gitfox->apiError[7]  = '403 Forbidden';
$lang->gitfox->apiError[8]  = 'is invalid';
$lang->gitfox->apiError[9]  = 'admin is a reserved name';
$lang->gitfox->apiError[10] = 'has already been taken';
$lang->gitfox->apiError[11] = 'Missing CI config file';

$lang->gitfox->errorLang[0]  = '私有分組的項目，可見性級別不能設為內部。';
$lang->gitfox->errorLang[1]  = '私有分組的項目，可見性級別不能設為公開。';
$lang->gitfox->errorLang[2]  = '密碼太短（最少8個字元）';
$lang->gitfox->errorLang[3]  = "只能包含字母、數字、'.'-'和'.'。不能以'-'開頭、以'.git'結尾或以'.atom'結尾。";
$lang->gitfox->errorLang[4]  = '分支名已存在。';
$lang->gitfox->errorLang[5]  = '保存失敗，群組URL路徑已經被使用。';
$lang->gitfox->errorLang[6]  = '保存失敗，群組URL路徑已經被使用。';
$lang->gitfox->errorLang[7]  = $lang->gitfox->noAccess;
$lang->gitfox->errorLang[8]  = '格式錯誤';
$lang->gitfox->errorLang[9]  = 'admin是保留名';
$lang->gitfox->errorLang[10] = 'GitFox項目已存在';
$lang->gitfox->errorLang[11] = '缺少CI配置檔案';

$lang->gitfox->errorResonse['Email has already been taken']    = '郵箱已存在';
$lang->gitfox->errorResonse['Username has already been taken'] = '用戶名已存在';

$lang->gitfox->featureBar['binduser']['all']     = $lang->gitfox->all;
$lang->gitfox->featureBar['binduser']['notBind'] = $lang->gitfox->notBind;
$lang->gitfox->featureBar['binduser']['binded']  = $lang->gitfox->binded;

$lang->gitfox->devopsIntroduction = '禪道DevOps解決方案：全面重構，智領未來';
$lang->gitfox->devopsDescription  = <<<EOD
<p class="leading-relaxed mb-2 font-bold">
  DevOps 4.0底層能力由GitFox引擎提供。GitFox 是一款純自研的，專注于企業研發協同的Git原始碼管理平台 ，提供從代碼託管、流水綫構建，到質量掃瞄、製品管理的一站式能力，旨在幫助企業高效CI&CD。
</p>
EOD;

$lang->gitfox->installGitFox    = '安裝 GitFox引擎';
$lang->gitfox->installGitFoxTip = '使用禪道DevOps前您需要安裝GitFox，請在宿主機內執行下列安裝腳本進行安裝，腳本執行完成後，點擊“我已完成安裝”。';
$lang->gitfox->checkInstall     = '我已完成上述安裝步驟';
$lang->gitfox->execScript       = '執行安裝腳本';
$lang->gitfox->copySuccess      = '複製成功';
$lang->gitfox->copyFail         = '瀏覽器不支持複製功能，請手動複製';
$lang->gitfox->startUse         = '開始使用';
$lang->gitfox->completedInstall = '我已完成安裝';
$lang->gitfox->InstallScript    = '安裝腳本';
