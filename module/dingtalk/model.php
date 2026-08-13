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
require_once dirname(__FILE__, 3) . '/lib/pinyin/pinyin.class.php';
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
     * Get access token from DingTalk with local caching.
     * Cache is stored in tmp/dingtalk.token.php with 6900s expiration.
     *
     * @param  bool     $forceRefresh Whether to force refresh the token from API
     * @access public
     * @return string|false
     */
    public function getAccessToken($forceRefresh = false)
    {
        $this->log('getAccessToken() 开始获取 accessToken' . ($forceRefresh ? ' (强制刷新)' : ''));

        /* Check local cache first. */
        if(!$forceRefresh)
        {
            $cachedToken = $this->getCachedAccessToken();
            if($cachedToken !== false)
            {
                $this->log('getAccessToken() 使用本地缓存的 accessToken');
                return $cachedToken;
            }
        }

        /* Fetch from DingTalk API. */
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

        /* Cache the token with 6900s expiration. */
        $this->saveCachedAccessToken($info->access_token);

        $this->log('getAccessToken() 成功获取 accessToken');
        return $info->access_token;
    }

    /**
     * Get cached access token from local file.
     *
     * @access private
     * @return string|false
     */
    private function getCachedAccessToken()
    {
        $cacheFile = $this->app->getTmpRoot() . 'dingtalk.token.php';
        $this->log('getCachedAccessToken() 缓存文件路径: ' . $cacheFile);

        if(!file_exists($cacheFile))
        {
            $this->log('getCachedAccessToken() 缓存文件不存在');
            return false;
        }

        $data = file_get_contents($cacheFile);
        if(empty($data))
        {
            $this->log('getCachedAccessToken() 缓存文件内容为空');
            return false;
        }

        /* Strip PHP exit guard if present. */
        $prefix = '<?php die(); ?>';
        if(strncmp($data, $prefix, strlen($prefix)) === 0)
        {
            $data = trim(substr($data, strlen($prefix)));
        }

        $cache = json_decode($data);
        if(!isset($cache->token) || !isset($cache->expireTime))
        {
            $this->log('getCachedAccessToken() 缓存数据格式错误: ' . $data);
            return false;
        }

        /* Check if token is expired (6900s from cache time). */
        if(time() >= $cache->expireTime)
        {
            $this->log('getCachedAccessToken() 本地缓存已过期, expireTime=' . $cache->expireTime . ', now=' . time());
            return false;
        }

        $this->log('getCachedAccessToken() 缓存命中, token=' . substr($cache->token, 0, 10) . '...');
        return $cache->token;
    }

    /**
     * Save access token to local cache file.
     *
     * @param  string    $token
     * @access private
     * @return void
     */
    private function saveCachedAccessToken($token)
    {
        $cacheFile = $this->app->getTmpRoot() . 'dingtalk.token.php';
        $this->log('saveCachedAccessToken() 写入缓存文件: ' . $cacheFile);

        $cache = new stdClass();
        $cache->token      = $token;
        $cache->expireTime = time() + 6900; /* 6900s expiration (300s buffer before DingTalk's 7200s). */

        $content = "<?php die(); ?>\n" . json_encode($cache);
        $result = file_put_contents($cacheFile, $content);
        if($result === false)
        {
            $this->log('saveCachedAccessToken() 写入缓存文件失败');
        }
        else
        {
            $this->log('saveCachedAccessToken() 缓存写入成功, 已写入 ' . $result . ' 字节');
        }
    }

    /**
     * Check if API response indicates token expiry and retry with fresh token.
     *
     * @param  string    $response Original API response
     * @param  string    $url      API URL (passed by reference, updated on retry)
     * @param  array     $params   POST parameters
     * @access private
     * @return string    Original response if token is valid, or retry response if expired
     */
    private function refreshTokenOnExpiry($response, &$url, $params)
    {
        if(empty($response)) return $response;

        $info = json_decode($response);
        if(!isset($info->errcode) || !in_array($info->errcode, array(40001, 40014))) return $response;

        $this->log('refreshTokenOnExpiry() access_token 已过期(errcode=' . $info->errcode . '), 强制刷新并重试');

        $newToken = $this->getAccessToken(true);
        if(!$newToken)
        {
            $this->log('refreshTokenOnExpiry() 重新获取 accessToken 失败');
            return $response;
        }

        /* Replace the old token in the URL with the new one. */
        $url = preg_replace('/access_token=[^&]+/', 'access_token=' . $newToken, $url);

        $retryResponse = common::http($url, $params, array(), array(), 'json');
        if(empty($retryResponse))
        {
            $this->log('refreshTokenOnExpiry() 重试请求返回空结果');
            return $response;
        }

        $this->log('refreshTokenOnExpiry() 重试成功');
        return $retryResponse;
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

            /* Retry with fresh token if access_token is expired (40014, 40001, etc.). */
            if(isset($info->errcode) && in_array($info->errcode, array(40001, 40014)))
            {
                $this->log('getUserInfo() Step2 access_token 已过期, 强制刷新并重试');

                $newAccessToken = $this->getAccessToken(true);
                if(!$newAccessToken)
                {
                    $this->log('getUserInfo() Step2 重试失败: 重新获取 accessToken 失败');
                    return false;
                }

                $retryUrl    = $this->config->dingtalk->userInfoAPI . '?access_token=' . $newAccessToken;
                $retryResult = common::http($retryUrl, $params, array(), array(), 'json');
                if(empty($retryResult))
                {
                    $this->log('getUserInfo() Step2 重试失败: 钉钉API返回空结果');
                    return false;
                }

                $retryInfo = json_decode($retryResult);
                if(!isset($retryInfo->errcode) || $retryInfo->errcode != 0)
                {
                    $this->log('getUserInfo() Step2 重试失败: errcode=' . (isset($retryInfo->errcode) ? $retryInfo->errcode : '无') . ', 响应内容: ' . $retryResult);
                    return false;
                }

                if(!isset($retryInfo->result) || !isset($retryInfo->result->userid))
                {
                    $this->log('getUserInfo() Step2 重试失败: 响应中没有 userid, 响应内容: ' . $retryResult);
                    return false;
                }

                $info = $retryInfo;
            }
            else
            {
                return false;
            }
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

    /**
     * Get all departments from DingTalk.
     *
     * @param  string    $accessToken
     * @access public
     * @return array|false
     */
    public function getDepartmentList($accessToken)
    {
        $this->log('getDepartmentList() 开始递归获取部门列表');

        $allDepts = array();

        /* Add root department (dept_id=1) to the list. */
        $rootDept = new stdClass();
        $rootDept->dept_id = 1;
        $rootDept->name    = 'Root';
        $allDepts[] = $rootDept;

        /* Get sub-departments recursively. */
        $this->getSubDepartments($accessToken, 1, $allDepts);

        $this->log('getDepartmentList() 成功获取部门列表, 共 ' . count($allDepts) . ' 个部门');
        return $allDepts;
    }

    /**
     * Recursively get sub-departments from DingTalk.
     *
     * @param  string    $accessToken
     * @param  int       $deptId
     * @param  array     $result
     * @access public
     * @return void
     */
    public function getSubDepartments($accessToken, $deptId, &$result)
    {
        $url = $this->config->dingtalk->deptListAPI . '?access_token=' . $accessToken;

        $params = array('dept_id' => $deptId);
        $response = common::http($url, $params, array(), array(), 'json');

        /* Retry with fresh token if access_token is expired. */
        $response = $this->refreshTokenOnExpiry($response, $url, $params);

        $this->log('getSubDepartments() dept_id=' . $deptId . ' 响应: ' . $response);
        if(empty($response))
        {
            $this->log('getSubDepartments() dept_id=' . $deptId . ' 返回空结果');
            return;
        }

        $info = json_decode($response);
        if(!isset($info->errcode) || $info->errcode != 0)
        {
            $this->log('getSubDepartments() dept_id=' . $deptId . ' 失败: errcode=' . (isset($info->errcode) ? $info->errcode : '无') . ', 响应: ' . $response);
            return;
        }

        if(!isset($info->result))
        {
            $this->log('getSubDepartments() dept_id=' . $deptId . ' 响应中没有 result: ' . $response);
            return;
        }

        /* The listsub API returns result as a direct array of department objects. */
        $deptList = array();
        if(isset($info->result->dept_list))
        {
            $deptList = $info->result->dept_list;
        }
        elseif(is_array($info->result))
        {
            $deptList = $info->result;
        }

        $this->log('getSubDepartments() dept_id=' . $deptId . ' 获取到 ' . count($deptList) . ' 个子部门');

        foreach($deptList as $dept)
        {
            $result[] = $dept;
            $this->getSubDepartments($accessToken, $dept->dept_id, $result);
        }
    }

    /**
     * Get all users in a department from DingTalk.
     *
     * @param  string    $accessToken
     * @param  int       $deptId
     * @access public
     * @return array
     */
    public function getUserListByDept($accessToken, $deptId)
    {
        $url = $this->config->dingtalk->userListAPI . '?access_token=' . $accessToken;

        $users = array();
        $cursor = 0;
        $hasMore = true;

        while($hasMore)
        {
            $params = array('dept_id' => $deptId, 'cursor' => $cursor, 'size' => 100);
            $result = common::http($url, $params, array(), array(), 'json');

            /* Retry with fresh token if access_token is expired. */
            $result = $this->refreshTokenOnExpiry($result, $url, $params);

            $this->log('getUserListByDept() dept_id=' . $deptId . ' 返回结果:' . $result);

            if(empty($result))
            {
                $this->log('getUserListByDept() dept_id=' . $deptId . ' 返回空结果');
                break;
            }

            $info = json_decode($result);
            if(!isset($info->errcode) || $info->errcode != 0)
            {
                $this->log('getUserListByDept() dept_id=' . $deptId . ' API错误: ' . $result);
                break;
            }

            if(!isset($info->result) || !isset($info->result->list))
            {
                $this->log('getUserListByDept() dept_id=' . $deptId . ' 响应中没有list: ' . $result);
                break;
            }

            $users = array_merge($users, $info->result->list);

            if(isset($info->result->next_cursor) && $info->result->next_cursor > 0)
            {
                $cursor = $info->result->next_cursor;
            }
            else
            {
                $hasMore = false;
            }
        }

        $this->log('getUserListByDept() dept_id=' . $deptId . ' 获取到 ' . count($users) . ' 个用户');
        return $users;
    }

    /**
     * Sync DingTalk users to zt_user table.
     *
     * @access public
     * @return void
     */
    public function syncUsers()
    {
        $this->log('syncUsers() 开始同步钉钉用户');

        $accessToken = $this->getAccessToken();
        if(!$accessToken)
        {
            $this->log('syncUsers() 失败: 获取 accessToken 失败');
            return;
        }

        /* Get all departments. */
        $deptList = $this->getDepartmentList($accessToken);
        if($deptList === false)
        {
            $this->log('syncUsers() 失败: 获取部门列表失败');
            return;
        }

        /* Get all users from all departments and deduplicate by userid. */
        $allUsers = array();
        $seenUserIds = array();

        foreach($deptList as $dept)
        {
            $deptUsers = $this->getUserListByDept($accessToken, $dept->dept_id);
            foreach($deptUsers as $user)
            {
                if(!isset($seenUserIds[$user->userid]))
                {
                    $seenUserIds[$user->userid] = true;
                    $allUsers[] = $user;
                }
            }
        }

        $this->log('syncUsers() 获取到 ' . count($allUsers) . ' 个钉钉用户（去重后）');

        /* Process each user. */
        $matchedCount = 0;
        $createdCount = 0;
        $skippedCount = 0;

        foreach($allUsers as $dingUser)
        {
            $userid   = $dingUser->userid;
            $name     = isset($dingUser->name) ? $dingUser->name : '';
            $email    = isset($dingUser->email) ? $dingUser->email : '';
            $mobile   = isset($dingUser->mobile) ? $dingUser->mobile : '';

            if(empty($name)) continue;

            /* Step 1: Check if already bound by dingding field. */
            $existingUser = $this->dao->select('*')->from(TABLE_USER)
                ->where('deleted')->eq('0')
                ->andWhere('dingding')->eq($userid)
                ->fetch();

            if($existingUser)
            {
                $this->log('syncUsers() 跳过: ' . $name . ' 已绑定 dingding=' . $userid);
                $skippedCount++;
                continue;
            }

            /* Step 2: Try to match by email. */
            $matched = false;
            if(!empty($email))
            {
                $emailUser = $this->dao->select('*')->from(TABLE_USER)
                    ->where('deleted')->eq('0')
                    ->andWhere('email')->eq($email)
                    ->fetch();

                if($emailUser)
                {
                    $this->dao->update(TABLE_USER)->set('dingding')->eq($userid)->where('id')->eq($emailUser->id)->exec();
                    $this->log('syncUsers() 匹配: ' . $name . ' 通过 email=' . $email . ' 匹配到 ' . $emailUser->account . ', 更新 dingding=' . $userid);
                    $matchedCount++;
                    $matched = true;
                }
            }

            if($matched) continue;

            /* Step 3: Try to match by mobile. */
            if(!empty($mobile))
            {
                $mobileUser = $this->dao->select('*')->from(TABLE_USER)
                    ->where('deleted')->eq('0')
                    ->andWhere('mobile')->eq($mobile)
                    ->fetch();

                if($mobileUser)
                {
                    $this->dao->update(TABLE_USER)->set('dingding')->eq($userid)->where('id')->eq($mobileUser->id)->exec();
                    $this->log('syncUsers() 匹配: ' . $name . ' 通过 mobile=' . $mobile . ' 匹配到 ' . $mobileUser->account . ', 更新 dingding=' . $userid);
                    $matchedCount++;
                    $matched = true;
                }
            }

            if($matched) continue;

            /* Step 4: No match, create new user. */
            $pinyin = new pinyin();
            $account = $pinyin->permalink($name, '');

            /* Ensure account is unique. */
            $suffix = '';
            $baseAccount = $account;
            $counter = 1;
            while($this->dao->select('id')->from(TABLE_USER)->where('account')->eq($account . $suffix)->fetch())
            {
                $suffix = $counter;
                $counter++;
            }
            $account = $account . $suffix;

            $newUser = new stdClass();
            $newUser->company  = 1;
            $newUser->type     = 'inside';
            $newUser->account  = $account;
            $newUser->password = md5('Pwd123456');
            $newUser->realname = $name;
            $newUser->email    = $email;
            $newUser->mobile   = $mobile;
            $newUser->dingding = $userid;
            $newUser->visions  = 'rnd,lite';
            $newUser->pinyin   = $account;

            $this->dao->insert(TABLE_USER)->data($newUser)->exec();
            if(!dao::isError())
            {
                $this->log('syncUsers() 创建用户: ' . $name . ', account=' . $account . ', dingding=' . $userid);
                $createdCount++;
            }
            else
            {
                $this->log('syncUsers() 创建失败: ' . $name . ', 错误: ' . json_encode(dao::getError()));
            }
        }

        $this->log('syncUsers() 同步完成: 已绑定=' . $matchedCount . ', 已创建=' . $createdCount . ', 已跳过=' . $skippedCount . ', 总计=' . count($allUsers));
    }
}