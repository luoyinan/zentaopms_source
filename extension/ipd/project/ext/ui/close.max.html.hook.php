<?php
namespace zin;
global $lang;

$project        = data('project');
$deliverables   = data('deliverables');
$categories     = data('categories');
$createDocUrl   = data('createDocUrl');
$uploadDocUrl   = data('uploadDocUrl');
$hasDeliverable = data('hasDeliverable');
if($hasDeliverable && $project->status == 'doing' && $project->model != 'kanban')
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
            set::projectID($project->id),
            set::createDocUrl($createDocUrl),
            set::uploadDocUrl($uploadDocUrl),
            set::onRenderItem(jsRaw('handleRenderDeliverableItem'))
        )
    );
    query('formPanel')->append($deliverable);
}
