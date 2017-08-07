<?php
namespace App\Libraries\DynamicFormManager\Widgets;


abstract class MultiWidget extends Widget
{
    protected $templateName = 'DynamicForm::multiwidget';

    protected $widgets = [];

    public function __construct(array $attributes = [], $widgets)
    {
        foreach ($widgets as $widget) {
            $this->widgets[] = $widget;
        }
        parent::__construct($attributes);
    }

    public function getContext($name, $value, $attrs = [])
    {
        $context = parent::getContext($name, $value, $attrs);
        if (!is_array($value)) {
            $value = $this->decompress($value);
        }
        $finalAttrs = $context['widget']['attrs'];
        $inputType = isset($finalAttrs['type']) ? $finalAttrs['type'] : null;
        unset($finalAttrs['type']);
        $id = isset($finalAttrs['id']) ? $finalAttrs['id'] : null;

        $subwidgets = [];

        foreach ($this->widgets as $key => $widget) {
            if (!is_null($inputType)) {
                $widget->inputType = $inputType;

            }
            $widgetName = $name . '_' . $key;
            $widgetValue = isset($value[$key]) ? $value[$key] : null;
            $widgetAttrs = $finalAttrs;
            if ($id) {
                $widgetAttrs['id'] = $id . "_" . $key;
            }

            $subwidgets[] = $widget->getContext($widgetName, $widgetValue, $widgetAttrs);
        }
        $context['widget']['subwidgets'] = $subwidgets;

        return $context;
    }

    public function dataFromArray($data, $name)
    {
        foreach ($this->widgets as $key => $widget) {
            $newdata[] = $widget->dataFromArray($data, $name . '_' . $key);
        }
        if (!isset($newdata[0])) {
            return parent::dataFromArray($data, $name);
        }
        return $newdata;
    }


    abstract protected function decompress($value);

    public function getNames($name, $value)
    {
        $names = [];
        $context = $this->getContext($name, $value);
        foreach ($context['widget']['subwidgets'] as $subwidget) {
            $names[] = $subwidget['widget']['name'];
        }
        return $names;
    }
}