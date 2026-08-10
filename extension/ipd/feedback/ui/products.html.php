<?php
/**
 * The products view file of feedback module of ZenTaoPMS.
 * @copyright   Copyright 2009-2023 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Yuting Wang <wangyuting@easycorp.ltd>
 * @package     feedback
 * @link        https://www.zentao.net
 */
namespace zin;

featureBar(span(setClass('label secondary'), $lang->feedback->hasPrivUser));
toolbar
(
    item(set(array('text' => $lang->feedback->productSetting, 'url' => createLink('feedback', 'productSetting'), 'data-toggle' => 'modal', 'data-size' => 'lg')), setClass('ghost'), set::icon('cog-outline'))
);

$products = initTableData($productStats, $config->feedback->dtable->products->fieldList, $this->feedback);
dtable
(
    set::nested(true),
    set::cols(array_values($config->feedback->dtable->products->fieldList)),
    set::data(array_values($products)),
    set::onRenderCell(jsRaw('window.onRenderCell')),
    set::footPager(usePager())
);
