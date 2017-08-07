<?php
namespace App\Libraries\DynamicFormManager\Fields;

use App\Libraries\DynamicFormManager\Widgets\HiddenWidget;

class HiddenField extends  Field
{
    public $wrap_label = false;
    public $widget = HiddenWidget::class;


}