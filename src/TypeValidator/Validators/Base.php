<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;


use Adelf\Ventriloquist\Interfaces\Validator;

abstract class Base implements Validator
{
    protected $value;
    protected $subtype;

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

    /**
     * @return mixed
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * @param $subtype
     * @return $this
     */
    public function setSubtype($subtype)
    {
        $this->subtype = $subtype;

        return $this;
    }

    abstract function is_valid() : bool;
}