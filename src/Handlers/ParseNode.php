<?php

namespace Adelf\Ventriloquist\Handlers;

use Adelf\Ventriloquist\Factories\SmartNodeFactory;

class ParseNode
{
    /**
     * @param $rawNode
     *
     * @param $rootType
     * @return \Adelf\Ventriloquist\SmartQueryBase\ColumnNode|\Adelf\Ventriloquist\SmartQueryBase\RelationNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    public function __invoke($rawNode, $rootType)
    {
        return $this->makeNode($rawNode, $rootType);
    }

    /**
     * @param $rawNode
     *
     * @param $rootType
     * @return \Adelf\Ventriloquist\SmartQueryBase\ColumnNode|\Adelf\Ventriloquist\SmartQueryBase\RelationNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    private function makeNode($rawNode, $rootType)
    {
        return (new SmartNodeFactory())->make($rawNode, $rootType);
    }
}
