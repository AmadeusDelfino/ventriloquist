<?php

namespace App\Support\SmartQueryGenerator\Handlers;


use App\Support\SmartQueryGenerator\Interfaces\Node;
use App\Support\SmartQueryGenerator\SmartQueryBase\ColumnNode;

class GetSelectsFromSmartNodes
{
    public function __invoke($smartNodes)
    {
        return $this->filterNullColumns($this->getColumns($smartNodes));
    }

    private function getColumns($smartNodes)
    {
        return array_map(function(Node $node) {
            if($node instanceof ColumnNode) {
                return $node->name();
            }
        }, $smartNodes);
    }

    private function filterNullColumns($columns)
    {
        return array_filter($columns);
    }
}