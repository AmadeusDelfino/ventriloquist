<?php

namespace Adelf\Ventriloquist\Types;


use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\TypeValidator\Validators\IntegerValidator as IntegerValidator;

class IntegerType extends Base
{
    protected $typeDescribe = Constants::INTEGER_TYPE_DESCRIBE;

    protected $validators = [
        IntegerValidator::class,
    ];

    function resolver($value)
    {
        return (int) $value;
    }
}