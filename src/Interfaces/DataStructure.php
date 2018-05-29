<?php

namespace Adelf\Ventriloquist\Interfaces;


interface DataStructure
{
    public function validators(): array;

    public function dataDescribe(): string;

    public function resolver($value);
}