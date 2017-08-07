<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 6/6/17
 * Time: 19:30:07
 */

namespace App\Http\Controllers;


use App\Libraries\DynamicFormManager\Fields\CharField;
use App\Libraries\DynamicFormManager\Fields\MultipleSelectField;
use App\Libraries\DynamicFormManager\Fields\SelectField;
use App\Libraries\DynamicFormManager\Fields\ZipField;
use App\Libraries\DynamicFormManager\Forms\Form;
use App\Libraries\DynamicFormManager\Widgets\TextInput;

class FormDemo extends Form
{
    public function buildFields()
    {
        $this->fields['prefecture'] = new SelectField([
            'choices' => [1 => 'a', 2 => 'b'],
            'required' => true,
            'label' => 'abc',
        ]);


        $this->fields['city'] = new CharField([
            'widget' => new TextInput([
                'placeholder' => '市区町村',
                'class' => 'form-control'
            ]),
            'required' => true,
            'label' => 'cef',
            'validators' => ['string', 'max:256']
        ]);

        $this->fields['multi_select'] = new MultipleSelectField([
            'choices' => [1 => '1', 2 => 'abc'],
            'required' => true,
            'label' => '第三者検査',
        ]);


        $this->fields['zip'] = new ZipField([
            'label' => 'zip',
            'required' => true,
            'remarks' => 'zip input'
        ]);


    }
}