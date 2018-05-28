<?php

namespace Adelf\Ventriloquist\Interfaces;


interface TypeValidator
{
    public function rules(array $rules = null);

    public function attributes(array $attributes = null);

    public function validate();
}