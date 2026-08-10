<?php
global $config;

$lang->repo->common          = '代碼庫';
$lang->repo->repo            = '代碼庫';
$lang->repo->codeRepo        = '倉庫名稱';
$lang->repo->browse          = '瀏覽';
$lang->repo->viewRevision    = '查看修訂';
$lang->repo->product         = '關聯' . $lang->productCommon;
$lang->repo->projects        = '相關' . $lang->projectCommon;
$lang->repo->execution       = '所屬' . $lang->execution->common;
$lang->repo->create          = '創建';
$lang->repo->maintain        = '代碼庫列表';
$lang->repo->edit            = '編輯';
$lang->repo->delete          = '刪除代碼庫';
$lang->repo->showSyncCommit  = '顯示同步進度';
$lang->repo->ajaxSyncCommit  = '介面：AJAX同步註釋';
$lang->repo->setRules        = '指令配置';
$lang->repo->download        = '下載';

$lang->repo->mirror = new stdclass();
$lang->repo->mirror->syncing             = '代碼同步中...';
$lang->repo->mirror->refreshSync         = '刷新同步狀態';
$lang->repo->mirror->lastUpdated         = '最後更新于：';
$lang->repo->mirror->failedTitle         = '代碼同步失敗';
$lang->repo->mirror->detail              = '查看詳情';
$lang->repo->mirror->syncCode            = '同步代碼庫';
$lang->repo->mirror->syncTriggered       = '同步任務已觸發';
$lang->repo->mirror->syncFailed          = '同步失敗';
$lang->repo->mirror->syncRequestFailed   = '同步請求失敗';
$lang->repo->mirror->queryFailed         = '查詢失敗';
$lang->repo->mirror->queryRequestFailed  = '查詢請求失敗';
$lang->repo->mirror->statusUpdated       = '同步狀態已更新';
$lang->repo->mirror->stillRunning        = '仍在同步中...';
$lang->repo->mirror->done                = '同步已完成';
$lang->repo->mirror->failureTitle        = '代碼同步失敗原因';
$lang->repo->mirror->noDetail            = '暫無詳情';

$lang->repo->downloadDiff    = '下載Diff';
$lang->repo->addBug          = '添加評審';
$lang->repo->editBug         = '編輯評審';
$lang->repo->deleteBug       = '刪除評審';
$lang->repo->addComment      = '添加備註';
$lang->repo->editComment     = '編輯備註';
$lang->repo->deleteComment   = '刪除備註';
$lang->repo->encrypt         = '加密方式';
$lang->repo->addWebHook      = '添加Webhook';
$lang->repo->apiGetRepoByUrl = '介面：通過URL獲取代碼庫';
$lang->repo->blameTmpl       = '第 <strong>%line</strong> 行代碼相關信息： %name 于 %time 提交 %version %comment';
$lang->repo->notRelated      = '暫時沒有關聯禪道對象';
$lang->repo->source          = '基準';
$lang->repo->target          = '對比';
$lang->repo->descPlaceholder = '一句話描述';
$lang->repo->namespace       = '命名空間';
$lang->repo->branchName      = '分支名稱';
$lang->repo->branchFrom      = '創建自';
$lang->repo->codeBranch      = '代碼分支';
$lang->repo->createdBranch   = '已創建分支';
$lang->repo->unlink          = '解除關聯';
$lang->repo->visit           = '訪問';
$lang->repo->space           = '所屬空間';
$lang->repo->allSpace        = '全部空間';
$lang->repo->members         = '成員';
$lang->repo->sshManager      = 'SSH密鑰管理';
$lang->repo->defaultArtifact = '預設製品庫';
$lang->repo->origin          = '來源';
$lang->repo->originRepo      = '原始碼庫';
$lang->repo->provider        = '伺服器';
$lang->repo->providerID      = '伺服器';
$lang->repo->organize        = '組織';
$lang->repo->targetRepo      = '目標代碼庫';
$lang->repo->afterImport     = '導入後';
$lang->repo->repoPath        = '代碼庫地址';
$lang->repo->slug            = '代碼庫地址';
$lang->repo->tips            = '提示';

