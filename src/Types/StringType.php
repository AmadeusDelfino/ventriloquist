<?php

namespace Adelf\Ventriloquist\Types;


use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\TypeValidator\Validators\StringValidator;

class StringType extends Base
{
    protected $typeDescribe = Constants::STRING_TYPE_DESCRIBE;

    protected $validators = [
        StringValidator::class,
    ];

    function resolver($value)
    {
        return (string) $value;
    }
}