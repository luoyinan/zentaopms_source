<?php
$config->dingtalk = new stdClass();
$config->dingtalk->appKey         = 'ding9qqsbv1t1mtvcn19';
$config->dingtalk->appSecret      = '_NTcY4P-EiyKxXusRl3yth256wvBDfSijeubOmOcwOiudufBV8jriIQHWXqnQpaU';
$config->dingtalk->corpId         = 'dinga189547e135ec123723e5defd4f475f5';  /* 钉钉企业的 CorpId，在钉钉开放平台->企业信息中获取 */
$config->dingtalk->agentId        = '4858411875';  /* 应用的 AgentId，在钉钉开放平台->应用详情中获取 */
$config->dingtalk->accessTokenAPI = 'https://api.dingtalk.com/v1.0/oauth2/';  /* + corpId + '/token' */
$config->dingtalk->userInfoAPI    = 'https://oapi.dingtalk.com/topapi/v2/user/getuserinfo';
$config->dingtalk->deptListAPI    = 'https://oapi.dingtalk.com/topapi/v2/department/listsub';
$config->dingtalk->userListAPI    = 'https://oapi.dingtalk.com/topapi/v2/user/list';