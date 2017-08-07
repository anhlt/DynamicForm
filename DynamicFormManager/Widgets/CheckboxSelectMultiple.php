<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/16/17
 * Time: 15:52:42
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class CheckboxSelectMultiple extends ChoiceWidget
{
    protected $allowMultipleSelected = true;
    protected $inputType = 'checkbox';
    protected $templateName = 'DynamicForm::checkboxselect';
    protected $optionTemplateName = 'DynamicForm::checkboxoption';
    public $wrap_label= true;
}