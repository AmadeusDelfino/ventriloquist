<?php

namespace Adelf\Ventriloquist\DataStructure;


use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\DataStructureValidator\Validators\StringValidator;

class StringStructure extends Base
{
    protected $dataDescribe = Constants::STRING_TYPE_DESCRIBE;

    protected $validators = [
        StringValidator::class,
    ];

    function resolver($value)
    {
        return (string) $value;
    }
}