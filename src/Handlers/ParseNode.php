<?php

namespace Adelf\Ventriloquist\Handlers;

use Adelf\Ventriloquist\Factories\SmartNodeFactory;

class ParseNode
{
    /**
     * @param $rawNode
     *
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     *
     * @return \Adelf\Ventriloquist\SmartQueryBase\ColumnNode|\Adelf\Ventriloquist\SmartQueryBase\RelationNode
     */
    public function __invoke($rawNode)
    {
        return $this->makeNode($rawNode);
    }

    /**
     * @param $rawNode
     *
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     *
     * @return \Adelf\Ventriloquist\SmartQueryBase\ColumnNode|\Adelf\Ventriloquist\SmartQueryBase\RelationNode
     */
    private function makeNode($rawNode)
    {
        return SmartNodeFactory::make($rawNode);
    }
}
