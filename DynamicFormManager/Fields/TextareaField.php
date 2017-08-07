<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/16/17
 * Time: 10:19:59
 */

namespace App\Libraries\DynamicFormManager\Fields;


use App\Libraries\DynamicFormManager\Widgets\TextareaInput;

class TextareaField extends Field
{
    public $widget = TextareaInput::class;

    public function clean($value)
    {
        return trim($value);
    }
}