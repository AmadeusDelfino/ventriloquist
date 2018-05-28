<?php

namespace Adelf\Ventriloquist\Types;


use Adelf\Ventriloquist\Exceptions\TypeDescribeInvalidException;
use Adelf\Ventriloquist\Interfaces\Type;

abstract class Base implements Type
{
    protected $validators = [];
    protected $typeDescribe;

    /**
     * @return array
     */
    public function validators(): array
    {
        return $this->validators;
    }

    /**
     * @return StringType
     * @throws TypeDescribeInvalidException
     */
    public function typeDescribe(): string
    {
        if(is_null($this->typeDescribe)) {
            throw new TypeDescribeInvalidException();
        }

        return $this->typeDescribe;
    }

    abstract function resolver($value);
}