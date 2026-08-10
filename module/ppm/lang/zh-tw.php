<?php
$lang->ppm->common            = "評審請求";
$lang->ppm->server            = "伺服器";
$lang->ppm->hostID            = "伺服器";
$lang->ppm->view              = "概況";
$lang->ppm->viewAction        = "{$lang->ppm->common}詳情";
$lang->ppm->create            = "提交合併請求";
$lang->ppm->mirrorRepoTip     = '當前代碼庫為鏡像代碼庫，將代碼庫重新導入為"可讀、可寫、可管理"的模式即可使用代碼評審功能。';
$lang->ppm->hasMirrorRepoTip = '當前已關聯代碼庫包含鏡像代碼庫，鏡像代碼庫無法使用代碼評審功能，不支持創建合併請求';
$lang->ppm->apiCreate         = "介面：創建{$lang->ppm->common}";
$lang->ppm->browse            = "瀏覽{$lang->ppm->common}";
$lang->ppm->browseAction      = "{$lang->ppm->common}列表";
$lang->ppm->list              = $lang->ppm->browse;
$lang->ppm->edit              = "編輯{$lang->ppm->common}";
$lang->ppm->delete            = "刪除{$lang->ppm->common}";
$lang->ppm->accept            = "合併請求";
$lang->ppm->source            = '源項目分支';
$lang->ppm->target            = '目標項目分支';
$lang->ppm->viewDiff          = '比對代碼';
$lang->ppm->diff              = '比對代碼';
$lang->ppm->viewInGit         = '在應用中查看';
$lang->ppm->link              = '關聯需求、Bug、任務';
$lang->ppm->createAction      = '%s, 由 <strong>%s</strong> 提交了 <a href="%s">合併請求</a>。';
$lang->ppm->editAction        = '%s, 由 <strong>%s</strong> 編輯了 <a href="%s">合併請求</a>。';
$lang->ppm->removeAction      = '%s, 由 <strong>%s</strong> 刪除了 <a href="%s">合併請求</a>。';
$lang->ppm->submitType        = '提交方式';
$lang->ppm->linkedObject      = '關聯項';
$lang->ppm->object            = '對象';
$lang->ppm->mergeInfo         = '合併概覽';
$lang->ppm->locateView        = '查看詳情';
$lang->ppm->codeConflict      = '代碼衝突檢查';
$lang->ppm->hasConflict       = '是否有代碼衝突';
$lang->ppm->request           = '要求';
$lang->ppm->AIReview          = 'AI評審';
$lang->ppm->AICodeScore       = '代碼評分';
$lang->ppm->AISevereIssue     = '高危問題';
$lang->ppm->AIOrdinaryIssue   = '一般問題';
$lang->ppm->manualReview      = '人工評審';
$lang->ppm->approvalReviewer  = '評審人數';
$lang->ppm->doneReviewer      = '已完成評審數量';
$lang->ppm->codeScan          = '代碼掃瞄';
$lang->ppm->scanSevereIssue   = '高危問題';
$lang->ppm->scanOrdinaryIssue = '一般問題';
$lang->ppm->scanPassRate      = '安全門禁通過率';
$lang->ppm->runResult         = '執行結果';
$lang->ppm->basicInfo         = '基本信息';
$lang->ppm->sourceBranch      = '源分支';
$lang->ppm->targetBranch      = '目標分支';
$lang->ppm->filePath          = '檔案路徑';
$lang->ppm->conflictFiles     = '衝突檔案';
$lang->ppm->changeFiles       = '變更的檔案';
$lang->ppm->issueList         = '問題清單';
$lang->ppm->add               = '添加';
$lang->ppm->addReviewer       = '添加評審人';
$lang->ppm->reviewStatus      = '審批狀態';
$lang->ppm->review            = '評審';
$lang->ppm->decision          = '評審結果';
$lang->ppm->opinion           = '評審意見';
$lang->ppm->merge             = '合併' . $lang->ppm->common;
$lang->ppm->assignedTo        = '指派給';

$lang->ppm->opinionPlaceholder = '請輸入評審意見';

