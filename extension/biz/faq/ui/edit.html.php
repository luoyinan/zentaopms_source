<?php
/**
 * The create view file of faq module of ZenTaoPMS.
 * @copyright   Copyright 2009-2026 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Qiyu Xie <xieqiyu@chandao.com>
 * @package     faq
 * @link        https://www.zentao.net
 */
namespace zin;

$fields = useFields('faq');
$fields->autoLoad('product', 'module');
$fields->field('module')->value($faq->module);
$fields->field('question')->value($faq->question);
$fields->field('answer')->value($faq->answer);

formGridPanel
(
    set::title($lang->faq->create),
    set::fields($fields),
    set::loadUrl($loadUrl)
);
