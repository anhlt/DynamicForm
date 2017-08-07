<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/15/17
 * Time: 11:10:51
 */

namespace App\Libraries\DynamicFormManager\Fields;

use App\Libraries\DynamicFormManager\Widgets\SplitPhoneWidget;

class PhoneField extends Field
{
    public $widget = SplitPhoneWidget::class;
    public $formInline = true;

    public function __construct($options)
    {
        parent::__construct($options);
        $this->validators[] = 'numeric';
        $this->validators[] = 'digits_between:2,5';
    }

    public function clean($value)
    {
        return join('-', $value);
    }
}