$lang->ppm->action = new stdclass();
$lang->ppm->action->synced   = '$date, 由 <strong>$actor</strong> 同步了合併請求。';
$lang->ppm->action->imported = '$date, 由 <strong>$actor</strong> 導入了合併請求。';

$lang->ppm->linkList   = '瀏覽關聯需求、Bug、任務';
$lang->ppm->linkStory  = '關聯需求';
$lang->ppm->linkBug    = '關聯Bug';
$lang->ppm->linkTask   = '關聯任務';
$lang->ppm->unlinkTask = '移除任務';
$lang->ppm->unlink     = '取消關聯需求、Bug、任務';
$lang->ppm->addReview  = '添加評審';

$lang->ppm->id          = 'ID';
$lang->ppm->mriid       = "MR原始ID";
$lang->ppm->title       = '名稱';
$lang->ppm->status      = '狀態';
$lang->ppm->author      = '提交人';
$lang->ppm->createdDate = '提交時間';
$lang->ppm->assignee    = '指派給';
$lang->ppm->reviewer    = '評審人';
$lang->ppm->mergeStatus = '是否可合併';
$lang->ppm->commits     = '提交數';
$lang->ppm->changes     = '更改數';
$lang->ppm->gitlabID    = 'GitLab';
$lang->ppm->repoID      = '版本庫';
$lang->ppm->jobID       = '流水綫任務';
$lang->ppm->commitLogs  = '提交記錄';
$lang->ppm->execJob     = '執行';
$lang->ppm->execJobTip  = '手動執行流水綫任務';
$lang->ppm->repo        = '代碼庫';

$lang->ppm->canMerge  = "可合併";
$lang->ppm->cantMerge = "不可合併";

$lang->ppm->approval = '評審';
$lang->ppm->approve  = '通過';
$lang->ppm->reject   = '拒絶';
$lang->ppm->close    = '關閉' . $lang->ppm->common;
$lang->ppm->reopen   = '重新打開' . $lang->ppm->common;

$lang->ppm->reviewType     = '評審類型';
$lang->ppm->reviewTypeList = array();
$lang->ppm->reviewTypeList['bug']  = 'Bug';
$lang->ppm->reviewTypeList['task'] = '任務';

$lang->ppm->approvalResult     = '評審意見';
$lang->ppm->approvalResultList = array();
$lang->ppm->approvalResultList['approved'] = '通過';
$lang->ppm->approvalResultList['rejected'] = '拒絶';

$lang->ppm->needApproved       = '需要通過評審才能合併';
$lang->ppm->needCI             = '需要通過流水綫才能合併';
$lang->ppm->removeSourceBranch = '合併後刪除源分支';
$lang->ppm->squash             = '合併提交記錄';
$lang->ppm->triggeredCI        = '目標分支或流水綫變動，觸發流水綫執行。';
$lang->ppm->acceptTip          = '評審通過後才能合併';
$lang->ppm->conflictsTip       = '該合併請求存在衝突，無法評審通過';
$lang->ppm->noChangesTip       = '源分支與目標分支沒有變化，無法評審通過';
$lang->ppm->compileTip         = '該合併請求流水綫構建未成功，無法評審通過';
$lang->ppm->notifyTip          = '存在衝突或分支間沒有變化，無法評審通過';
$lang->ppm->branchUpdateTip    = '分支有更新，可執行流水綫';
$lang->ppm->draftTips          = '合併請求處于草稿狀態，不可合併。';

$lang->ppm->repeatedOperation = '請勿重複操作';

$lang->ppm->approvalStatus     = '審批流狀態';
$lang->ppm->approvalStatusList = array();
$lang->ppm->approvalStatusList['pending']    = '待評審';
$lang->ppm->approvalStatusList['inProgress'] = '評審中';
$lang->ppm->approvalStatusList['approved']   = '已通過';
$lang->ppm->approvalStatusList['rejected']   = '已拒絶';

$lang->ppm->notApproved  = '審核拒絶的';
$lang->ppm->assignedToMe = '指派給我';
$lang->ppm->createdByMe  = '由我創建';

