<?php

namespace Adelf\Ventriloquist\DataStructureValidator\Validators;

class StringValidator extends Base
{
    public function is_valid(): bool
    {
        return is_string($this->value);
    }
}