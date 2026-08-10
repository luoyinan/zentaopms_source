<?php
$lang->space->browse     = '空間列表';
$lang->space->create     = '創建空間';
$lang->space->edit       = '編輯空間';
$lang->space->view       = '空間詳情';
$lang->space->delete     = '刪除空間';
$lang->space->members    = '成員';
$lang->space->memberList = '成員列表';

$lang->space->group             = '權限';
$lang->space->groupList         = '權限列表';
$lang->space->createGroup       = '添加分組';
$lang->space->importGroup       = '導入分組';
$lang->space->managePriv        = '分配權限';
$lang->space->editGroup         = '編輯分組';
$lang->space->deleteGroup       = '刪除分組';
$lang->space->manageMembers     = '管理成員';
$lang->space->removeMember      = '解綁成員';
$lang->space->manageGroupMember = '管理分組成員';

$lang->space->name         = '名稱';
$lang->space->code         = '唯一標識';
$lang->space->manager      = '管理員';
$lang->space->createdDate  = '創建時間';
$lang->space->desc         = '描述';
$lang->space->repo         = '代碼庫';
$lang->space->artifactrepo = '製品庫';
$lang->space->pipeline     = '流水綫';
$lang->space->system       = '應用';
$lang->space->acl          = '訪問控制';
$lang->space->deleted      = '已刪除';
$lang->space->account      = '姓名';
$lang->space->team         = '團隊';
$lang->space->auth         = '權限控制';
$lang->space->role         = '角色';
$lang->space->defaultSpace = '預設空間';

$lang->space->memberGroup    = '分組';
$lang->space->accessRepo     = '可訪問的代碼庫';
$lang->space->accessArtifact = '可訪問的製品庫';
$lang->space->sourceSpace    = '源分組空間';
$lang->space->sourceGroup    = '源分組';

$lang->space->aclList = array();
$lang->space->aclList['open']    = '公開';
$lang->space->aclList['private'] = '私有';

$lang->space->aclNoticeList = array();
$lang->space->aclNoticeList['open']    = '公開(有空間視圖的權限即可訪問該空間)';
$lang->space->aclNoticeList['private'] = '私有(僅成員、空間管理員可訪問該空間)';

$lang->space->authList = array();
$lang->space->authList['extend'] = '繼承';
$lang->space->authList['reset']  = '重新定義';

$lang->space->authNoticeList = array();
$lang->space->authNoticeList['extend'] = '繼承(取系統權限與空間權限合集)';
$lang->space->authNoticeList['reset']  = '重新定義(只取空間權限)';

$lang->space->roleList = array();
$lang->space->roleList['manager'] = '管理員';
$lang->space->roleList['member']  = '成員';

$lang->space->notice = new stdclass();
$lang->space->notice->noSpaces              = '暫無任何空間';
$lang->space->notice->confirmDeleteSpace    = '您確定要刪除該空間嗎？';
$lang->space->notice->deleteFail            = '空間下存在代碼庫或製品庫, 無法刪除。';
$lang->space->notice->apiCreateFail         = '創建空間失敗。';
$lang->space->notice->accessRepo            = '僅展示用戶可訪問的非公開代碼庫';
$lang->space->notice->accessArtifact        = '僅展示用戶可訪問的非公開製品庫';
$lang->space->notice->confirmRemoveMember   = '您確定從該空間中移除該用戶嗎？';
$lang->space->notice->confirmDelete         = '您確定刪除“ %s” 權限分組嗎？';
$lang->space->notice->managerMemberConflict = '%s為空間用戶，如需配置為管理員可先移除用戶。';

$lang->space->placeholder       = new stdclass();
$lang->space->placeholder->desc = '請輸入空間描述';

$lang->space->tips      = '提示';
$lang->space->afterInfo = "空間添加成功，您現在可以進行以下操作：";
$lang->space->setMember = '設置成員';
$lang->space->setACL    = '設置權限';
$lang->space->goback    = "返回空間列表";