$lang->ppm->statusList = array();
$lang->ppm->statusList['all']    = '全部';
$lang->ppm->statusList['opened'] = '開放中';
$lang->ppm->statusList['merged'] = '已合併';
$lang->ppm->statusList['closed'] = '已關閉';

$lang->ppm->mergeStatusList = array();
$lang->ppm->mergeStatusList['unchecked']            = '未檢查';
$lang->ppm->mergeStatusList['checking']             = '檢查中';
$lang->ppm->mergeStatusList['can_be_merged']        = '可合併';
$lang->ppm->mergeStatusList['cannot_be_merged']     = '不可合併';
$lang->ppm->mergeStatusList['cannot_merge_by_fail'] = '不可合併,檢查未通過';

$lang->ppm->description       = '描述';
$lang->ppm->confirmDelete     = '確認刪除該合併請求嗎？';
$lang->ppm->sourceProject     = '源倉庫';
$lang->ppm->sourceBranch      = '源分支';
$lang->ppm->targetProject     = '目標倉庫';
$lang->ppm->targetBranch      = '目標分支';
$lang->ppm->noCompileJob      = '沒有流水綫任務';
$lang->ppm->compileUnexecuted = '還未執行';
$lang->ppm->compileID         = '構建任務';
$lang->ppm->compileStatus     = '構建結果';

$lang->ppm->notFound          = "此{$lang->ppm->common}不存在。";
$lang->ppm->toCreatedMessage  = "您提交的合併請求：<a href='%s'>%s</a> 流水綫任務執行通過。";
$lang->ppm->toReviewerMessage = "有一個合併請求：<a href='%s'>%s</a> 待審核。";
$lang->ppm->failMessage       = "您提交的合併請求：<a href='%s'>%s</a> 流水綫任務執行失敗，查看執行結果。";
$lang->ppm->storySummary      = "本頁共 <strong>%s</strong> 個" . $lang->SRCommon;

$lang->ppm->apiError = new stdclass;
$lang->ppm->apiError->createMR      = "通過API創建合併請求失敗，失敗原因：%s";
$lang->ppm->apiError->sudo          = "無法以當前用戶綁定的GitLab賬戶進行操作，失敗原因：%s";
$lang->ppm->apiError->emptyResponse = "API請求的對象不存在或者API請求失敗。";
$lang->ppm->apiError->notFound      = "API請求的對象不存在，可能已被伺服器刪除。";

$lang->ppm->createFailedFromAPI  = "創建合併請求失敗。";
$lang->ppm->hasSameOpenedMR      = "存在重複並且未關閉的合併請求: ID%u";
$lang->ppm->accessGitlabFailed   = "當前無法連接到GitLab伺服器。";
$lang->ppm->reopenSuccess        = "已重新打開合併請求。";
$lang->ppm->closeSuccess         = "已關閉合併請求。";
$lang->ppm->unsupportedFeature   = "暫不支持該功能。";
$lang->ppm->checkSourceBranch    = '源分支允許合併到的目標分支類型：%s';
$lang->ppm->checkTargetBranch    = '目標分支允許合併的源分支類型：%s';
$lang->ppm->checkConflicts       = '檢測到代碼衝突，請先在本地解決衝突後再創建合併請求。';
$lang->ppm->checkReviewers       = '評審人必須包含%s';
$lang->ppm->sourceBranchNotExist = '源分支不存在';
$lang->ppm->targetBranchNotExist = '目標分支不存在';

$lang->ppm->apiErrorMap[1]  = "You can't use same project/branch for source and target";
$lang->ppm->apiErrorMap[2]  = "/Another open merge request already exists for this source branch: !([0-9]+)/";
$lang->ppm->apiErrorMap[3]  = "401 Unauthorized";
$lang->ppm->apiErrorMap[4]  = "403 Forbidden";
$lang->ppm->apiErrorMap[5]  = "/(pull request already exists for these targets).*/";
$lang->ppm->apiErrorMap[6]  = "Invalid PullRequest: There are no changes between the head and the base";
$lang->ppm->apiErrorMap[7]  = "/(user doesn't have access to repo).*/";
$lang->ppm->apiErrorMap[8]  = "/(git apply).*/";
$lang->ppm->apiErrorMap[9]  = "a pull request for this target and source branch already exists";
$lang->ppm->apiErrorMap[10] = 'Internal error occurred';
$lang->ppm->apiErrorMap[11] = "The source branch doesn't contain any new commits";

