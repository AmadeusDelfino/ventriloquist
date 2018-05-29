<?php

namespace Adelf\Ventriloquist\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface Type
{
    public function attributes() : array;

    public function model(Model $model = null);

    public function getAttribute($attribute);

    public function isNestedType($attribute) : bool;
}