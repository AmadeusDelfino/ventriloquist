<?php

namespace App\Support\SmartQueryGenerator\SmartQueryBase;


use App\Support\SmartQueryGenerator\Interfaces\Node;

class ColumnNode implements Node
{
    protected $name;

    public function name($name = null)
    {
        if(is_null($name)) {
            return $this->name;
        }

        $this->name = $name;

        return $this;
    }
}