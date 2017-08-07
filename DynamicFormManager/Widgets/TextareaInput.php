<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/10/17
 * Time: 18:04:46
 */

namespace App\Libraries\DynamicFormManager\Widgets;


class TextareaInput extends Input
{
    protected $templateName = 'DynamicForm::textarea';

    public function __construct(array $attributes = ['class' => "autogrow form-control form-height-medium"])
    {
        $defaultAttribute = ['cols' => 40, 'rows' => 10];

        if ($attributes) {
            $attributes = array_merge($defaultAttribute, $attributes);
        }

        parent::__construct($attributes);
    }


}