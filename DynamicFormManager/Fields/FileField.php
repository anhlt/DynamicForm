<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 3/13/17
 * Time: 11:00:04
 */

namespace App\Libraries\DynamicFormManager\Fields;


use App\Libraries\DynamicFormManager\Widgets\FileInput;

class FileField extends Field
{
    public $widget = FileInput::class;


}