$lang->repo->createBranchAction = '創建分支';
$lang->repo->createTagAction    = '創建標籤';
$lang->repo->browseAction       = '瀏覽代碼庫';
$lang->repo->createAction       = '導入代碼庫';
$lang->repo->editAction         = '編輯代碼庫';
$lang->repo->diffAction         = '對比代碼';
$lang->repo->downloadAction     = '下載代碼庫檔案';
$lang->repo->revisionAction     = '查看提交詳情';
$lang->repo->blameAction        = '代碼追溯';
$lang->repo->reviewAction       = '代碼問題列表';
$lang->repo->downloadCode       = '下載代碼';
$lang->repo->downloadZip        = '下載壓縮包';
$lang->repo->sshClone           = '使用SSH克隆';
$lang->repo->httpClone          = '使用HTTP克隆';
$lang->repo->cloneUrl           = '克隆地址';
$lang->repo->linkTask           = '關聯任務';
$lang->repo->unlinkedTasks      = '未關聯任務';
$lang->repo->importAction       = '批量導入代碼庫';
$lang->repo->import             = '導入代碼庫';
$lang->repo->importName         = '導入後的名稱';
$lang->repo->importServer       = '請選擇伺服器';
$lang->repo->hide               = '隱藏';
$lang->repo->show               = '顯示';
$lang->repo->showHidden         = '顯示隱藏的代碼庫';
$lang->repo->gitlabList         = 'Gitlab代碼庫';
$lang->repo->batchCreate        = '批量導入代碼庫';
$lang->repo->browseTag          = '查看標籤列表';
$lang->repo->browseBranch       = '查看分支列表';
$lang->repo->showImportProgress = '顯示導入進度';
$lang->repo->showImportResult   = '顯示導入結果';

$lang->repo->createRepoAction = '創建代碼庫';

$lang->repo->submit     = '提交';
$lang->repo->cancel     = '取消';
$lang->repo->addComment = '添加評論';
$lang->repo->addIssue   = '提問題';
$lang->repo->compare    = '比較';

$lang->repo->copy     = '點擊複製';
$lang->repo->copied   = '複製成功';
$lang->repo->module   = '模組';
$lang->repo->type     = '類型';
$lang->repo->assign   = '指派';
$lang->repo->title    = '標題';
$lang->repo->detile   = '詳情';
$lang->repo->lines    = '代碼行';
$lang->repo->line     = '行';
$lang->repo->expand   = '點擊展開';
$lang->repo->collapse = '點擊摺疊';

$lang->repo->id                 = 'ID';
$lang->repo->SCM                = '類型';
$lang->repo->name               = '名稱';
$lang->repo->identifier         = '名稱';
$lang->repo->path               = '地址';
$lang->repo->prefix             = '地址擴展';
$lang->repo->config             = '配置目錄';
$lang->repo->desc               = '描述';
$lang->repo->account            = '用戶名';
$lang->repo->password           = '密碼';
$lang->repo->encoding           = '編碼';
$lang->repo->client             = '客戶端';
$lang->repo->size               = '大小';
$lang->repo->revision           = '提交';
$lang->repo->revisionA          = '提交';
$lang->repo->revisions          = '提交';
$lang->repo->time               = '提交時間';
$lang->repo->committer          = '提交人';
$lang->repo->commits            = '提交數';
$lang->repo->synced             = '初始化同步';
$lang->repo->lastSync           = '最後同步時間';
$lang->repo->deleted            = '已刪除';
$lang->repo->commit             = '提交';
$lang->repo->comment            = '註釋';
$lang->repo->view               = '查看檔案';
$lang->repo->viewA              = '查看';
$lang->repo->log                = '提交歷史';
$lang->repo->commitList         = '查看提交列表';
$lang->repo->blame              = '追溯';
$lang->repo->date               = '日期';
$lang->repo->diff               = '比較差異';
$lang->repo->diffAB             = '比較';
$lang->repo->diffAll            = '全部比較';
$lang->repo->viewDiff           = '查看差異';
$lang->repo->allLog             = '提交記錄';
$lang->repo->codeLocation       = '代碼位置';
$lang->repo->action             = '操作';
$lang->repo->code               = '代碼';
$lang->repo->review             = '評審';
$lang->repo->acl                = '訪問控制';
$lang->repo->group              = '分組';
$lang->repo->user               = '用戶';
$lang->repo->info               = '提交信息';
$lang->repo->job                = '構建任務';
$lang->repo->fileServerUrl      = '預合併後上傳伺服器目錄';
$lang->repo->fileServerAccount  = '檔案伺服器登錄用戶名';
$lang->repo->fileServerPassword = '檔案伺服器登錄密碼';
$lang->repo->linkStory          = '關聯' . $lang->SRCommon;
$lang->repo->linkBug            = '關聯Bug';
$lang->repo->linkTask           = '關聯任務';
$lang->repo->unlink             = '取消關聯';
$lang->repo->viewBugs           = '查看Bug';
$lang->repo->lastSubmitTime     = '最後提交時間';
$lang->repo->lastCommitter      = '提交人';
$lang->repo->lastUpdateTime     = '最後修改時間';
$lang->repo->createdBy          = '創建人';
$lang->repo->sourceCommit       = '來源提交';
$lang->repo->relations          = '相關';
$lang->repo->story              = '需求';
$lang->repo->searchTips         = '按%s搜索';
$lang->repo->design             = '設計';
$lang->repo->bug                = 'Bug';
$lang->repo->task               = '任務';

