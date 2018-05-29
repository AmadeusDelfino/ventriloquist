<?php

namespace Adelf\Ventriloquist\Abstracts;

use Adelf\Ventriloquist\Interfaces\Type as IType;
use Illuminate\Database\Eloquent\Model;

abstract class Type implements IType
{
    protected $model;

    abstract function attributes() : array;

    public function model(Model $model = null)
    {
        if(is_null($model)) {
            return $this->model;
        }

        $this->model = $model;

        return $this;
    }

    public function getAttribute($attribute)
    {
        return $this->attributes()[$attribute] ?? null;
    }

    public function isNestedType($attribute) : bool
    {
        $attr = $this->getAttribute($attribute);
        return isset($attr['type']);
    }
}
