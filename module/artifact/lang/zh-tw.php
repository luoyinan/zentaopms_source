<?php
$lang->artifact->browse              = '製品庫列表';
$lang->artifact->create              = '創建製品庫';
$lang->artifact->edit                = '編輯製品庫';
$lang->artifact->delete              = '刪除製品庫';
$lang->artifact->repoBrowser         = '製品庫內容';
$lang->artifact->createDir           = '添加目錄';
$lang->artifact->uploadArtifact      = '上傳製品';
$lang->artifact->addSubDir           = '添加子目錄';
$lang->artifact->addSiblingDir       = '添加同級目錄';
$lang->artifact->editDir             = '編輯目錄';
$lang->artifact->deleteDir           = '刪除目錄';
$lang->artifact->editArtifact        = '修改製品信息';
$lang->artifact->moveArtifact        = '移動製品';
$lang->artifact->deleteArtifact      = '刪除製品';
$lang->artifact->batchDeleteArtifact = '批量刪除製品';
$lang->artifact->copyCMD             = '複製命令';
$lang->artifact->copied              = '複製成功';

$lang->artifact->name          = '名稱';
$lang->artifact->code          = '唯一標識';
$lang->artifact->path          = '所屬目錄';
$lang->artifact->type          = '類型';
$lang->artifact->size          = '大小';
$lang->artifact->version       = '版本';
$lang->artifact->arch          = '系統/架構';
$lang->artifact->creator       = '創建者';
$lang->artifact->createdDate   = '創建時間';
$lang->artifact->editor        = '最後更新';
$lang->artifact->editedDate    = '最後更新時間';
$lang->artifact->action        = '操作';
$lang->artifact->folder        = '檔案夾';
$lang->artifact->file          = '檔案';
$lang->artifact->emptyFolder   = '當前目錄下暫無檔案或檔案夾';
$lang->artifact->expandAll     = '全部展開';
$lang->artifact->collapseAll   = '全部收起';
$lang->artifact->hideTree      = '隱藏目錄樹';
$lang->artifact->showTree      = '顯示目錄樹';
$lang->artifact->more          = '更多';
$lang->artifact->settings      = '設置';
$lang->artifact->addDirectory  = '添加目錄';
$lang->artifact->download      = '下載';
$lang->artifact->rename        = '重命名';
$lang->artifact->move          = '移動';
$lang->artifact->switch        = '切換當前層級';
$lang->artifact->actionMockTip = '當前為模擬操作：%s';
$lang->artifact->dirName       = '目錄名稱';
$lang->artifact->format        = '製品庫類型';
$lang->artifact->hasVersion    = '需要進行版本控制';
$lang->artifact->checkValue    = '校驗值';
$lang->artifact->okBtn         = '確定';
$lang->artifact->history       = '歷史記錄';
$lang->artifact->artifactRepo  = '製品庫';
$lang->artifact->parent        = '所屬上級';
$lang->artifact->repo          = '所屬代碼庫';
$lang->artifact->package       = '包名';
$lang->artifact->asset         = '製品';

$lang->artifact->countArtifact = '共%s個製品';

$lang->artifact->actionComment = new stdclass();
$lang->artifact->actionComment->moved     = '從製品庫 <strong>%s</strong> 的目錄 <strong>%s</strong> 移動到製品庫 <strong>%s</strong> 的目錄 <strong>%s<strong>。';
$lang->artifact->actionComment->editedDir = '從製品庫 <strong>%s</strong> 的 <strong>%s</strong> 修改為製品庫 <strong>%s</strong> 的 <strong>%s</strong>。';
$lang->artifact->actionComment->edited    = '從 <strong>%s</strong> 重命名為 <strong>%s</strong>。';

$lang->artifact->placeholder = new stdclass();
$lang->artifact->placeholder->name = '請輸入製品庫名稱';

$lang->artifact->notice = new stdclass();
$lang->artifact->notice->deleteConfirm         = '您確定要刪除該製品庫嗎？';
$lang->artifact->notice->noArtifact            = '暫無製品庫';
$lang->artifact->notice->emptyAsset            = '暫無製品';
$lang->artifact->notice->nameNotSupportChinese = '名稱僅支持英文，數字，下劃線（_），中橫線（-），英文句號（.）';
$lang->artifact->notice->dirNameFormatError    = '名稱僅支持中文，英文，數字，下劃線（_），中橫線（-）';
$lang->artifact->notice->assetNameFormatError  = '名稱不能包含\/:*?"<>|';
$lang->artifact->notice->confirmDelete         = '刪除後檔案將會在資源回收筒保留30天，超時後將無法恢復。';
$lang->artifact->notice->confirmDeleteDir      = '刪除目錄後，同步刪除目錄下的子目錄和檔案，確認要刪除嗎?';
$lang->artifact->notice->rootNotAllowed        = '移動製品時不能選擇根目錄。';
$lang->artifact->notice->dirNameTooLong        = '目錄名稱不能超過15個字元。';

$lang->artifact->featureBar['browse']['all']   = '全部';
$lang->artifact->featureBar['browse']['space'] = '空間製品庫';
$lang->artifact->featureBar['browse']['repo']  = '代碼庫製品庫';

$lang->artifact->typeList = array();
$lang->artifact->typeList['repo']  = '代碼庫';
$lang->artifact->typeList['space'] = '空間';

$lang->artifact->formatList = array();
$lang->artifact->formatList['file']      = '通用檔案倉庫';
$lang->artifact->formatList['container'] = '鏡像倉庫';
//$lang->artifact->formatList['helm']      = 'Helm倉庫';
//$lang->artifact->formatList['maven']     = 'Maven倉庫';
//$lang->artifact->formatList['npm']       = 'NPM倉庫';
