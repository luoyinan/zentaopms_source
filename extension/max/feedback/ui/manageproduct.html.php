<?php
/**
 * The manageProduct view file of feedback module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@chandao.com>
 * @package     feedback
 * @link        https://www.zentao.net
 */
namespace zin;

$grantFeedbackUsers = array();
$grantDevelopUsers  = array();
if(empty($view)) $developUsers = array_map(function($user) {return !empty($user->realname) ? $user->realname : $account;}, $users);
foreach($view as $account)
{
    if(!isset($users[$account])) continue;
    $user = $users[$account];
    if($user->feedback)  $grantFeedbackUsers[$account] = !empty($user->realname) ? $user->realname : $account;
    if(!$user->feedback) $grantDevelopUsers[$account]  = !empty($user->realname) ? $user->realname : $account;
    unset($users[$account]);
}

$grantDevelop  = array('allGrantDevlop'   => $lang->user->common) + $grantDevelopUsers;
$grantFeedback = array('allGrantFeedback' => $lang->user->common) + $grantFeedbackUsers;

$noGrantFeedbackUsers = array();
$noGrantDevelopUsers  = array();
foreach($users as $account => $user)
{
    if($user->feedback)  $noGrantFeedbackUsers[$account] = !empty($user->realname) ? $user->realname : $account;
    if(!$user->feedback) $noGrantDevelopUsers[$account]  = !empty($user->realname) ? $user->realname : $account;
}
$noGrantDevelop  = array('allNoGrantDevelop'  => $lang->user->common) + $noGrantDevelopUsers;
$noGrantFeedback = array('allNoGrantFeedback' => $lang->user->common) + $noGrantFeedbackUsers;

modalHeader(set::title($title));
formPanel
(
    $grantDevelopUsers ? formGroup
    (
        set::label($lang->feedback->grantUser),
        checkList
        (
            setData(array('on' => 'change', 'call' => 'changeAccounts', 'params' => 'event')),
            set::name('accounts[]'),
            set::items($grantDevelop),
            set::inline(true),
            set::value(array_keys($grantDevelop))
        )
    ) : null,
    $grantFeedbackUsers ? formGroup
    (
        set::label($grantDevelUsers ? '' : $lang->feedback->grantUser),
        checkList
        (
            setData(array('on' => 'change', 'call' => 'changeAccounts', 'params' => 'event')),
            set::name('accounts[]'),
            set::items($grantFeedback),
            set::inline(true),
            set::value(array_keys($grantFeedback))
        )
    ) : null,
    $noGrantDevelopUsers ? formGroup
    (
        set::label($lang->feedback->noGrantUser),
        checkList
        (
            setData(array('on' => 'change', 'call' => 'changeAccounts', 'params' => 'event')),
            set::name('accounts[]'),
            set::items($noGrantDevelop),
            set::inline(true)
        )
    ) : null,
    $noGrantFeedbackUsers ? formGroup
    (
        set::label($noGrantDevelUsers ? '' : $lang->feedback->noGrantUser),
        checkList
        (
            setData(array('on' => 'change', 'call' => 'changeAccounts', 'params' => 'event')),
            set::name('accounts[]'),
            set::items($noGrantFeedback),
            set::inline(true)
        )
    ) : null
);
