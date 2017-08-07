<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 3/29/17
 * Time: 10:13:05
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class RadioSelect extends ChoiceWidget
{
    protected $inputType = "radio";
    protected $templateName = 'DynamicForm::radio';
    protected $optionTemplateName = 'DynamicForm::radio_option';
    protected $checkedAttribute = ['checked' => true];
    public $default_value = null;
}
