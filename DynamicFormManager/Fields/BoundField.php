<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/14/17
 * Time: 15:19:13
 */

namespace App\Libraries\DynamicFormManager\Fields;


use Illuminate\Support\Facades\View;

class BoundField
{

    public function __construct($form, $field, $name, $options = [])
    {
        /** @var \App\Libraries\DynamicFormManager\Forms\Form $form */
        $this->form = $form;
        /** @var \App\Libraries\DynamicFormManager\Fields\Field $field */
        $this->field = $field;
        $this->name = $name;
        if (isset($this->field->label)) {
            $this->label = $this->field->label;
        }else {
            $this->label = $name;
        }

        $defaultOption = ['template' => 'DynamicForm::wrapfield'];

        $options = array_merge($defaultOption, $options);

        $this->template = $options['template'];

        $this->htmlName = $form->addPrefix($name);
    }

    public function autoId()
    {
        $autoId = $this->form->autoId;
        if ($autoId) {
            return $this->htmlName;
        }

        return '';

    }

    public function data()
    {
        return $this->field->widget->dataFromArray($this->form->data, $this->htmlName);
    }

    public function value()
    {
        $data = $this->field->boundData($this->data(), []);
        return $this->field->prepareData($data);
    }

    public function getAllFieldName($widget = null, $attrs = null)
    {
        if (is_null($widget)) {
            $widget = $this->field->widget;
        }
        $attrs = is_null($attrs) ? [] : $attrs;
        $name = $this->htmlName;
        $value = $this->value();
        return $widget->getNames($name, $value, $attrs);
    }

    public function asWidget($widget = null, $attrs = null)
    {
        if (is_null($widget)) {
            $widget = $this->field->widget;
        }
        $attrs = is_null($attrs) ? [] : $attrs;
        $name = $this->htmlName;
        $value = $this->value();
        return $widget->render($name, $value, $attrs);
    }

    public function idForLabel()
    {
        $widget = $this->field->widget;
        $id = isset($widget->attrs['id']) ? $widget->attrs['id'] : $this->autoId();
        return $widget->idForLabel($id);
    }

    public function buildWidgetAttrs($attrs, $widget = null)
    {
        return $attrs;
    }

    public function errors()
    {
        $errors = [];
        foreach ($this->getAllFieldName() as $name) {
            $errors[] = $this->form->errors($name);
        }
        return $errors;
    }

    public function getContext($attrs)
    {
        return [
            'wrap_label' => $this->field->wrap_label,
            'label' => $this->label,
            'id_for_label' => $this->idForLabel(),
            'widget' => $this->asWidget(null, $attrs),
            'required' => $this->field->required,
            'errors' => $this->errors(),
            'remarks' => $this->field->remarks,
            'formInline' => $this->field->formInline
        ];
    }

    public function render($template = '', $attrs = [])
    {
        if (!$template) {
            $template = $this->template;
        }
        $view = View::make($template, $this->getContext($attrs));
        return $view->render();
    }

    public function displayValue()
    {
        $widget = $this->field->widget;
        return $widget->displayData($this->form->data, $this->htmlName);

    }


    public function getValidators()
    {
        $allRules = [];
        $rules = $this->field->getValidators();
        $fieldNames = $this->getAllFieldName();
        foreach ($fieldNames as $fieldName) {
            $allRules[$fieldName] = join('|', $rules);
        }
        return $allRules;
    }

    public function getName2Labels()
    {
        $names = $this->getAllFieldName();
        $results = [];
        if (count($names) > 1) {
            $i = 1;
            foreach ($names as $name) {
                $results += [$name => $this->field->label . ' ' . $i];
                $i++;
            }
        }else {
            foreach ($names as $name) {
                $results += [$name => $this->field->label];
            }
        }
        return $results;
    }
}