$lang->repo->title      = '標題';
$lang->repo->status     = '狀態';
$lang->repo->openedBy   = '創建者';
$lang->repo->assignedTo = '指派給';
$lang->repo->openedDate = '創建日期';

$lang->repo->actionInfo     = "由%s在%s添加";
$lang->repo->changes        = "修改記錄";
$lang->repo->reviewLocation = "%s@%s，%s行 - %s行";
$lang->repo->commentEdit    = '<i class="icon-pencil"></i>';
$lang->repo->commentDelete  = '<i class="icon-remove"></i>';
$lang->repo->allChanges     = "其他改動";
$lang->repo->commitTitle    = "第%s次提交";
$lang->repo->mark           = "開始標記";
$lang->repo->split          = "多ID間隔";

$lang->repo->objectRule   = '對象匹配規則';
$lang->repo->objectIdRule = '對象ID匹配規則';
$lang->repo->actionRule   = '動作匹配規則';
$lang->repo->manHourRule  = '工時匹配規則';
$lang->repo->ruleUnit     = "單位";
$lang->repo->ruleSplit    = "多關鍵字用';'分割，如：任務多關鍵字： Task;任務";

$lang->repo->viewDiffList['inline'] = '直列';
$lang->repo->viewDiffList['appose'] = '並排';

$lang->repo->encryptList['plain']  = '不加密';
$lang->repo->encryptList['base64'] = 'BASE64';

$lang->repo->logStyles['A'] = '添加';
$lang->repo->logStyles['M'] = '修改';
$lang->repo->logStyles['D'] = '刪除';

$lang->repo->encodingList['utf_8'] = 'UTF-8';
$lang->repo->encodingList['gbk']   = 'GBK';

$lang->repo->scmList['Gitlab'] = 'GitLab';
if(!$config->inQuickon && !$config->inCompose)
{
    $lang->repo->scmList['Gitea']      = 'Gitea';
    $lang->repo->scmList['Gogs']       = 'Gogs';
    $lang->repo->scmList['Git']        = '本地 Git';
    $lang->repo->scmList['Subversion'] = 'Subversion';
}

$lang->repo->aclList['open']    = '公開 (擁有代碼庫所屬空間訪問權限，即可訪問該代碼庫)';
$lang->repo->aclList['private'] = '私有 (僅代碼庫成員可訪問該代碼庫)';

$lang->repo->showAclList['open']    = '公開';
$lang->repo->showAclList['private'] = '私有';

$lang->repo->gitlabHost    = 'GitLab Server';
$lang->repo->gitlabToken   = 'GitLab Token';
$lang->repo->gitlabProject = 'GitLab 項目';

$lang->repo->serviceHost    = '伺服器';
$lang->repo->serviceProject = '倉庫';

