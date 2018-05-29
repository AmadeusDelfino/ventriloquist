<?php

namespace Adelf\Ventriloquist\DataStructureValidator;


use Adelf\Ventriloquist\Interfaces\TypeValidator;

class Validator implements TypeValidator
{
    protected $attributes;

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

    }
}