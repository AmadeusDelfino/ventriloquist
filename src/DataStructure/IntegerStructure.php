<?php

namespace Adelf\Ventriloquist\DataStructure;


use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\DataStructureValidator\Validators\IntegerValidator;

class IntegerStructure extends Base
{
    protected $dataDescribe = Constants::INTEGER_STRUCTURE_DESCRIBE;

    protected $validators = [
        IntegerValidator::class,
    ];

    function resolver($value)
    {
        return (int) $value;
    }
}