<?php
/**
 * The productsetting view file of feedback module of ZenTaoPMS.
 * @copyright   Copyright 2009-2024 禅道软件（青岛）有限公司(ZenTao Software (Qingdao) Co., Ltd. www.zentao.net)
 * @license     ZPL(https://zpl.pub/page/zplv12.html) or AGPL(https://www.gnu.org/licenses/agpl-3.0.en.html)
 * @author      Shujie Tian <tianshujie@chandao.com>
 * @package     feedback
 * @link        https://www.zentao.net
 */
namespace zin;

$items = array();
$items[] = array('label' => $lang->idAB,                     'name' => 'id',        'control' => 'index', 'width' => '60px');
$items[] = array('label' => $lang->tree->root,               'name' => 'product',   'control' => 'input',  'value' => $product->name, 'disabled' => true);
$items[] = array('label' => $lang->feedback->feedbackModule, 'name' => 'name',      'control' => 'input', 'disabled' => true);
$items[] = array('label' => $lang->feedback->productModule,  'name' => 'mergeFrom', 'control' => 'input', 'items' => $productModules, 'className' => 'hidden');
$items[] = array('label' => $lang->feedback->productModule,  'name' => 'mergeTo',   'control' => 'picker', 'items' => $productModules, 'value' => '0');

$i        = 1;
$dataList = array();
foreach($mergeList as $id => $moduleName)
{
    $dataList[] = array('mergeFrom' => $id, 'name' => $moduleName);

    $i ++;
    if($i > $recPerPage) break;
}

formBatchPanel
(
    set::title($lang->feedback->mergeModule),
    set::mode('edit'),
    set::data($dataList),
    set::items($items)
);

query('.form-actions')->prepend(html('<div>' . sprintf($lang->feedback->mergeTip, $mergeCount, ceil($mergeCount / $recPerPage)) . '</div>'));
