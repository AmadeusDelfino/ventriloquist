<?php

namespace Adelf\Ventriloquist\Interfaces;


interface Type
{
    public function validators(): array;

    public function typeDescribe(): string;

    public function resolver($value);
}