$lang->ppm->errorLang[1]  = '源項目分支與目標項目分支不能相同';
$lang->ppm->errorLang[2]  = '存在另外一個同樣的合併請求在源項目分支中: ID%u';
$lang->ppm->errorLang[3]  = '權限不足';
$lang->ppm->errorLang[4]  = '權限不足';
$lang->ppm->errorLang[5]  = '存在另外一個同樣的合併請求在源項目分支中';
$lang->ppm->errorLang[6]  = '源項目分支與目標項目分支不能相同';
$lang->ppm->errorLang[7]  = '您無權合併改版本庫';
$lang->ppm->errorLang[8]  = '當前源分支和目標分支無法合併';
$lang->ppm->errorLang[9]  = '已存在相同的合併請求';
$lang->ppm->errorLang[10] = '伺服器錯誤';
$lang->ppm->errorLang[11] = '源分支不包含任何新的提交';

$lang->ppm->from = "從";
$lang->ppm->to   = "合併到";
$lang->ppm->at   = "于";

$lang->ppm->pipeline         = "流水綫";
$lang->ppm->pipelineSuccess  = "已通過";
$lang->ppm->pipelineFailed   = "未通過";
$lang->ppm->pipelineCanceled = "已取消";
$lang->ppm->pipelineUnknown  = "未知";

$lang->ppm->pipelineStatus = array();
$lang->ppm->pipelineStatus['success']  = "成功";
$lang->ppm->pipelineStatus['failed']   = "失敗";
$lang->ppm->pipelineStatus['canceled'] = "取消";

$lang->ppm->MRHasConflicts = "是否存在衝突";
$lang->ppm->hasConflicts   = "代碼有衝突";
$lang->ppm->hasNoChanges   = "代碼無變動";
$lang->ppm->hasNoConflict  = "可以合併";
$lang->ppm->acceptMR       = "合併";
$lang->ppm->mergeFailed    = "無法合併，請核對合併請求狀態";
$lang->ppm->mergeSuccess   = "已成功合併";
$lang->ppm->refreshSuccess = '刷新成功';

$lang->ppm->todomessage = "項目中指派給你了";
$lang->ppm->squashHelp  = '對應git參數：--squash';

/**
 * Merge Command Document.
 *
 * %s source_project::http_url_to_repo
 * %s mr::source_branch
 * %s source_project::path_with_namespace . '-' . mr::source_branch
 * %s mr::target_branch
 * %s source_project::path_with_namespace . '-' . mr::source_branch
 * %s mr::target_branch
 */
$lang->ppm->commandDocument = <<< EOD
<div class='detail-title'>在本地檢出、審核和手動合併</div>
<div class='detail-content'>
  <p><blockquote>提示：您在本地合併完成後，該合併請求將自動更新為已合併狀態。</blockquote></p>
  <p>
    第 1 步. 切換到目標項目所在目錄，獲取並查看此合併請求的分支
    <pre>
    git fetch "%s" %s
    git checkout -b "%s" FETCH_HEAD</pre>
  </p>
  <p>
    第 2 步. 在本地查看更改，如使用<code>git log</code>等命令
  </p>
  <p>
    第 3 步. 合併分支並解決出現的任何衝突
    <pre>
    git fetch origin
    git checkout "%s"
    git merge --no-ff "%s"</pre>
  </p>
  <p>
    第 4 步. 將合併結果推送到Git
    <pre>
    git push origin "%s" </pre>
  </p>
</div>
EOD;

$lang->ppm->noChanges = "目前在這個合併請求的源分支中沒有變化，請推送新的提交或使用不同的分支。";

