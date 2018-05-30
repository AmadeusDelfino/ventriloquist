<?php

namespace Adelf\Ventriloquist\Factories;


use Adelf\Ventriloquist\Exceptions\AttributeNotFoundException;
use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use Adelf\Ventriloquist\Traits\ClassInstance;

class SmartNodeColumnFactory
{
    use ClassInstance;

    /**
     * @param $rawNode
     * @param Type $type
     * @return ColumnNode
     * @throws AttributeNotFoundException
     */
    public function __invoke($rawNode, Type $type)
    {
        $this->validateAttribute($type, $rawNode);

        $node = new ColumnNode();

        $node->name($rawNode->name);
        $node->structure($this->getStructureClass($rawNode->name, $type));
        $node->setHandler($this->getHandlerOfField($rawNode->name, $type));
        return $node;
    }

    private function getStructureClass($nodeName, Type $type)
    {
        return $this->instanceOfClass($type->getAttribute($nodeName)['structure']);
    }

    /**
     * @param Type $type
     * @param $rawNode
     * @throws AttributeNotFoundException
     */
    private function validateAttribute(Type $type, $rawNode)
    {
        if(is_null($type->getAttribute($rawNode->name))) {
            throw new AttributeNotFoundException();
        }
    }

    private function getHandlerOfField($name, Type $type)
    {
        return $type->getAttribute($name)['handler'] ?? null;
    }
}