$lang->repo->placeholder = new stdclass;
$lang->repo->placeholder->gitlabHost = '請填寫GitLab訪問地址';

$lang->repo->notice                   = new stdclass();
$lang->repo->notice->syncing          = '正在同步中, 請稍等...';
$lang->repo->notice->syncComplete     = '同步完成，正在跳轉...';
$lang->repo->notice->syncFailed       = '同步失敗';
$lang->repo->notice->syncedCount      = '已經同步記錄條數';
$lang->repo->notice->delete           = '是否解除關聯代碼庫？';
$lang->repo->notice->deleteConfirm    = '是否刪除代碼庫？此操作將永久移除該倉庫及其所有內容和歷史記錄，且無法恢復。';
$lang->repo->notice->successDelete    = '已經成功解除代碼庫。';
$lang->repo->notice->commentContent   = '輸入評論內容';
$lang->repo->notice->deleteReview     = '確認刪除該評審？';
$lang->repo->notice->deleteBug        = '確認刪除該Bug？';
$lang->repo->notice->deleteComment    = '確認刪除該回覆？';
$lang->repo->notice->lastSyncTime     = '最後更新于：';
$lang->repo->notice->unlinkBranch     = '確認解除分支與%s的關聯關係嗎？';
$lang->repo->notice->noRepoLeft       = '該伺服器下的所有代碼庫都已經關聯到禪道了，請選擇其他伺服器。';
$lang->repo->notice->noChanges        = '沒有代碼差異';
$lang->repo->notice->storyNotActive   = '需求不是激活狀態，不能創建分支。';
$lang->repo->notice->taskNotActive    = '任務不是未開始或進行中狀態，不能創建分支。';
$lang->repo->notice->bugNotActive     = 'Bug不是激活狀態，不能創建分支。';

$lang->repo->rules = new stdclass();
$lang->repo->rules->exampleLabel = "註釋示例";
$lang->repo->rules->example['task']['start']  = "%start% %task% %id%1%split%2 %cost%%consumedmark%1%cunit% %left%%leftmark%3%lunit%";
$lang->repo->rules->example['task']['finish'] = "%finish% %task% %id%1%split%2 %cost%%consumedmark%10%cunit%";
$lang->repo->rules->example['task']['effort'] = "%effort% %task% %id%1%split%2 %cost%%consumedmark%1%cunit% %left%%leftmark%3%lunit%";
$lang->repo->rules->example['bug']['resolve'] = "%resolve% %bug% %id%1%split%2";

