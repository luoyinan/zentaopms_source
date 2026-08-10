<?php
global $app, $config;
$app->loadLang('story');
$lang->requirement = clone $lang->story;

foreach($lang->requirement as $key => $value)
{
    if(!is_string($value)) continue;
    if(strpos($value, $lang->SRCommon) !== false) $lang->requirement->$key = str_replace($lang->SRCommon, $lang->URCommon, $value);
}

$lang->requirement->common = $lang->URCommon;

$lang->requirement->sourceList = array();
$lang->requirement->sourceList['']           = '';
$lang->requirement->sourceList['customer']   = '客戶';
$lang->requirement->sourceList['user']       = '用戶';
$lang->requirement->sourceList['po']         = $lang->productCommon . '經理';
$lang->requirement->sourceList['market']     = '市場';
$lang->requirement->sourceList['service']    = '客服';
$lang->requirement->sourceList['operation']  = '運營';
$lang->requirement->sourceList['support']    = '技術支持';
$lang->requirement->sourceList['competitor'] = '競爭對手';
$lang->requirement->sourceList['partner']    = '合作夥伴';
$lang->requirement->sourceList['dev']        = '開發人員';
$lang->requirement->sourceList['tester']     = '測試人員';
$lang->requirement->sourceList['bug']        = 'Bug';
$lang->requirement->sourceList['forum']      = '論壇';
$lang->requirement->sourceList['other']      = '其他';

$lang->requirement->priList = array();
$lang->requirement->priList[0] = '';
$lang->requirement->priList[1] = '1';
$lang->requirement->priList[2] = '2';
$lang->requirement->priList[3] = '3';
$lang->requirement->priList[4] = '4';

$lang->requirement->categoryList = array();
$lang->requirement->categoryList['feature']     = '功能';
$lang->requirement->categoryList['interface']   = '介面';
$lang->requirement->categoryList['performance'] = '性能';
$lang->requirement->categoryList['safe']        = '安全';
$lang->requirement->categoryList['experience']  = '體驗';
$lang->requirement->categoryList['improve']     = '改進';
$lang->requirement->categoryList['other']       = '其他';

$lang->requirement->stageList = array();
$lang->requirement->stageList[''] = '';
$lang->requirement->stageList['wait'] = '未開始';
if($config->edition == 'ipd')
{
    $lang->requirement->stageList['inroadmap'] = '已設路標';
    $lang->requirement->stageList['incharter'] = 'Charter立項';
}
$lang->requirement->stageList['planned']    = '已計劃';
$lang->requirement->stageList['projected']  = '研發立項';
$lang->requirement->stageList['developing'] = '研發中';
$lang->requirement->stageList['delivering'] = '交付中';
$lang->requirement->stageList['delivered']  = '已交付';
$lang->requirement->stageList['closed']     = '已關閉';

$lang->requirement->reasonList = array();
$lang->requirement->reasonList['']           = '';
$lang->requirement->reasonList['done']       = '已完成';
$lang->requirement->reasonList['subdivided'] = '已拆分';
$lang->requirement->reasonList['duplicate']  = '重複';
$lang->requirement->reasonList['postponed']  = '延期';
$lang->requirement->reasonList['willnotdo']  = '不做';
$lang->requirement->reasonList['cancel']     = '已取消';
$lang->requirement->reasonList['bydesign']   = '設計如此';

$lang->requirement->linkStory = '關聯需求';
