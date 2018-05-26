<?php

namespace Adelf\Ventriloquist\Handlers;


use Adelf\Ventriloquist\Interfaces\Node;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;

class GetSelectsFromSmartNodes
{
    public function __invoke($smartNodes)
    {
        return $this->filterNullColumns($this->getColumnsName($smartNodes));
    }

    private function getColumnsName($smartNodes)
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