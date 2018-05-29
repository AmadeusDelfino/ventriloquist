<?php

namespace Adelf\Ventriloquist\Factories;


use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use Adelf\Ventriloquist\Traits\ClassInstance;

class SmartNodeColumnFactory
{
    use ClassInstance;

    public function __invoke($rawNode, Type $type)
    {
        $node = new ColumnNode();

        $node->name($rawNode->name);
        $node->structure($this->getStructureClass($rawNode->name, $type));

        return $node;
    }

    private function getStructureClass($nodeName, Type $type)
    {
        return $this->instanceOfClass($type->getAttribute($nodeName)['structure']);
    }
}