$lang->ppm->linkTask          = "關聯任務";
$lang->ppm->unlinkTask        = "移除任務";
$lang->ppm->linkedTasks       = '任務';
$lang->ppm->unlinkedTasks     = '未關聯任務';
$lang->ppm->confirmUnlinkTask = "您確認移除該任務嗎？";
$lang->ppm->taskSummary       = "本頁共 <strong>%s</strong> 個任務";
$lang->ppm->notDelbranch      = "源分支為受保護分支時不可刪除";
$lang->ppm->addForApp         = "該伺服器下沒有項目，是否前往添加？";
$lang->ppm->checkSuccess      = '檢查已通過，此分支允許合併';
$lang->ppm->checkFailed       = '檢查未通過，此分支無法合併';
$lang->ppm->MRHistory         = "本次合併由 <strong>%s</strong> 于 <strong>%s</strong> 創建，申請將 <label class='label primary size-sm px-2 cursor-pointer' data-on='click' data-call='copy' data-params='event'>%s<icon class='icon-copy ml-1'/></label> 的 <strong>%s</strong> 次提交，合併到 <label class='label primary size-sm px-2 cursor-pointer' data-on='click' data-call='copy' data-params='event'>%s<icon class='icon-copy ml-1'/></label> 。";

$lang->ppm->checkStatusList = array();
$lang->ppm->checkStatusList['fail']    = '未通過';
$lang->ppm->checkStatusList['success'] = '已通過';
$lang->ppm->checkStatusList['wait']    = '待確認';

$lang->ppm->hasConflictList['yes'] = '是';
$lang->ppm->hasConflictList['no']  = '否';

$lang->ppm->featureBar['browse']['all']      = $lang->ppm->statusList['all'];
$lang->ppm->featureBar['browse']['opened']   = $lang->ppm->statusList['opened'];
$lang->ppm->featureBar['browse']['merged']   = $lang->ppm->statusList['merged'];
$lang->ppm->featureBar['browse']['closed']   = $lang->ppm->statusList['closed'];
$lang->ppm->featureBar['browse']['creator']  = $lang->ppm->createdByMe;

$lang->ppm->bug = new stdclass();
$lang->ppm->bug->title    = '名稱';
$lang->ppm->bug->source   = '來源';
$lang->ppm->bug->type     = '類型';
$lang->ppm->bug->file     = '所屬檔案';
$lang->ppm->bug->severity = '嚴重程度';
$lang->ppm->bug->status   = '狀態';

$lang->ppm->mergeTypeInfoList = array();
$lang->ppm->mergeTypeInfoList['merge']  = '此分支上的所有提交將通過合併提交的方式添加到基礎分支。';
$lang->ppm->mergeTypeInfoList['squash'] = '此分支上的所有提交將合併為一個提交，並添加到基礎分支。當前合併方式會更改commitID的值，會造成關聯項缺失。';
$lang->ppm->mergeTypeInfoList['rebase'] = '此分支上的所有提交將被變基並添加到基礎分支。當前合併方式會更改commitID的值，會造成關聯項缺失。';
$lang->ppm->mergeTypeInfoList['fast']   = '此分支上的所有提交將直接添加到基礎分支，而不產生合併提交,可能需要進行變基。';

$lang->ppm->notice = new stdclass();
$lang->ppm->notice->confirmClose                 = '是否確認關閉該合併請求？';
$lang->ppm->notice->confirmReopen                = '是否開啟該合併請求？';
$lang->ppm->notice->fastNotice                   = '目標分支已有新提交，無法進行快速合併';
$lang->ppm->notice->sameBranch                   = '源分支與目標分支不能相同。';
$lang->ppm->notice->userNotAllowMerge            = '只允許以下用戶合併：%s';
$lang->ppm->notice->userNotAllowCreate           = '只允許以下用戶創建：%s';
$lang->ppm->notice->hasUnresolvedIssues          = '有未解決的問題，請先解決。';
$lang->ppm->notice->hasUnresolvedSpecifiedIssues = '有未解決的%s類型的問題，請先解決。';

$lang->ppm->featureBar['view']['all']   = '全部';
$lang->ppm->featureBar['view']['story'] = '需求';
$lang->ppm->featureBar['view']['task']  = '任務';
$lang->ppm->featureBar['view']['bug']   = '缺陷';

$lang->ppm->issueSourceList = array();
$lang->ppm->issueSourceList['code']  = '代碼';
$lang->ppm->issueSourceList['scan']  = '掃瞄';
