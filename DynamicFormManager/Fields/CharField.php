<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/14/17
 * Time: 11:20:31
 */

namespace App\Libraries\DynamicFormManager\Fields;


class CharField extends Field
{
    /**
     * Field constructor.
     * @param bool $require
     * @param null $widget
     * @param null $label
     * @param null $initial
     * @param null $helpText
     * @param null $errorMessages
     * @param null $labelSuffix
     */
    public function __construct($options = []
    ){
        $this->defaultOption['maxLength'] = null;
        $this->defaultOption['minLength'] = null;
        $options = array_merge($this->defaultOption, $options);

        parent::__construct($options);
        if ($options['maxLength']) {
            $this->validator[] = 'max:' . $options['maxLength'];
        }
        if ($options['minLength']) {
            $this->validator[] = 'min:' . $options['minLength'];
        }

    }

    public function clean($value)
    {
        return trim($value);
    }

}