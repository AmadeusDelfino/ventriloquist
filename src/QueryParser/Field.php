<?php

namespace Adelf\Ventriloquist\QueryParser;


use Adelf\Ventriloquist\Interfaces\Node;

class Field
{
    protected $token;
    protected $handle;
    protected $selects = [];
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Field
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return callable
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param callable $handle
     * @return Field
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * @return array
     */
    public function getSelects(): array
    {
        return $this->selects;
    }

    /**
     * @param array $selects
     * @return Field
     */
    public function setSelects(array $selects)
    {
        $this->selects = $selects;

        return $this;
    }

    public function needSelectInDatabase() : bool
    {
        foreach($this->selects as $select) {
            if($select->needSelectInDatabase()) {
                return true;
            }
        }

        return false;
    }

    public function tokenWithSelect()
    {
        if(count(($selects = $this->makeSelectStringForModel())) == 0) {
            return null;
        }


        return $this->token . ':' . implode(',', $selects);
    }

    private function makeSelectStringForModel()
    {

        return array_filter(array_map(function (Node $node) {
            if($node->needSelectInDatabase()) {
                return $node->name();
            }
        }, array_values($this->selects)));
    }
}