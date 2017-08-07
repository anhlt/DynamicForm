<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/10/17
 * Time: 15:27:59
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class Input extends Widget
{
    protected $inputType = null;
    protected $templateName = 'DynamicForm::input';

    public function __construct(array $attributes = [])
    {
        $this->inputType = isset($attributes['type']) ? $attributes['type'] : $this->inputType;
        unset($attributes['type']);
        parent::__construct($attributes);
    }

    public function getContext($name, $value, $attrs = [])
    {
        $context = parent::getContext($name, $value, $attrs);
        $context['widget']['type'] = $this->inputType;
        return $context;
    }
}