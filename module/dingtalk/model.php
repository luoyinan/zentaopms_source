<?php
/**
 * The model file of dingtalk module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）集团有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     dingtalk
 * @version     $Id$
 * @link        https://www.zentao.net
 */
class dingtalkModel extends model
{
    /**
     * Accumulated log messages for browser console output.
     *
     * @var array
     */
    public static $consoleLogs = array();

    /**
     * Write a log message to the DingTalk log file and Apache error log.
     *
     * @param  string $message
     * @access public
     * @return void
     */
    public function log($message)
    {
        $runMode = PHP_SAPI == 'cli' ? '_cli' : '';
        $logFile = $this->app->getLogRoot() . 'dingtalk' . $runMode . '.' . date('Ymd') . '.log.php';
        if(!file_exists($logFile)) file_put_contents($logFile, "<?php die(); ?" . ">\n");

        $logMessage = date('Ymd H:i:s') . ' [' . $this->app->getURI() . '] ' . $message . "\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);

        /* Also write to Apache error log for real-time tailing. */
        error_log('[DingTalk] ' . $message);

        /* Accumulate for browser console output. */
        self::$consoleLogs[] = $message;
    }

    /**
     * Get accumulated log messages as HTML script tags for browser console.
     *
     * @access public
     * @return string
     */
    public function getConsoleLogHTML()
    {
        $html = '';
        foreach(self::$consoleLogs as $msg)
        {
            $safeMsg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
            $html .= "<script>console.log('[DingTalk-PHP] " . $safeMsg . "');</script>\n";
        }
        return $html;
    }

    /**
     * Get access token from DingTalk.
     *
     * @access public
     * @return string|false
     */
    public function getAccessToken()
    {
        $this->log('getAccessToken() 开始获取 accessToken');

        $url    = $this->config->dingtalk->accessTokenAPI . $this->config->dingtalk->corpId . '/token';
        $params = array('client_id' => $this->config->dingtalk->appKey, 'client_secret' => $this->config->dingtalk->appSecret, 'grant_type' => 'client_credentials');

        $this->log('getAccessToken() 请求钉钉API: ' . $url);
        $this->log('getAccessToken() appKey: ' . $this->config->dingtalk->appKey);

        $result = common::http($url, $params, array(), array(), 'json');
        if(empty($result))
        {
            $this->log('getAccessToken() 失败: 钉钉API返回空结果');
            return false;
        }

        $info = json_decode($result);
        if(!isset($info->access_token))
        {
            $this->log('getAccessToken() 失败: 响应中没有 access_token, 响应内容: ' . $result);
            return false;
        }

        $this->log('getAccessToken() 成功获取 accessToken');
        return $info->access_token;
    }

    /**
     * Get user info from DingTalk by auth code.
     *
     * @param  string    $authCode
     * @access public
     * @return object|false
     */
    public function getUserInfo($authCode)
    {
        $this->log('getUserInfo() 开始通过 authCode 获取用户信息, authCode: ' . substr($authCode, 0, 10) . '...');

        /* Step 1: Get app-level accessToken via corpId token API. */
        $this->log('getUserInfo() Step1: 获取 accessToken');
        $accessToken = $this->getAccessToken();
        if(!$accessToken)
        {
            $this->log('getUserInfo() Step1 失败: 获取 accessToken 失败');
            return false;
        }
        $this->log('getUserInfo() Step1 成功获取 accessToken');

        /* Step 2: Get user info via oapi.dingtalk.com.
         * POST topapi/v2/user/getuserinfo?access_token=xxx with {"code": authCode}. */
        $this->log('getUserInfo() Step2: 用 authCode 获取用户信息');

        $url    = $this->config->dingtalk->userInfoAPI . '?access_token=' . $accessToken;
        $params = array('code' => $authCode);

        $this->log('getUserInfo() 请求钉钉API(POST): ' . $url);

        $result = common::http($url, $params, array(), array(), 'json');
        if(empty($result))
        {
            $this->log('getUserInfo() Step2 失败: 钉钉API返回空结果');
            return false;
        }

        $info = json_decode($result);
        if(!isset($info->errcode) || $info->errcode != 0)
        {
            $this->log('getUserInfo() Step2 失败: errcode=' . (isset($info->errcode) ? $info->errcode : '无') . ', 响应内容: ' . $result);
            return false;
        }

        if(!isset($info->result) || !isset($info->result->userid))
        {
            $this->log('getUserInfo() Step2 失败: 响应中没有 userid, 响应内容: ' . $result);
            return false;
        }

        $this->log('getUserInfo() 成功获取用户信息, 完整信息: ' . json_encode($info->result));
        return $info->result;
    }

    /**
     * Get user by DingTalk unionId.
     *
     * @param  string    $unionId
     * @access public
     * @return object|false
     */
    public function getUserByDingId($unionId)
    {
        $this->log('getUserByDingId() 开始查询用户, unionId: ' . $unionId);

        $user = $this->dao->select('*')->from(TABLE_USER)
            ->where('deleted')->eq('0')
            ->andWhere('dingding')->eq($unionId)
            ->fetch();

        if($user)
        {
            $this->log('getUserByDingId() 找到匹配用户, account: ' . $user->account . ', realname: ' . $user->realname);
        }
        else
        {
            $this->log('getUserByDingId() 未找到匹配的用户, unionId: ' . $unionId);
        }

        return $user;
    }
}