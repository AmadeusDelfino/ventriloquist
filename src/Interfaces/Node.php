<?php

namespace Adelf\Ventriloquist\Interfaces;

interface Node
{
    public function name($name = null);

    public function structure($structure = null);

    public function getHandler();

    public function setHandler($handler);

    public function needSelectInDatabase() : bool;
}
