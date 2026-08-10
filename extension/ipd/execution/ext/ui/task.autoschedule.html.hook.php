<?php
/**
 * The autoSchedule view file of project module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Fangzhou Hu<hufangzhou@chandao.com>
 * @package     project
 * @link        https://www.zentao.net
 */
namespace zin;

global $lang, $app;

$project = $app->control->loadModel('project')->getById(data('execution.project'));

jsVar('hasSchedulePriv',  hasPriv('task', 'autoSchedule'));
jsVar('projectModel',     $project->model);
jsVar('hasTasks',         !empty(data('tasks')));
jsVar('autoScheduleLang', $lang->project->autoSchedule);
jsVar('executionID',      data('execution.id'));
jsVar('currentApp',       $app->tab);
jsVar('isTplProject',    !empty($project->isTpl));
