<?php

namespace Adelf\Ventriloquist\SmartQueryBase;


use Adelf\Ventriloquist\Interfaces\Node;

class Base implements Node
{
    protected $name;
    protected $structure;

    public function name($name = null)
    {
        if (is_null($name)) {
            return $this->name;
        }

        $this->name = $name;

        return $this;
    }

    public function structure($structure = null)
    {
        if(is_null($structure)) {
            return $this->structure;
        }

        $this->structure = $structure;

        return $this;
    }
}
