<?php

namespace Adelf\Ventriloquist\Types;

use Adelf\Ventriloquist\Constants;

class GenericType extends Base
{
    protected $typeDescribe = Constants::GENERIC_TYPE_DESCRIBE;

    function resolver($value)
    {
        return $value;
    }
}