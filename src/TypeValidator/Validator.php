<?php

namespace Adelf\Ventriloquist\TypeValidator;

use Adelf\Ventriloquist\Interfaces\TypeValidator;

class Validator implements TypeValidator
{
    protected $attributes;

    public function rules(array $rules = null)
    {
        // TODO: Implement rules() method.
    }

    public function attributes(array $attributes = null)
    {
        if(is_null($attributes)) {
            return $this->attributes;
        }

        $this->attributes;

        return $this;
    }

    public function validate()
    {
        // TODO: Implement validate() method.
    }
}