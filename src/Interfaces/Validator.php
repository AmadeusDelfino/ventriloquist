<?php

namespace Adelf\Ventriloquist\Interfaces;


interface Validator
{
    public function getValue();

    public function setValue($value);

    public function is_valid() : bool;
}