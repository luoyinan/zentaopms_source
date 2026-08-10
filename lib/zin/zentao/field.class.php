<?php

/**
 * The field class file of zin lib.
 *
 * @copyright   Copyright 2023 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @author      Hao Sun <sunhao@easycorp.ltd>
 * @package     zin
 * @version     $Id
 * @link        https://www.zentao.net
 */

namespace zin;

require_once dirname(__DIR__) . DS . 'core' . DS . 'setting.class.php';
require_once dirname(__DIR__) . DS . 'utils' . DS . 'dataset.class.php';

use \zin\fieldList;

class field extends setting
{
    public ?fieldList $fieldList;

    public ?string $dataType;

    public mixed $default;

    public function __construct($nameOrProps = null, $fieldList = null, $parent = null)
    {
        $this->fieldList = $fieldList;
        $this->parent    = $parent;

        if(is_string($nameOrProps))           $nameOrProps = array('name' => $nameOrProps);
        elseif($nameOrProps instanceof field) $nameOrProps = $nameOrProps->toArray();
        elseif(is_object($nameOrProps))       $nameOrProps = get_object_vars($nameOrProps);

        parent::__construct($nameOrProps);
    }

    public function getName()
    {
        return $this->get('name');
    }

    public function name($name)
    {
        return $this->setVal('name', $name);
    }

    public function type($type)
    {
        return $this->setVal('type', $type);
    }

    public function group($group)
    {
        return $this->setVal('group', $group);
    }

    public function id($id)
    {
        return $this->setVal('id', $id);
    }

    public function className(...$classList)
    {
        return $this->setClass('className', ...$classList);
    }

    public function value($value)
    {
        return $this->setVal('value', $value);
    }

    public function width($width)
    {
        return $this->setVal('width', $width);
    }

    public function required($required = true)
    {
        return $this->setVal('required', $required);
    }

    public function disabled($disabled = true)
    {
        return $this->setVal('disabled', $disabled);
    }

    public function readonly($readonly = true)
    {
        return $this->setVal('readonly', $readonly);
    }

    public function placeholder($placeholder)
    {
        return $this->setVal('placeholder', $placeholder);
    }

    public function foldable($foldable = true)
    {
        return $this->setVal('foldable', $foldable);
    }

    public function pinned($pinned = true)
    {
        return $this->setVal('pinned', $pinned);
    }

    public function hidden($hidden = true)
    {
        return $this->setVal('hidden', $hidden);
    }

    public function strong($strong = true)
    {
        return $this->setVal('strong', $strong);
    }

    public function label($label, $classOrProps = null)
    {
        $this->setVal('label', $label);
        if (is_string($classOrProps)) $this->labelClass($classOrProps);
        else if (!is_null($classOrProps)) $this->labelProps($classOrProps);
        return $this;
    }

    public function labelFor($for)
    {
        return $this->setVal('labelFor', $for);
    }

    public function labelClass(...$classList)
    {
        return $this->setClass('labelClass', ...$classList);
    }

    public function labelProps($props)
    {
        return $this->addToMap('labelProps', $props);
    }

    public function labelWidth($width)
    {
        return $this->setVal('labelWidth', $width);
    }

    public function labelHint($hint, $classOrProps = null)
    {
        $this->setVal('labelHint', $hint);
        if (is_string($classOrProps)) $this->labelHintClass($classOrProps);
        else if (!is_null($classOrProps)) $this->labelHintProps($classOrProps);
        return $this;
    }

    public function labelHintClass(...$classList)
    {
        return $this->setClass('labelHintClass', ...$classList);
    }

    public function labelHintProps($props)
    {
        return $this->addToMap('labelHintProps', $props);
    }

    public function labelHintIcon($icon)
    {
        return $this->setVal('labelHintIcon', $icon);
    }

    public function labelActions($actions, $reset = false, $key = null)
    {
        if($actions === false)  return $this->remove('actions');
        if($reset)              return $this->setVal('actions', $actions);
        if(is_array($actions))  return $this->mergeToList('actions', $actions, $key);
        return $this;
    }

    public function labelAction($action, $key = null)
    {
        return $this->addToList('labelActions', $action, $key);
    }

    public function labelActionsClass(...$classList)
    {
        return $this->setClass('labelActionsClass', ...$classList);
    }

    public function labelActionsProps($props)
    {
        return $this->addToMap('labelActionsProps', $props);
    }

    public function checkbox($checkbox = true)
    {
        return $this->setVal('checkbox', $checkbox);
    }

