<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 3/13/17
 * Time: 10:29:52
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class FileInput extends Input
{
    protected $inputType = 'file';
    protected $needMultipartForm = true;
    protected $templateName = 'DynamicForm::fileinput';

    public function formatValue($value)
    {
        return null;
    }
}