$lang->repo->error = new stdclass();
$lang->repo->error->useless           = '你的伺服器禁用了exec,shell_exec方法，無法使用該功能';
$lang->repo->error->connect           = '連接代碼庫失敗，請填寫正確的用戶名、密碼和代碼庫地址！';
$lang->repo->error->version           = "https和svn協議需要1.8及以上版本的客戶端，請升級到最新版本！詳情訪問:http://subversion.apache.org/";
$lang->repo->error->path              = '代碼庫地址直接填寫檔案路徑，如：/home/test。';
$lang->repo->error->cmd               = '客戶端錯誤！';
$lang->repo->error->diff              = '必須選擇兩個提交';
$lang->repo->error->safe              = "因為安全原因，需要檢測客戶端版本，請將版本號寫入檔案 %s \n 可以執行命令：%s";
$lang->repo->error->product           = "請選擇{$lang->productCommon}！";
$lang->repo->error->commentText       = '請填寫評審內容';
$lang->repo->error->comment           = '請填寫內容';
$lang->repo->error->title             = '請填寫標題';
$lang->repo->error->accessDenied      = '你沒有權限訪問該代碼庫';
$lang->repo->error->noFound           = '你訪問的代碼庫不存在';
$lang->repo->error->empty             = '代碼庫內容為空，無法同步';
$lang->repo->error->noFile            = '目錄 %s 不存在或沒有權限訪問';
$lang->repo->error->noPriv            = '程序沒有權限切換到目錄 %s';
$lang->repo->error->output            = "執行命令：%s\n錯誤結果(%s)： %s\n";
$lang->repo->error->clientVersion     = "客戶端版本過低，請升級或更換SVN客戶端";
$lang->repo->error->encoding          = "編碼可能錯誤，請更換編碼重試。";
$lang->repo->error->deleted           = "解除失敗，提交記錄與設計( %s )關聯。<br/>";
$lang->repo->error->linkedBranch      = "解除失敗，代碼庫與%s分支( %s )關聯。<br/>";
$lang->repo->error->linkedJob         = "解除失敗，代碼庫與流水綫( %s )關聯。<br/>";
$lang->repo->error->linkedArtifact    = "解除失敗，代碼庫與製品庫( %s )關聯。<br/>";
$lang->repo->error->clientPath        = "客戶端安裝目錄不能有空格和特殊字元！";
$lang->repo->error->notFound          = "代碼庫『%s』路徑 %s 不存在，請確認此代碼庫是否已在本地伺服器被刪除";
$lang->repo->error->noWritable        = '%s 不可寫！請檢查該目錄權限，否則無法下載。';
$lang->repo->error->noCloneAddr       = '該項目克隆地址未找到';
$lang->repo->error->differentVersions = '基準和對比不能一樣';
$lang->repo->error->needTwoVersion    = '必須選擇兩個分支/標籤';
$lang->repo->error->projectUnique     = $lang->repo->serviceProject . '已經有這條記錄了。如果您確定該記錄已刪除，請到後台-系統設置-資源回收筒還原。';
$lang->repo->error->repoNameInvalid   = '名稱必須以字母或 _ 開頭，只包含字母數字，連接符，下劃線和點。';
$lang->repo->error->createdFail       = '創建失敗';
$lang->repo->error->branchNameTooLong = '分支名稱不能超過30個字元';
$lang->repo->error->noProduct         = '在開始導入代碼庫之前，請先關聯產品。';
$lang->repo->error->emptyVersion      = '版本不能為空';
$lang->repo->error->versionError      = '版本格式錯誤！';

$lang->repo->syncTips          = '請參照<a target="_blank" href="https://www.zentao.net/book/zentaopmshelp/207.html">這裡</a>，設置代碼庫定時同步。';
$lang->repo->encodingsTips     = "提交日誌的編碼，可以用逗號連接起來的多個，比如utf-8。";
$lang->repo->pathTipsForGitlab = "GitLab 項目URL";

$lang->repo->example              = new stdclass();
$lang->repo->example->client      = new stdclass();
$lang->repo->example->path        = new stdclass();
$lang->repo->example->client->git = "例如：/usr/bin/git";
$lang->repo->example->client->svn = "例如：/usr/bin/svn";
$lang->repo->example->path->git   = "例如：/home/user/myproject";
$lang->repo->example->path->svn   = "例如：http://example.googlecode.com/svn/trunk/myproject";
$lang->repo->example->config      = "https需要填寫配置目錄的位置，通過config-dir選項生成配置目錄";
$lang->repo->example->encoding    = "填寫代碼庫中檔案的編碼";

$lang->repo->typeList['standard']    = '規範';
$lang->repo->typeList['performance'] = '性能';
$lang->repo->typeList['security']    = '安全';
$lang->repo->typeList['redundancy']  = '冗餘';
$lang->repo->typeList['logicError']  = '邏輯錯誤';

$lang->repo->featureBar['maintain']['all'] = '全部';

$lang->repo->errorLang[0] = "只能包含字母、數字、'.'-'和'.'。不能以'-'開頭、以'.git'結尾或以'.atom'結尾。";
$lang->repo->errorLang[1] = '分支名已存在。';
$lang->repo->errorLang[2] = '分支名已存在。';
$lang->repo->errorLang[3] = '權限不足。';
$lang->repo->errorLang[4] = "分支名不能包含 ' ', '~', '^'或':'。";
$lang->repo->errorLang[5] = '分支創建失敗';
$lang->repo->errorLang[6] = '權限不足。';

