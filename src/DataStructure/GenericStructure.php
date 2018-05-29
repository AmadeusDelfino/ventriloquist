<?php

namespace Adelf\Ventriloquist\DataStructure;

use Adelf\Ventriloquist\Constants;

class GenericStructure extends Base
{
    protected $dataDescribe = Constants::GENERIC_STRUCTURE_DESCRIBE;

    function resolver($value)
    {
        return $value;
    }
}