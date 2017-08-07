<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/13/17
 * Time: 18:55:56
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class SplitPhoneWidget extends MultiWidget
{
    protected $inputType = 'text';

    public function __construct(array $attributes = ['class' => 'form-control  form-xsmall'])
    {
        $widgets = [
            new TextInput($attributes),
            new TextInput($attributes),
            new TextInput($attributes),
        ];
        parent::__construct($attributes, $widgets);
    }


    protected function decompress($value)
    {
        return explode('-', $value);
    }
}