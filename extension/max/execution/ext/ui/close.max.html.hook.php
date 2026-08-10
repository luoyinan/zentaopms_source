<?php
namespace zin;

$execution      = data('execution');
$createDocUrl   = data('createDocUrl');
$uploadDocUrl   = data('uploadDocUrl');
$hasDeliverable = data('hasDeliverable');
if($hasDeliverable && empty($execution->isTpl))
{
    global $lang;
    $project      = data('project');
    $deliverables = data('deliverables');
    $categories   = data('categories');
    if($execution->status == 'doing' && $execution->grade == 1 && $project->model != 'kanban')
    {
        jsVar('submittedLang', $lang->project->submitted);
        jsVar('notSubmitLang', $lang->project->notSubmit);

        foreach($categories as $key => $category) $categories[$key]['required'] = (bool)!empty($category['required']);

        /* 追加交付物组件。 */
        $deliverable = formGroup
        (
            set::label($lang->project->deliverableAbbr),
            deliverable
            (
                set::items($deliverables),
                set::categories($categories),
                set::projectID($execution->project),
                set::createDocUrl($createDocUrl),
                set::uploadDocUrl($uploadDocUrl),
                set::onRenderItem(jsRaw('handleRenderDeliverableItem'))
            )
        );
        query('formPanel')->append($deliverable);
    }
}