    public function wrapBefore($wrapBefore = true)
    {
        return $this->setVal('wrapBefore', $wrapBefore);
    }

    public function wrapAfter($wrapAfter = true)
    {
        return $this->setVal('wrapAfter', $wrapAfter);
    }

    public function wrap($side = 'before', $wrap = true)
    {
        return $this->setVal($side == 'before' ? 'wrapBefore' : 'wrapAfter', $wrap);
    }

    public function text($text)
    {
        return $this->setVal('text', $text);
    }

    public function tip($tip)
    {
        return $this->setVal('tip', $tip);
    }

    public function tipClass(...$classList)
    {
        return $this->setClass('tipClass', ...$classList);
    }

    public function tipProps($tipProps)
    {
        return $this->addToMap('tipProps', $tipProps);
    }

    public function multiple($multiple = true)
    {
        return $this->setVal('multiple', $multiple);
    }

    public function data($nameOrData, $value = null)
    {
        if(is_string($nameOrData)) $nameOrData = array($nameOrData => $value);
        return $this->addToMap('data', $nameOrData);
    }

    public function createChild($itemName = null)
    {
        $item = new field($itemName, null, $this);
        return $item;
    }

    public function control($control, $props = null)
    {
        if($control === false) return $this->remove('control');

        if(is_object($props)) $props = get_object_vars($props);
        if(is_string($control) && is_array($props)) $control = array('control' => $control) + $props;
        elseif($control instanceof node)            $control = node($control);

        return $this->setVal('control', $control);
    }

    public function controlBegin($itemName)
    {
        return $this->createChild($itemName);
    }

    public function controlEnd()
    {
        if(is_null($this->parent))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no parent, maybe you should call "controlBegin($name)" firstly.', E_USER_ERROR);
        }

        $control = $this->toArray();
        if(!isset($control['control'])) $control['control'] = $this->getName();
        unset($control['name']);

        return $this->parent->control($control);
    }

    /**
     * Set items.
     *
     * @access public
     * @param  array|false|null $items  - Items.
     * @return field
     */
    public function items($items)
    {
        if($items === false) return $this->remove('items');
        return $this->setVal('items', $items);
    }

    /**
     * Add item.
     */
    public function item($item, $key = null)
    {
        return $this->addToList('items', $item, $key);
    }

    public function itemBegin($itemName = null)
    {
        return $this->createChild($itemName);
    }

    public function itemEnd()
    {
        if(is_null($this->parent))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no parent, maybe you should call "itemBegin($name)" firstly.', E_USER_ERROR);
        }
        $this->parent->item($this);
        return $this->parent;
    }

    public function children(...$children)
    {
        return $this->mergeToList('children', $children);
    }

    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
        return $this;
    }

    public function moveBefore($name)
    {
        if(is_null($this->fieldList))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no fieldList, maybe you should add self to a fieldList firstly.', E_USER_ERROR);
        }
        $this->fieldList->moveBefore($this->getName(), $name);
        return $this;
    }

    public function moveAfter($name)
    {
        if(is_null($this->fieldList))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no fieldList, maybe you should add self to a fieldList firstly.', E_USER_ERROR);
        }
        $this->fieldList->moveAfter($this->getName(), $name);
        return $this;
    }

    public function moveToBegin()
    {
        if(is_null($this->fieldList))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no fieldList, maybe you should add self to a fieldList firstly.', E_USER_ERROR);
        }
        $this->fieldList->moveToBegin($this->getName());
        return $this;
    }

    public function moveToEnd()
    {
        if(is_null($this->fieldList))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no fieldList, maybe you should add self to a fieldList firstly.', E_USER_ERROR);
        }
        $this->fieldList->moveToEnd($this->getName());
        return $this;
    }

    public function detach()
    {
        if(is_null($this->fieldList))
        {
            trigger_error('[ZIN] The field named ' . $this->getName() . ' has no fieldList, maybe you should add self to a fieldList firstly.', E_USER_ERROR);
        }
        $this->fieldList->remove($this->getName());
        return $this;
    }

    public function toArray()
    {
        $array = parent::toArray();
        if(isset($array['items']))
        {
            $items = array();
            foreach($array['items'] as $key => $item)
            {
                if($item instanceof \zin\utils\dataset) $item = $item->toArray();
                elseif($item instanceof \stdClass)      $item = get_object_vars($item);
                $items[$key] = $item;
            }
            $array['items'] = $items;
        }
        if(isset($array['control']) && is_array($array['control']) && isset($array['control']['control']) && count($array['control']) == 1)
        {
            $array['control'] = $array['control']['control'];
        }
        return $array;
    }
}
