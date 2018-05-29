<?php

namespace Adelf\Ventriloquist\DataStructureValidator\Validators;

class IntegerValidator extends Base
{
    public function is_valid(): bool
    {
        return is_integer($this->value);
    }
}