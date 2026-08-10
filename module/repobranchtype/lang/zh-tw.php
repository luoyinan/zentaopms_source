<?php
$lang->repobranchtype->common        = '分支類型';
$lang->repobranchtype->browse        = '查看分支類型';
$lang->repobranchtype->create        = '創建分支類型';
$lang->repobranchtype->edit          = '編輯分支類型';
$lang->repobranchtype->delete        = '刪除分支類型';
$lang->repobranchtype->import        = '導入分支類型';
$lang->repobranchtype->setBranchRule = '設置評審流程';

$lang->repobranchtype->name     = '名稱';
$lang->repobranchtype->key      = '鍵值';
$lang->repobranchtype->prefixes = '首碼';
$lang->repobranchtype->desc     = '描述';

$lang->repobranchtype->placeholder      = new stdclass();
$lang->repobranchtype->placeholder->key = '用於分支規則的唯一標識符，僅能以字母開頭';

$lang->repobranchtype->tips = new stdclass();
$lang->repobranchtype->tips->maxPrefixes    = '最多只能添加5個首碼';
$lang->repobranchtype->tips->minPrefixes    = '至少需要保留1個首碼';
$lang->repobranchtype->tips->prefixRequired = '請至少填寫一個首碼';
$lang->repobranchtype->tips->createSuccess  = '分支類型創建成功';
$lang->repobranchtype->tips->updateSuccess  = '分支類型更新成功';
$lang->repobranchtype->tips->importSuccess  = '分支類型導入成功';

$lang->repobranchtype->error = new stdclass();
$lang->repobranchtype->error->keyFormat       = '鍵值格式不正確，僅能輸入英文字母、數字與符號（/-_.），且以字母開頭';
$lang->repobranchtype->error->prefixFormat    = '首碼格式不正確，僅能輸入英文字母、數字與符號（/-_.），斜杠最多只能有一個';
$lang->repobranchtype->error->prefixSlash     = '首碼中斜杠最多只能有一個';
$lang->repobranchtype->error->prefixDuplicate = '首碼不能重複';
$lang->repobranchtype->error->notExists       = '分支類型不存在';

$lang->repobranchtype->notice = new stdclass();
$lang->repobranchtype->notice->delete                     = '確認刪除該分支類型？';
$lang->repobranchtype->notice->noPermissionToCreateBranch = '沒有創建分支的權限';
$lang->repobranchtype->notice->noPermissionToDeleteBranch = '沒有刪除分支的權限';
