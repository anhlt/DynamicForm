<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/16/17
 * Time: 10:09:27
 */

namespace App\Libraries\DynamicFormManager\Fields;


use App\Libraries\DynamicFormManager\Widgets\ZipWidget;

class ZipField extends Field
{
    public $widget = ZipWidget::class;
    public $formInline = true;

    public function __construct($options)
    {
        parent::__construct($options);
        $this->validators[] = 'numeric';
        $this->validators[] = 'digits_between:3,4';
    }

    public function clean($value)
    {
        return join('-', $value);
    }
}