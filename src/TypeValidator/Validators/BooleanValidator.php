<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;

class BooleanValidator extends Base
{
    public function is_valid(): bool
    {
        return is_bool($this->value);
    }
}