<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;

class StringValidator extends Base
{
    public function is_valid(): bool
    {
        return is_string($this->value);
    }
}