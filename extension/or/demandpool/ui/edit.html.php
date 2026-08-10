<?php
/**
 * The create view file of issue module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@easycorp.ltd>
 * @package     issue
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = useFields('demandpool.edit');

jsVar('hasReview', $lang->demandpool->hasReview);
jsVar('poolID', $demandpool->id);
jsVar('+oldOwners', explode(',', $demandpool->owner));
jsVar('+oldReviewers', explode(',', $demandpool->reviewer));
formGridPanel
(
    set::title($lang->demandpool->edit),
    on::change('[name^=owner]', 'changeOwner'),
    on::change('[name^=reviewer]', 'changeReviewer'),
    set::modeSwitcher(false),
    set::layout('horz'),
    set::fields($fields)
);
