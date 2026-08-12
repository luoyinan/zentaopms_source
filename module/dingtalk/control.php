<?php
/**
 * The control file of dingtalk module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）集团有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     dingtalk
 * @version     $Id$
 * @link        https://www.zentao.net
 */
class dingtalk extends control
{
    /**
     * DingTalk SSO login.
     *
     * DingTalk workbench appends authCode to the URL when user clicks the app.
     * This method exchanges the authCode for user info and logs the user in.
     * If no authCode is present, renders the DingTalk JSAPI view to obtain one.
     *
     * @access public
     * @return void
     */
    public function login()
    {
        $authCode = $this->get->authCode;

        $this->dingtalk->log('login() 开始处理钉钉登录请求');
        $this->dingtalk->log('login() URL: ' . $this->app->getURI());
        $this->dingtalk->log('login() 请求方法: ' . $_SERVER['REQUEST_METHOD']);
        $this->dingtalk->log('login() User-Agent: ' . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '未知'));
        $this->dingtalk->log('login() authCode: ' . ($authCode ? substr($authCode, 0, 10) . '...' : '无'));

        /* No authCode means might be initial load without JSAPI redirect.
         * Render the view page to use DingTalk JSAPI to get authCode. */
        if(!$authCode)
        {
            $this->dingtalk->log('login() 未检测到 authCode，渲染 JSAPI 视图页面');
            $this->dingtalk->log('login() corpId: ' . $this->config->dingtalk->corpId);

            $this->view->corpId       = $this->config->dingtalk->corpId;
            $this->view->phpConsoleLog = $this->dingtalk->getConsoleLogHTML();
            $_GET['zin'] = '0';
            $this->display();
            return false;
        }

        $this->dingtalk->log('login() 检测到 authCode，开始调用钉钉API获取用户信息');

        /* Get user info from DingTalk API. */
        $userInfo = $this->dingtalk->getUserInfo($authCode);
        if(!$userInfo)
        {
            $this->dingtalk->log('login() 失败: 钉钉API返回用户信息为空，authCode可能已过期');
            $loginLink = helper::createLink('user', 'login');
            return print(js::alert('钉钉登录验证失败，请联系管理员。') . js::locate($loginLink));
        }

        $userId = $userInfo->userid;
        $this->dingtalk->log('login() 成功获取用户信息, userid: ' . $userId . ', name: ' . (isset($userInfo->name) ? $userInfo->name : '未知'));

        /* Look up user by DingTalk userid in zt_user.dingding field. */
        $this->dingtalk->log('login() 开始查询系统用户, userid: ' . $userId);
        $user = $this->dingtalk->getUserByDingId($userId);
        if(!$user)
        {
            $this->dingtalk->log('login() 失败: 未找到 userid 对应的系统用户，请先绑定');
            $loginLink = helper::createLink('user', 'login');
            return print(js::alert('未找到绑定的系统用户，请先联系管理员绑定钉钉账号。') . js::locate($loginLink));
        }

        $this->dingtalk->log('login() 找到匹配用户, account: ' . $user->account . ', realname: ' . $user->realname);

        /* Log the user into ZenTao. */
        $this->dingtalk->log('login() 开始执行自动登录, account: ' . $user->account);
        $user = $this->loadModel('user')->login($user, true);
        if($user)
        {
            $this->dingtalk->log('login() 自动登录成功, 跳转到 my/index');
            return $this->locate(helper::createLink('my', 'index'));
        }

        $this->dingtalk->log('login() 自动登录失败, user->login() 返回空');
        $loginLink = helper::createLink('user', 'login');
        return $this->locate($loginLink);
    }

    /**
     * Sync DingTalk users to zt_user table.
     *
     * @access public
     * @return void
     */
    public function syncUsers()
    {
        $this->dingtalk->syncUsers();
    }
}