<?php
$lang->reporeviewflow->browse       = '查看評審流程';
$lang->reporeviewflow->create       = '創建評審流程';
$lang->reporeviewflow->edit         = '編輯評審流程';
$lang->reporeviewflow->changeStatus = '啟用/停用評審流程';
$lang->reporeviewflow->delete       = '刪除評審流程';

$lang->reporeviewflow->name                  = '名稱';
$lang->reporeviewflow->desc                  = '描述';
$lang->reporeviewflow->flowName              = '流程名稱';
$lang->reporeviewflow->branchType            = '分支類型';
$lang->reporeviewflow->enableFlow            = '啟用';
$lang->reporeviewflow->disableFlow           = '停用';
$lang->reporeviewflow->basicInfo             = '基本信息';
$lang->reporeviewflow->applicableBranchTypes = '適用的目標分支';
$lang->reporeviewflow->allBranchTypes        = '全部分支類型';
$lang->reporeviewflow->aiReview              = 'AI評審';
$lang->reporeviewflow->aiAssistedReview      = 'AI輔助評審';
$lang->reporeviewflow->aiReviewScores        = '可通過的最低AI評審分數';
$lang->reporeviewflow->manualReview          = '人工評審';
$lang->reporeviewflow->defaultReviewers      = '預設評審人';
$lang->reporeviewflow->specifiedReviewers    = '評審人必須包含指定成員';
$lang->reporeviewflow->minReviewers          = '最低評審人數量';
$lang->reporeviewflow->solveIssues           = '問題處理';
$lang->reporeviewflow->addressOption         = '如何處理評審人發現的問題';
$lang->reporeviewflow->newCommits            = '待合併分支有新的提交請求時';
$lang->reporeviewflow->mergeStrategy         = '合併策略';
$lang->reporeviewflow->mergeOptions          = '可採用的合併分支策略';
$lang->reporeviewflow->autoArchive           = '合併後自動歸檔來源分支';
$lang->reporeviewflow->autoArchiveNotice     = '僅當開啟分支歸檔功能後可用';
$lang->reporeviewflow->allBranchTypesNotice  = '已存在全部分支類型審批流程';
$lang->reporeviewflow->enableSuccess         = '評審規則已啟用';
$lang->reporeviewflow->disableSuccess        = '評審規則已停用';
$lang->reporeviewflow->aiScoreTips           = 'AI對代碼評分超過該分數即通過AI評審';
$lang->reporeviewflow->status                = '狀態';

$lang->reporeviewflow->flowStatusList = array();
$lang->reporeviewflow->flowStatusList['enable']  = '啟用';
$lang->reporeviewflow->flowStatusList['disable'] = '停用';

$lang->reporeviewflow->aiReviewList = array();
$lang->reporeviewflow->aiReviewList['enable']  = '開啟';
$lang->reporeviewflow->aiReviewList['disable'] = '關閉';

$lang->reporeviewflow->addressOptionList = array();
$lang->reporeviewflow->addressOptionList['noNeedToSolve']        = '無需解決';
$lang->reporeviewflow->addressOptionList['allMustBeSolved']      = '必須全部解決';
$lang->reporeviewflow->addressOptionList['specificMustBeSolved'] = '指定類型的必須解決';

$lang->reporeviewflow->newCommitsAddressOptionList = array();
$lang->reporeviewflow->newCommitsAddressOptionList['defaultApproval'] = '預設通過';
$lang->reporeviewflow->newCommitsAddressOptionList['requireReReview'] = '需重新評審';

$lang->reporeviewflow->mergeOptionList = array();
$lang->reporeviewflow->mergeOptionList['merge']  = '普通合併';
$lang->reporeviewflow->mergeOptionList['squash'] = '壓縮併合並';
$lang->reporeviewflow->mergeOptionList['rebase'] = '變基併合並';
$lang->reporeviewflow->mergeOptionList['fast']   = '快速合併';

$lang->reporeviewflow->autoArchiveStatusList = array();
$lang->reporeviewflow->autoArchiveStatusList['enable']  = '開啟';
$lang->reporeviewflow->autoArchiveStatusList['disable'] = '關閉';

$lang->reporeviewflow->notice = new stdclass();
$lang->reporeviewflow->notice->deleteReviewFlow = '您確定刪除評審流程“%s”嗎？';
