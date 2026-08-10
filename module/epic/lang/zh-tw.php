<?php
global $app, $config;
$app->loadLang('story');
$lang->epic = clone $lang->story;

foreach($lang->epic as $key => $value)
{
    if(!is_string($value)) continue;
    if(strpos($value, $lang->SRCommon) !== false) $lang->epic->$key = str_replace($lang->SRCommon, $lang->ERCommon, $value);
}

$lang->epic->common = $lang->ERCommon;

$lang->epic->sourceList = array();
$lang->epic->sourceList['']           = '';
$lang->epic->sourceList['customer']   = '客戶';
$lang->epic->sourceList['user']       = '用戶';
$lang->epic->sourceList['po']         = $lang->productCommon . '經理';
$lang->epic->sourceList['market']     = '市場';
$lang->epic->sourceList['service']    = '客服';
$lang->epic->sourceList['operation']  = '運營';
$lang->epic->sourceList['support']    = '技術支持';
$lang->epic->sourceList['competitor'] = '競爭對手';
$lang->epic->sourceList['partner']    = '合作夥伴';
$lang->epic->sourceList['dev']        = '開發人員';
$lang->epic->sourceList['tester']     = '測試人員';
$lang->epic->sourceList['bug']        = 'Bug';
$lang->epic->sourceList['forum']      = '論壇';
$lang->epic->sourceList['other']      = '其他';

$lang->epic->priList = array();
$lang->epic->priList[0] = '';
$lang->epic->priList[1] = '1';
$lang->epic->priList[2] = '2';
$lang->epic->priList[3] = '3';
$lang->epic->priList[4] = '4';

$lang->epic->categoryList = array();
$lang->epic->categoryList['feature']     = '功能';
$lang->epic->categoryList['interface']   = '介面';
$lang->epic->categoryList['performance'] = '性能';
$lang->epic->categoryList['safe']        = '安全';
$lang->epic->categoryList['experience']  = '體驗';
$lang->epic->categoryList['improve']     = '改進';
$lang->epic->categoryList['other']       = '其他';

$lang->epic->stageList = array();
$lang->epic->stageList[''] = '';
$lang->epic->stageList['wait'] = '未開始';
if($config->edition == 'ipd')
{
    $lang->epic->stageList['inroadmap'] = '已設路標';
    $lang->epic->stageList['incharter'] = 'Charter立項';
}
$lang->epic->stageList['planned']    = '已計劃';
$lang->epic->stageList['projected']  = '研發立項';
$lang->epic->stageList['developing'] = '研發中';
$lang->epic->stageList['delivering'] = '交付中';
$lang->epic->stageList['delivered']  = '已交付';
$lang->epic->stageList['closed']     = '已關閉';

$lang->epic->reasonList = array();
$lang->epic->reasonList['']           = '';
$lang->epic->reasonList['done']       = '已完成';
$lang->epic->reasonList['subdivided'] = '已拆分';
$lang->epic->reasonList['duplicate']  = '重複';
$lang->epic->reasonList['postponed']  = '延期';
$lang->epic->reasonList['willnotdo']  = '不做';
$lang->epic->reasonList['cancel']     = '已取消';
$lang->epic->reasonList['bydesign']   = '設計如此';

$lang->epic->linkStory = "關聯需求";
