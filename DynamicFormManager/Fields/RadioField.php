<?php
namespace App\Libraries\DynamicFormManager\Fields;

use App\Libraries\DynamicFormManager\Widgets\RadioSelect;

class RadioField extends Field
{
    public $widget = RadioSelect::class;

    public function __construct($options)
    {
        $this->defaultOption['choices'] = [];
        $options = array_merge($this->defaultOption, $options);
        parent::__construct($options);

        $this->widget->choices = $options['choices'];
        $this->widget->wrap_label = $options['wrap_label'];
        $this->widget->default_value = $options['default_value'];
    }
}