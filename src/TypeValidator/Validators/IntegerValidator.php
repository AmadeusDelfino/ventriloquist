<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;

class IntegerValidator extends Base
{
    public function is_valid(): bool
    {
        return is_integer($this->value);
    }
}