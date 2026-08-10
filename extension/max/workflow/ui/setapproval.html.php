<?php
/**
 * The setapproval file of workflow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang<wangyuting@easycorp.ltd>
 * @package     workflow
 * @link        https://www.zentao.net
 */
namespace zin;
include __DIR__ . '/header.html.php';
include __DIR__ . '/side.html.php';

$coverHTML = $existsMessage ? "<div><div>{$lang->workflowapproval->conflict[1]}</div><div class='mt-2'>{$existsMessage}</div><div class='mt-2'>{$lang->workflowapproval->conflict[2]}</div><div class='mt-2'>{$lang->workflowapproval->conflict[3]}</div><div class='text-danger mt-2'>{$lang->workflowapproval->conflict[4]}</div></div>" : '';
if($module == 'charter')
{
    $charterGroups = array();
    foreach($lang->workflow->charterApproval as $key => $label)
    {
        $charterGroups[] = formGroup
        (
            set::width('1/2'),
            set::required(true),
            set::label($label),
            inputGroup
            (
                picker
                (
                    set::name("approvalFlow[$key]"),
                    set::items($approvalFlows),
                    set::value($approvalFlow[$key]),
                    setData(array('on' => 'change', 'call' => 'changeApprovalFlow', 'params' => 'event'))
                ),
                hasPriv('approvalflow', 'design') && $approvalFlow[$key] ? a(setClass('btn bg-primary-100 text-primary ml-2 designBtn'), set::href(createLink('approvalflow' , 'design', "id={$approvalFlow[$key]}")), set::target('_blank'), $lang->design->common) : null
            )
        );
    }
}
else
{
    $approvalFlowID = !empty($approvalFlow) ? current($approvalFlow) : '';
}

jsVar('confirmTitle', $lang->workflowapproval->conflict[0]);
jsVar('confirmContent', $coverHTML);
jsVar('confirmedBtn', $lang->workflow->cover);

div
(
    setClass('flex mt-2'),
    cell
    (
        setClass('shadow'),
        $sideBar
    ),
    formPanel
    (
        $module != 'charter' && $coverHTML ? set::ajax(array('beforeSubmit' => jsRaw('beforeSubmit'))) : null,
        setClass('bg-canvas flex-1 ml-6 shadow'),
        setStyle(array('max-width' => '100%')),
        set::actions(array('submit')),
        set::title($title),
        $module != 'charter' ? formGroup
        (
            set::label($lang->workflow->status),
            radioList
            (
                set::name('approval'),
                set::inline(true),
                set::items($lang->workflowapproval->approvalList),
                set::value($flow->approval),
                setData(array('on' => 'change', 'call' => 'changeApproval', 'params' => 'event'))
            )
        ) : null,
        $module != 'charter' ? formGroup
        (
            set::width('1/2'),
            setClass($approvalFlowID ? '' : 'hidden', 'approvalflowBox'),
            set::required(true),
            set::label($lang->workflowapproval->approvalFlow),
            inputGroup
            (
                picker
                (
                    set::name('approvalFlow'),
                    set::items($approvalFlows),
                    set::value($approvalFlowID),
                    set::required(true),
                    setData(array('on' => 'change', 'call' => 'changeApprovalFlow', 'params' => 'event'))
                ),
                hasPriv('approvalflow', 'design') && $approvalFlowID ? a(setClass('btn bg-primary-100 text-primary ml-2 designBtn'), set::href(createLink('approvalflow' , 'design', "id=$approvalFlowID")), set::target('_blank'), $lang->design->common) : null,
                hasPriv('approvalflow', 'create') ? a(setClass('btn bg-primary-100 text-primary ml-2'), set::href(createLink('approvalflow' , 'create', "workflow={$flow->module}")), $lang->create . $lang->approvalflow->common, setData(array('toggle' => 'modal'))) : null
            )
        ) : null,
        $module == 'charter' ? $charterGroups : null,
        $module == 'charter' ? input(set::name('approval'), set::value('enabled'), setClass('hidden')) : null,
        $module != 'charter' ? input(set::name('cover'),    set::value('1'),       setClass('hidden')) : null
    )
);
