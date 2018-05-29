<?php

namespace Adelf\Ventriloquist\Interfaces;


interface TypeValidator
{
    public function attributes(array $attributes = null);

    public function validate();
}