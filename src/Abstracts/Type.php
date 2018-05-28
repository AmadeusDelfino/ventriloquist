<?php

namespace Adelf\Ventriloquist\Abstracts;

abstract class Type
{
    protected $model;

    abstract function attributes() : array;
}