$lang->repo->apiError[0] = "can contain only letters, digits, '_', '-' and '.'. Cannot start with '-', end in '.git' or end in '.atom'";
$lang->repo->apiError[1] = 'Branch is exists';
$lang->repo->apiError[2] = 'branch.* already exists';
$lang->repo->apiError[3] = 'Forbidden';
$lang->repo->apiError[4] = 'cannot have ASCII control characters';
$lang->repo->apiError[5] = 'Created fail';
$lang->repo->apiError[6] = 'Project Not Found';

$lang->repo->branchType            = '分支類型';
$lang->repo->applicableBranchTypes = '適用分支類型';
$lang->repo->allBranchTypes        = '全部分支類型';

$lang->repo->branchRuleMode = array();
$lang->repo->branchRuleMode['inheritance']  = '繼承';
$lang->repo->branchRuleMode['redefinition'] = '重定義';

$lang->repo->branchTypeRule = new stdClass();
$lang->repo->branchTypeRule->allowCreatedBy     = '允許哪些用戶可以創建該類型分支';
$lang->repo->branchTypeRule->allowDeletedBy     = '允許哪些用戶可以刪除該類型分支';
$lang->repo->branchTypeRule->allowUpdatedBy     = '允許哪些用戶可以更新該類型分支';
$lang->repo->branchTypeRule->allowForcePushedBy = '允許哪些用戶可以強制進行推送';
$lang->repo->branchTypeRule->allowMergeFrom     = '允許哪些分支類型合併到該分支類型';
$lang->repo->branchTypeRule->allowMergeTo       = '允許合併到哪些分支類型';

$lang->repo->branchTypeRule->userOptionList = array();
$lang->repo->branchTypeRule->userOptionList['hasPriv'] = '有權限的用戶均可';
$lang->repo->branchTypeRule->userOptionList['specify'] = '僅指定人員';

$lang->repo->branchTypeRule->branchTypeOptionList = array();
$lang->repo->branchTypeRule->branchTypeOptionList['all']     = '全部分支';
$lang->repo->branchTypeRule->branchTypeOptionList['specify'] = '指定分支類型';

$lang->repo->branchRule = new stdClass();
$lang->repo->branchRule->allowDeletedBy     = '允許哪些用戶可以刪除該分支';
$lang->repo->branchRule->allowUpdatedBy     = '允許哪些用戶可以更新該分支';
$lang->repo->branchRule->allowForcePushedBy = '允許哪些用戶可以強制進行推送';
$lang->repo->branchRule->allowMergeFrom     = '允許哪些分支類型合併到該分支';
$lang->repo->branchRule->allowMergeTo       = '允許合併到哪些分支類型';
$lang->repo->branchRule->delete             = '刪除分支規則';
$lang->repo->branchRule->mode               = '規則控制';

$lang->repo->branchRule->userOptionList = array();
$lang->repo->branchRule->userOptionList['hasPriv'] = '有權限的用戶均可';
$lang->repo->branchRule->userOptionList['specify'] = '僅指定人員';

$lang->repo->branchRule->branchTypeOptionList = array();
$lang->repo->branchRule->branchTypeOptionList['all']     = '全部分支';
$lang->repo->branchRule->branchTypeOptionList['specify'] = '指定分支類型';

$lang->repo->select            = '請選擇...';
$lang->repo->searchPlaceholder = '按Git版本篩選';
$lang->repo->svnPlaceholder    = '請輸入版本號';
$lang->repo->changeFile        = '改動檔案';

$lang->repo->commitInfo   = '代碼改動詳情';
$lang->repo->linkedStory  = "相關需求";
$lang->repo->linkedTask   = "相關任務";
$lang->repo->linkedBug    = "相關Bug";
$lang->repo->commited     = "提交了";
$lang->repo->commentary   = "評論";
$lang->repo->issueTitle   = "問題標題";
$lang->repo->issueDesc    = "詳請";
$lang->repo->dateTmpl     = "于 %s 提出";
$lang->repo->commentNum   = " 條評論";

$lang->repo->fileTotal  = '%d個檔案';
$lang->repo->codeSurvey = '發生改動：總共<span class="add-cot">添加%d行</span>代碼，<span class="delete-cot">刪除%d行</span>代碼';

