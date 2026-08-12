<?php
/**
 * The login view file of dingtalk module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）集团有限公司(ZenTao Software (Qingdao) Co., Ltd. www.cnezsoft.com)
 * @license     ZPL(http://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     dingtalk
 * @version     $Id$
 * @link        https://www.zentao.net
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>钉钉登录</title>
    <style>
        body { margin: 0; padding: 0; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }
        .loading { text-align: center; color: #666; }
        .loading .spinner { display: inline-block; width: 32px; height: 32px; border: 3px solid #e0e0e0; border-top-color: #007bff; border-radius: 50%; animation: spin 0.8s linear infinite; }
        .loading p { margin-top: 16px; font-size: 14px; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div class="loading">
        <div class="spinner"></div>
        <p>正在获取钉钉身份信息...</p>
    </div>

    <script src="https://g.alicdn.com/dingding/dingtalk-jsapi/2.10.2/dingtalk.open.js"></script>
    <?php echo $phpConsoleLog; ?>
    <script>
    (function() {
        var corpId = '<?php echo $corpId; ?>';
        var loginURL = '<?php echo helper::createLink('dingtalk', 'login'); ?>';
        var fallbackURL = '<?php echo helper::createLink('user', 'login'); ?>';

        console.log('[DingTalk] corpId:', corpId);
        console.log('[DingTalk] loginURL:', loginURL);
        console.log('[DingTalk] fallbackURL:', fallbackURL);
        console.log('[DingTalk] User-Agent:', navigator.userAgent);
        console.log('[DingTalk] URL params:', window.location.search);

        var ddTimeout = setTimeout(function() {
            console.warn('[DingTalk] dd.ready() 超时(5s)，判定不在钉钉环境，跳转普通登录页');
            window.location.href = fallbackURL;
        }, 5000);

        if(typeof dd === 'undefined')
        {
            console.warn('[DingTalk] dd 对象未定义，判定不在钉钉环境，跳转普通登录页');
            clearTimeout(ddTimeout);
            window.location.href = fallbackURL;
        }
        else
        {
            console.log('[DingTalk] dd 对象已加载，等待 dd.ready()');
            dd.ready(function() {
                console.log('[DingTalk] dd.ready() 触发，开始获取 authCode');
                clearTimeout(ddTimeout);
                dd.runtime.permission.requestAuthCode({
                    corpId: corpId,
                    onSuccess: function(result) {
                        console.log('[DingTalk] requestAuthCode 成功, result:', JSON.stringify(result));
                        var authCode = result.authCode || result.code;
                        if(authCode)
                        {
                            console.log('[DingTalk] 获取到 authCode:', authCode.substring(0, 10) + '...');
                            var redirect = loginURL + (loginURL.indexOf('?') === -1 ? '?' : '&') + 'authCode=' + encodeURIComponent(authCode);
                            console.log('[DingTalk] 重定向到:', redirect);
                            window.location.href = redirect;
                        }
                        else
                        {
                            console.error('[DingTalk] authCode 为空, result:', JSON.stringify(result));
                            window.location.href = fallbackURL;
                        }
                    },
                    onFail: function(err) {
                        console.error('[DingTalk] requestAuthCode 失败, err:', JSON.stringify(err));
                        window.location.href = fallbackURL;
                    }
                });
            });
        }
    })();
    </script>
</body>
</html>