<?php

namespace Adelf\Ventriloquist\Handlers;


use Adelf\Ventriloquist\Factories\SmartNodeFactory;

class ParseNode
{
    /**
     * @param $rawNode
     * @return \Adelf\Ventriloquist\SmartQueryBase\ColumnNode|\Adelf\Ventriloquist\SmartQueryBase\RelationNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    public function __invoke($rawNode)
    {
        return $this->makeNode($rawNode);
    }

    /**
     * @param $rawNode
     * @return \Adelf\Ventriloquist\SmartQueryBase\ColumnNode|\Adelf\Ventriloquist\SmartQueryBase\RelationNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    private function makeNode($rawNode)
    {
        return SmartNodeFactory::make($rawNode);
    }
}