<?php

namespace Adelf\Ventriloquist\TypeValidator\Validators;

class ListValidator extends Base
{
    public function is_valid(): bool
    {
        return is_array($this->value) && $this->subtypeIsValid();
    }

    private function subtypeIsValid()
    {
        $subtype = $this->getSubtype();

        foreach($this->value as $sub) {
            if(! ($sub instanceof $subtype)) {
                return false;
            }
        }

        return true;
    }
}
