<?php
/**
 * The ajaxViewDB view file of workflow module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Gang Liu <liugang@chandao.com>
 * @package     workflow
 * @link        https://www.zentao.net
 */
namespace zin;

div
(
    setID('tableDetail'),
    setClass('bg-surface border border-border rounded p-3'),
    tableData
    (
        set::title(sprintf($lang->workflowfield->detail, $table->name)),
        item(set::name($lang->workflowtable->name),   $table->name),
        item(set::name($lang->workflow->table),       $table->table),
        item(set::name($lang->workflowtable->module), $table->module)
    )
);
