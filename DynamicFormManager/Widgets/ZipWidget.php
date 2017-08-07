<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/16/17
 * Time: 09:55:48
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class ZipWidget
    extends MultiWidget
{
    protected $inputType = 'text';

    public function __construct(array $attributes = ['class' => 'form-control  form-xsmall'])
    {
        $widgets = [
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