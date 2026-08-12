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

        /* The listsub API returns dept_list with sub-department objects. */
        $deptList = array();
        if(isset($info->result->dept_list)) $deptList = $info->result->dept_list;

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