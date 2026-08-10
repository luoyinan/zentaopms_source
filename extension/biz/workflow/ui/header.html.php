<?php
namespace zin;

/**
 * 工作流编辑器公共头部（zin）。对应 view/header.html.php。
 */
if($editorMode == 'quick' && $flow->buildin) die(\js::error($lang->workflow->tips->buildinFlow) . \js::locate('back'));

$headerCssFile = dirname(__DIR__) . '/css/header.ui.css';
if(is_file($headerCssFile)) h::css(file_get_contents($headerCssFile));

jsVar('moduleName', $flow->module);
jsVar('editorMode', $editorMode);
jsVar('unknownError', $lang->workfloweditor->error->unknown);

$backLink        = $this->session->workflowList ? $this->session->workflowList : createLink('workflow', 'browseFlow');
$workflowGroupID = (int)$this->session->workflowGroupID;
$workflowGroup   = $this->loadModel('workflowgroup')->getById($workflowGroupID);
$workflowName    = $flow->name . ($workflowGroup ? " ({$lang->workflowgroup->template} : {$workflowGroup->name}) " : '');
$currentModule   = $this->app->getModuleName();
$currentMethod   = $this->app->getMethodName();

$stepList = $editorMode == 'quick' ? $lang->workfloweditor->quickSteps : $lang->workfloweditor->advanceSteps;
if($flow->buildin)
{
    unset($stepList['subTable']);
    unset($stepList['label']);
    unset($lang->workfloweditor->moreSettings['setReport']);
    unset($lang->workfloweditor->moreSettings['fulltext']);

    if(in_array($flow->module, $this->config->workflow->buildin->noApproval)) unset($lang->workfloweditor->moreSettings['approval']);
}

if($workflowGroupID > 0)
{
    unset($lang->workfloweditor->moreSettings['relation']);
    unset($lang->workfloweditor->moreSettings['setValue']);
    unset($lang->workfloweditor->moreSettings['setExport']);
    unset($lang->workfloweditor->moreSettings['setSearch']);
}

if($flow->module == 'cm' || $flow->module == 'projectchange')
{
    unset($lang->workfloweditor->moreSettings['setExport']);
    unset($lang->workfloweditor->moreSettings['setSearch']);
}

$stepUrls    = array();
$currentStep = -1;
$index       = 0;
$steps       = array();

foreach($stepList as $stepItem)
{
    $subMenu = array();
    if(isset($stepItem['subMenu'])) $subMenu = $stepItem['subMenu'];
    if(isset($stepItem['link']))    $stepItem = $stepItem['link'];

    list($label, $moduleName, $methodName) = explode('|', $stepItem);
    if($methodName == 'more')
    {
        foreach($lang->workfloweditor->moreSettings as $moreSetting)
        {
            $moreSetting = explode('|', $moreSetting);
            if($flow->module != 'charter' && $moreSetting[1] == 'workflow' && $moreSetting[2] == 'setapproval' && $config->edition == 'biz') continue;
            if(commonModel::hasPriv($moreSetting[1], $moreSetting[2]))
            {
                $moduleName = $moreSetting[1];
                $methodName = $moreSetting[2];
                $stepParams = $moduleName == 'workflow' && $methodName != 'setapproval' ? sprintf($moreSetting[3], $flow->id) : sprintf($moreSetting[3], $flow->type == 'table' ? $flow->parent : $flow->module);
                break;
            }
        }

        if($methodName == 'more') continue;
    }
    else
    {
        $stepParams = $flow->type == 'table' ? "module={$flow->parent}" : "module={$flow->module}";
        if(isset($currentAction)) $stepParams .= "&action={$currentAction->action}";
    }

    if($moduleName == 'workflowfield' && $methodName == 'browse') $stepParams .= "&orderBy=order&groupID={$workflowGroupID}";

    $stepUrl = createLink($moduleName, $methodName, $stepParams);

    if($currentModule == 'workflowfield' && $currentMethod == 'browse' && $flow->type == 'table')
    {
        $isCurrentStep = $moduleName == 'workflow' && $methodName == 'browsedb';
    }
    else
    {
        $isCurrentStep = (($currentModule == $moduleName && $currentMethod == $methodName) or (isset($subMenu[$currentModule]) && stripos(",{$subMenu[$currentModule]},", ",{$currentMethod},") !== false));
    }

    $steps[] = ['text' => $label, 'active' => $isCurrentStep, 'href' => $stepUrl];

    if($isCurrentStep) $currentStep = $index;

    $stepUrls[] = $stepUrl;

    $index++;
}

