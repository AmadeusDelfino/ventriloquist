<?php

namespace Adelf\Ventriloquist\SmartQueryBase;


use Adelf\Ventriloquist\Interfaces\Node;

class Base implements Node
{
    protected $name;
    protected $structure;
    protected $handler;

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

    /**
     * @return callable|null
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param callable $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    public function needSelectInDatabase() : bool
    {
        return is_null($this->handler);
    }
}
