<?php

namespace Adelf\Ventriloquist;


use Adelf\Ventriloquist\Handlers\ParseNode;

class NodeParser
{
    public function parse($smartQuery)
    {
        return array_map([$this, 'parseNode'], $smartQuery);
    }

    private function isValidNode($rawNode)
    {
        if(isset($rawNode->name)) {
            return true;
        }

        return false;
    }

    private function parseNode($rawNode)
    {
        if($this->isValidNode($rawNode)) {
            return (new ParseNode())($rawNode);
        }

        return null;
    }
}