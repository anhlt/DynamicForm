<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/8/17
 * Time: 10:46:52
 */

namespace App\Libraries\DynamicFormManager\Fields;

use App\Libraries\DynamicFormManager\Widgets\TextInput;

abstract class Field
{
    public $widget = TextInput::class;
    public $validators = [];
    public $formInline = false;
    public $label;

    /**
     * Field constructor.
     * @param bool $require
     * @param null $widget
     * @param null $label
     * @param null $initial
     * @param null $helpText
     * @param null $errorMessages
     * @param null $labelSuffix
     */
    protected $defaultOption = [
        'required' => false,
        'widget' => null,
        'label' => null,
        'initial' => null,
        'helpText' => null,
        'errorMessages' => null,
        'validators' => [],
        'disabled' => null,
        'labelSuffix' => null,
        'remarks' => null,
        'wrap_label' => true,
        'default_value' => null

    ];

    public function __construct(array $options = [])
    {
        $options = array_merge($this->defaultOption, $options);
        $require = $options['required'];
        $widget = $options['widget'];
        $label = $options['label'];
        $initial = $options['initial'];
        $helpText = $options['helpText'];
        $errorMessages = $options['errorMessages'];
        $validators = $options['validators'];
        $disabled = $options['disabled'];
        $labelSuffix = $options['labelSuffix'];
        $this->required = $require;
        $this->label = $label;
        $this->wrap_label = $options['wrap_label'];
        $this->initial = $initial;
        $this->remarks = $options['remarks'];
        $widget = is_null($widget) ? $this->widget : $widget;

        if (is_string($widget)) {
            /** @var \App\Libraries\DynamicFormManager\Widgets\Widget $widget */
            $widget = new $widget();
        }

        $this->disabled = $disabled;
        $widget->isRequired = $this->required;
        if ($this->required) {
            $this->validators[] = 'required';
        }
        $extraAttrs = $this->widgetAttrs($widget);
        $widget->attrs = array_merge($extraAttrs, $widget->attrs);
        $this->widget = $widget;
        $this->validators = $validators;
        if ($this->required) {
            $this->validators[] = 'required';
        }
    }

    public function widgetAttrs($widget)
    {
        return [];
    }

    public function boundData($data, $initial)
    {
        if ($this->disabled) {
            return $initial;
        }
        return $data;
    }

    public function prepareData($data)
    {
        return $data;
    }

    public function getBoundField($form, $fieldName, $options = [])
    {
        return new BoundField($form, $this, $fieldName, $options);
    }

    /**
     * @return array
     */
    public function getValidators()
    {
        return $this->validators;
    }

    public function names()
    {
    }

    public function clean($value)
    {
        return $value;
    }

    public function setWidget($widget)
    {
        $this->widget = $widget;
    }

    public function setRequired($value){
        $this->required = $value;
    }

    public function addValidatorRule($rules)
    {
        $this->validators[] = $rules;
    }
}



