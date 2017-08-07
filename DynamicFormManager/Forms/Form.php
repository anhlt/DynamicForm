<?php
namespace App\Libraries\DynamicFormManager\Forms;


use App\Libraries\DynamicFormManager\Fields\Field;
use Illuminate\Support\Facades\View;

class Form
{
    public $fields = [];
    protected $boundedFields = [];
    protected $errors = [];

    public function __construct(
        $data = null,
        $options = []
    ){
        $defaultOptions = [
            'autoId' => 'id_%s',
            'prefix' => null,
            'initial' => null,
            'wrapTemplate' => null
        ];
        $options = array_merge($defaultOptions, $options);


        $this->isBound = !is_null($data);
        $this->data = !is_null($data) ? $data : [];
        $this->autoId = $options['autoId'];

        if (isset($options['prefix'])) {
            $this->prefix = $options['prefix'];
        }

        $this->initial = (isset($options['initial'])) ? $options['initial'] : [];
        $this->errors = collect([]);
        $this->wrapTemplate = $options['wrapTemplate'];
        $this->buildFields();
    }

    public function buildFields()
    {
        $this->fields = [];
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }

    public function __get($name)
    {
        $boundFieldOptions = [];
        if (isset($this->wrapTemplate)) {
            $boundFieldOptions['template'] = $this->wrapTemplate;
        }

        if (array_key_exists($name, $this->fields)) {
            if (!array_key_exists($name, $this->boundedFields)) {
                $this->boundedFields[$name] = $this->fields[$name]->getBoundField($this, $name, $boundFieldOptions);
            }
            return $this->boundedFields[$name];
        }
    }

    public function errors($name)
    {
        $message = '';
        if ($this->errors->has($name)) {
            $message = $this->errors->first($name);
        }

        return $message;
    }


    public function addPrefix($fieldName)
    {
        return isset($this->prefix) ? $this->prefix . '_' . $fieldName : $fieldName;
    }

    public function getContext()
    {
        $context = [];
        $context['fields'] = [];
        foreach ($this->fields as $name => $field) {
            $bf = $this->$name;
            $context['fields'][] = $bf->render();
        }
        return $context;
    }

    public function render()
    {
        $view = View::make('DynamicForm::formgroup', $this->getContext());
        return $view->render();
    }


    public function rules()
    {
        $rule = [];
        foreach ($this->fields as $name => $field) {
            $rule += $this->$name->getValidators();
        }
        return $rule;
    }

    public function rule_name()
    {
        $rule = [];
        foreach ($this->fields as $name => $field) {
            $rule += $this->$name->getName2Labels();
        }
        return $rule;
    }

    /**
     *
     */
    public function cleans()
    {
        $data = [];
        /** @var Field $field */
        foreach ($this->fields as $name => $field) {
            $value = $field->widget->dataFromArray($this->data, $name);
            $data[$name] = $field->clean($value);
        }

        return $data;

    }

    /**
     * @param null $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function field2label()
    {
        $result = [];

        foreach ($this->fields as $key => $field) {
            if ($field->label) {
                $result += [$key => $field->label];
            }
        }

        return $result;
    }
}
