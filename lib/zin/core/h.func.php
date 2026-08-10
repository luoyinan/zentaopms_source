<?php
/**
 * The html helper methods file of zin of ZenTaoPMS.
 *
 * @copyright   Copyright 2023 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @author      Hao Sun <sunhao@easycorp.ltd>
 * @package     zin
 * @version     $Id
 * @link        https://www.zentao.net
 */

namespace zin;

require_once __DIR__ . DS . 'h.class.php';

function h(...$args)          {return h::create(...$args);}
function div(...$args)        {return h::div(...$args);}
function span(...$args)       {return h::span(...$args);}
function strong(...$args)     {return h::strong(...$args);}
function small(...$args)      {return h::small(...$args);}
function code(...$args)       {return h::code(...$args);}
function canvas(...$args)     {return h::canvas(...$args);}
function br(...$args)         {return h::br(...$args);}
function a(...$args)          {return h::a(...$args);}
function p(...$args)          {return h::p(...$args);}
function img(...$args)        {return h::img(...$args);}
function button(...$args)     {return h::button(...$args);}
function h1(...$args)         {return h::h1(...$args);}
function h2(...$args)         {return h::h2(...$args);}
function h3(...$args)         {return h::h3(...$args);}
function h4(...$args)         {return h::h4(...$args);}
function h5(...$args)         {return h::h5(...$args);}
function h6(...$args)         {return h::h6(...$args);}
function ol(...$args)         {return h::ol(...$args);}
function ul(...$args)         {return h::ul(...$args);}
function li(...$args)         {return h::li(...$args);}
function template(...$args)   {return h::template(...$args);}
function formHidden(...$args) {return h::formHidden(...$args);}
function fieldset(...$args)   {return h::fieldset(...$args);}
function legend(...$args)     {return h::legend(...$args);}
function iframe(...$args)     {return h::iframe(...$args);}
function css(...$args)        {return h::css(...$args);}
