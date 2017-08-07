<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/10/17
 * Time: 10:22:32
 */

namespace App\Libraries\DynamicFormManager\Widgets;

use Illuminate\Support\Facades\View;

class Render
{
    static public function render($widget, $name, $value, $attrs)
    {
        $view = View::make($widget->getTemplate(), $widget->getContext($name, $value, $attrs));
        return $view->render();
    }
}

class Widget
{
    public $attrs = ['suffix' => ''];
    public $isRequired = false;

    public function __construct(array $attributes = [])
    {
        $this->attrs = array_merge($this->attrs, $attributes);
    }

    public function isHidden()
    {
        return isset($this->input_type) ? $this->input_type == 'hidden' : false;
    }

    public function getContext($name, $value, $attrs = [])
    {
        $context = [];
        $context['widget'] = [
            'name' => $name,
            'is_hidden' => $this->isHidden(),
            'required' => $this->isRequired,
            'value' => $this->formatValue($value),
            'attrs' => $this->buildAttrs($this->attrs, $attrs),
            'template_name' => $this->templateName,
        ];
        return $context;
    }

    public function getNames($name, $value)
    {
        return [$name];
    }

    public function getLabel($name, $value)
    {
        return [$name => $this->label];
    }

    protected function buildAttrs($baseAttrs, $extraAttrs)
    {
        return array_merge($baseAttrs, $extraAttrs);
    }

    protected function formatValue($value)
    {
        if (!isset($value)) {
            return '';
        }

        return $value;
    }

    public function getTemplate()
    {
        return $this->templateName;
    }

    public function setTemplate($template)
    {
        $this->templateName = $template;
    }

    public function getData()
    {
        return $this->attrs;
    }

    public function idForLabel($id)
    {
        return $id;
    }

    public function dataFromArray($data, $name)
    {
        return isset($data[$name]) ? $data[$name] : null;
    }

    public function displayData($data, $name)
    {
        return $this->dataFromArray($data, $name);
    }

    public function render($name, $value, $attrs = [], $renderer = Render::class)
    {
        return $renderer::render($this, $name, $value, $attrs);
    }

    public function displayValue($value){
        return $value;
    }
}
