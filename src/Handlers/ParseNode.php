<?php

namespace App\Support\SmartQueryGenerator\Handlers;


use App\Support\SmartQueryGenerator\Factories\SmartNodeFactory;

class ParseNode
{
    /**
     * @param $rawNode
     * @return \App\Support\SmartQueryGenerator\SmartQueryBase\ColumnNode|\App\Support\SmartQueryGenerator\SmartQueryBase\RelationNode
     * @throws \App\Support\SmartQueryGenerator\Exceptions\NodeTypeNotValidException
     */
    public function __invoke($rawNode)
    {
        return $this->makeNode($rawNode);
    }

    /**
     * @param $rawNode
     * @return \App\Support\SmartQueryGenerator\SmartQueryBase\ColumnNode|\App\Support\SmartQueryGenerator\SmartQueryBase\RelationNode
     * @throws \App\Support\SmartQueryGenerator\Exceptions\NodeTypeNotValidException
     */
    private function makeNode($rawNode)
    {
        return SmartNodeFactory::make($rawNode);
    }
}