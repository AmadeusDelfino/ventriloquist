<?php

namespace Adelf\Ventriloquist\DataStructureValidator\Validators;

class BooleanValidator extends Base
{
    public function is_valid(): bool
    {
        return is_bool($this->value);
    }
}