$lang->repo->featureBar['review']['all']          = '全部';
$lang->repo->featureBar['review']['assigntome']   = '指派給我';
$lang->repo->featureBar['review']['openedbyme']   = '由我創建';
$lang->repo->featureBar['review']['resolvedbyme'] = '由我解決';
$lang->repo->featureBar['review']['assigntonull'] = '未指派';
$lang->repo->featureBar['review']['unresolved']   = '未解決';
$lang->repo->featureBar['review']['unclosed']     = '未關閉';

$lang->repo->browseSystem = '應用列表';

$lang->repo->system = new stdclass();
$lang->repo->system->product       = '所屬產品';
$lang->repo->system->name          = '應用名稱';
$lang->repo->system->latestRelease = '最新版本';
$lang->repo->system->deployStatus  = '最新版本狀態';
$lang->repo->system->status        = '應用狀態';

$lang->repo->remark              = "註釋";
$lang->repo->codeTag             = '代碼標籤';
$lang->repo->tagName             = '標籤名稱';
$lang->repo->tagFrom             = '創建自';
$lang->repo->createTag           = '創建標籤';
$lang->repo->deleteTag           = '刪除標籤';
$lang->repo->confirmTagDelete    = '您確定要刪除此標籤嗎？';
$lang->repo->createBranch        = '創建分支';
$lang->repo->deleteBranch        = '刪除分支';
$lang->repo->confirmBranchDelete = '您確定要刪除此分支嗎？';
$lang->repo->deleteDefaultBranch = '預設分支不能刪除';
$lang->repo->divergence          = '落後|領先';
$lang->repo->ahead               = '領先';
$lang->repo->behind              = '落後';
$lang->repo->noDivergence        = '沒有差異';
$lang->repo->noDivergenceOnHint  = '與%s分支沒有差異';
$lang->repo->divergenceOnBranch  = '比%s分支';
$lang->repo->aheadHint           = '領先%s次提交';
$lang->repo->behindHint          = '落後%s次提交';
$lang->repo->default             = '預設';
$lang->repo->defaultBranch       = '預設分支';
$lang->repo->committerTip        = '提交人具有代碼庫的寫入權限';
$lang->repo->commitDetail        = '%s 提交時間：%s，提交人：%s';
$lang->repo->hasNoProduct        = '當前項目或者執行沒有關聯產品';
$lang->repo->failCreateWebhook   = '創建Webhook失敗';

$lang->repo->browseWebhooks     = 'Webhook列表';
$lang->repo->createWebhook      = '創建Webhook';
$lang->repo->editWebhook        = '編輯Webhook';
$lang->repo->logWebhook         = 'Webhook日誌';
$lang->repo->viewWebhookRequest = '請求數據';
$lang->repo->deleteWebhook      = '刪除Webhook';
$lang->repo->targetURL          = '目標URL';
$lang->repo->latestStatus       = '最近狀態';
$lang->repo->enable             = '啟用';
$lang->repo->disable            = '關閉';
$lang->repo->enableWebhook      = '啟用/關閉Webhook';
$lang->repo->deleteWebhook      = '刪除Webhook';

$lang->repo->webhook = new stdclass();
$lang->repo->webhook->statusList = array();
$lang->repo->webhook->statusList['enabled']  = '啟用';
$lang->repo->webhook->statusList['disabled'] = '關閉';

$lang->repo->webhook->latestStatusList = array();
$lang->repo->webhook->latestStatusList['success'] = '成功';
$lang->repo->webhook->latestStatusList['fail']    = '失敗';
$lang->repo->webhook->latestStatusList['pending'] = '未發送';

$lang->repo->webhook->logStatusList = array();
$lang->repo->webhook->logStatusList['success'] = '成功';
$lang->repo->webhook->logStatusList['fail']    = '失敗';

