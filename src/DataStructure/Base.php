<?php

namespace Adelf\Ventriloquist\DataStructure;


use Adelf\Ventriloquist\Exceptions\DataDescribeInvalidException;
use Adelf\Ventriloquist\Interfaces\DataStructure;

abstract class Base implements DataStructure
{
    protected $validators = [];
    protected $dataDescribe;

    /**
     * @return array
     */
    public function validators(): array
    {
        return $this->validators;
    }

    /**
     * @return StringStructure
     * @throws DataDescribeInvalidException
     */
    public function dataDescribe(): string
    {
        if(is_null($this->dataDescribe)) {
            throw new DataDescribeInvalidException();
        }

        return $this->dataDescribe;
    }

    abstract function resolver($value);
}