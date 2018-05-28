<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;

use Adelf\Ventriloquist\Interfaces\Validator;

class Integer implements Validator
{
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function is_valid(): bool
    {
        return is_integer($this->value);
    }
}