$lang->repo->webhook->key                  = '密鑰';
$lang->repo->webhook->desc                 = '描述';
$lang->repo->webhook->SSL                  = '啟用 SSL 驗證';
$lang->repo->webhook->triggerEvent         = '觸發事件';
$lang->repo->webhook->customEvent          = '自定義事件';
$lang->repo->webhook->urlError             = '目標URL格式不正確';
$lang->repo->webhook->customEventError     = '自定義事件不能為空';
$lang->repo->webhook->nameExists           = '名稱為%s的Webhook已經存在';
$lang->repo->webhook->defaultShowSecret    = '******';
$lang->repo->webhook->enabledSuccess       = '啟用成功';
$lang->repo->webhook->disabledSuccess      = '關閉成功';
$lang->repo->webhook->enabledFail          = '啟用失敗';
$lang->repo->webhook->disabledFail         = '關閉失敗';
$lang->repo->webhook->requestData          = '請求數據';
$lang->repo->webhook->requestDate          = '請求時間';
$lang->repo->webhook->triggerType          = '觸發類型';
$lang->repo->webhook->requestURL           = '請求地址';
$lang->repo->webhook->requestHeaders       = '請求頭';
$lang->repo->webhook->requestBody          = '請求數據';
$lang->repo->webhook->responseHeaders      = '響應頭';
$lang->repo->webhook->responseBody         = '響應數據';
$lang->repo->webhook->emptyData            = '無數據';
$lang->repo->webhook->deleteSuccess        = '刪除成功';
$lang->repo->webhook->confirmWebhookDelete = "確定要刪除 '%s' 嗎，刪除後不可恢復";
$lang->repo->webhook->lengthError          = "『%s』長度應當不超過『%s』";
$lang->repo->webhook->deleteFail           = 'Webhook已經有觸發記錄，不允許刪除';

$lang->repo->webhook->triggerEventList = array();
$lang->repo->webhook->triggerEventList[0] = '發送所有事件';
$lang->repo->webhook->triggerEventList[1] = '自定義事件';

$lang->repo->webhook->customEventList = array();
$lang->repo->webhook->customEventList['branch_created']           = '分支創建';
$lang->repo->webhook->customEventList['branch_updated']           = '分支更新';
$lang->repo->webhook->customEventList['branch_deleted']           = '分支刪除';
$lang->repo->webhook->customEventList['tag_created']              = '標籤創建';
$lang->repo->webhook->customEventList['tag_deleted']              = '標籤刪除';
$lang->repo->webhook->customEventList['pullreq_created']          = '創建評審請求';
$lang->repo->webhook->customEventList['pullreq_reopened']         = '重新打開評審請求';
$lang->repo->webhook->customEventList['pullreq_branch_updated']   = '更新評審請求分支';
$lang->repo->webhook->customEventList['pullreq_closed']           = '關閉評審請求';
$lang->repo->webhook->customEventList['pullreq_merged']           = '合併評審請求';

$lang->repo->sourceList = array();
$lang->repo->sourceList['GitLab']     = 'GitLab';
$lang->repo->sourceList['Gitea']      = 'Gitea';
$lang->repo->sourceList['Gogs']       = 'Gogs';
$lang->repo->sourceList['Subversion'] = 'Subversion';

$lang->repo->accessList = array();
$lang->repo->accessList['writable'] = '可讀、可寫、可管理';
$lang->repo->accessList['readonly'] = '只讀（做鏡像導入，在第三方代碼庫進行管理，由DevOps定期自動同步）';

$lang->repo->importProgress = new stdclass();
$lang->repo->importProgress->title        = '正在導入代碼庫...';
$lang->repo->importProgress->desc         = '正在將您的第三方代碼庫導入系統，請稍後，此過程可能需要幾分鐘。';
$lang->repo->importProgress->notice       = '請耐心等待數據導入完成，不要關閉本頁面。';
$lang->repo->importProgress->leaveTip     = '代碼庫正在導入中，請勿關閉頁面。頁面關閉後，將無法查看代碼庫導入進度。';
$lang->repo->importProgress->acknowledge  = '我知道了';
$lang->repo->importProgress->importFailed = '導入失敗';
$lang->repo->importProgress->failMessage  = '代碼庫導入失敗：%s';
$lang->repo->importProgress->successTips  = '代碼庫導入成功, 您現在可以進行以下操作:';
$lang->repo->importProgress->toRepoBrowse = '進入代碼庫';
$lang->repo->importProgress->toRepoList   = '返回代碼庫列表';
$lang->repo->importProgress->tryAgain     = '重新嘗試';