$menuLeft = array();
if($currentStep > 0 && isset($stepUrls[$currentStep - 1])) $menuLeft[] = a(setClass('btn primary prevStep'), set::href($stepUrls[$currentStep - 1]), $lang->workfloweditor->prevStep);

$menuRight = array();
if($editorMode == 'quick')
{
    $menuRight[] = btn(
        setID('saveBtn'),
        setClass('btn-default'),
        set::text($lang->save),
        set::btnType('button')
    );
}
if($currentStep == count($steps) - 1 && !$flow->buildin && $workflowGroupID == 0)
{
    $menuRight[] = a(
        setClass('btn primary iframe'),
        set::href(createLink('workflow', 'release', "id={$flow->id}")),
        set('data-toggle', 'modal'),
        set('data-size', 'sm'),
        $lang->workflow->release
    );
}
if(isset($stepUrls[$currentStep + 1])) $menuRight[] = a(setClass('btn primary nextStep'), set::href($stepUrls[$currentStep + 1]), $lang->workfloweditor->nextStep);

div(
    setID('editorNav'),
    div(
        setID('editorNavLeft'),
        a(
            setClass('btn btn-link'),
            set::href($backLink),
            icon('angle-left')
        ),
        strong($workflowName)
    ),
    div(
        setID('editorNavCenter'),
        strong(setClass('title'), $editorMode == 'quick' ? $lang->workfloweditor->quickEditor : $lang->workfloweditor->advanceEditor)
    )
);

if($editorMode == 'quick')
{
    div(
        setClass('modal fade'),
        setID('switchConfirmModal'),
        div(
            setClass('modal-dialog'),
            div(
                setClass('modal-content'),
                div(
                    setClass('modal-header'),
                    h::button(
                        setClass('close'),
                        set('data-dismiss', 'modal'),
                        set('type', 'button'),
                        span(set('aria-hidden', 'true'), '×')
                    )
                ),
                div(
                    setClass('modal-body text-center'),
                    p($lang->workfloweditor->switchConfirmMessage),
                    div(
                        a(
                            setClass('btn primary'),
                            set::href(createLink('workflowfield', 'browse', "module={$flow->module}&orderBy=order&groupID={$workflowGroupID}")),
                            $lang->workfloweditor->confirmSwitch
                        ),
                        h::button(
                            setClass('btn'),
                            set('data-dismiss', 'modal'),
                            set('type', 'button'),
                            $lang->workfloweditor->cancelSwitch
                        )
                    )
                )
            )
        )
    );
}

div(
    setID('editorMenu'),
    h::create(
        'nav',
        setID('editorSteps'),
        setClass('editor-steps-' . $editorMode),
        div
        (
            setClass('flex justify-center mb-4'),
            nav
            (
                setClass('border'),
                set::type('steps'),
                set::items($steps)
            )
        )
    ),
    div(setID('editorMenuLeft'), $menuLeft),
    div(setID('editorMenuRight'), $menuRight)
);

if($editorMode == 'quick')
{
    div(
        setClass('modal fade'),
        setID('confirmReleaseModal'),
        div(
            setClass('modal-dialog'),
            div(
                setClass('modal-content'),
                div(
                    setClass('modal-header'),
                    h::button(
                        setClass('close'),
                        set('data-dismiss', 'modal'),
                        set('type', 'button'),
                        span(set('aria-hidden', 'true'), '×')
                    )
                ),
                div(
                    setClass('modal-body text-center'),
                    p($lang->workfloweditor->confirmReleaseMessage),
                    div(
                        a(
                            setClass('btn primary'),
                            set::href(createLink('workflowfield', 'browse', "module={$flow->module}")),
                            $lang->workfloweditor->enterToAdvance
                        ),
                        a(
                            setClass('btn secondary release'),
                            set::href(createLink('workflow', 'release', "id={$flow->id}")),
                            set('data-toggle', 'modal'),
                            $lang->workfloweditor->continueRelease
                        )
                    )
                )
            )
        )
    );
}
