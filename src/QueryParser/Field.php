<?php

namespace Adelf\Ventriloquist\QueryParser;


class Field
{
    protected $token;
    protected $handle;
    protected $selects = [];


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
        return is_null($this->handle);
    }
}