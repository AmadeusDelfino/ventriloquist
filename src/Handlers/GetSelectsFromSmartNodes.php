<?php

namespace Adelf\Ventriloquist\Handlers;

use Adelf\Ventriloquist\Interfaces\Node;
use Adelf\Ventriloquist\QueryParser\Field;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;

class GetSelectsFromSmartNodes
{
    public function __invoke($smartNodes)
    {
        return $this->filterNullColumns($this->getColumnsName($smartNodes));
    }

    private function getColumnsName($smartNodes)
    {
        return array_map(function (Node $node) {
            if ($node instanceof ColumnNode) {
                $field = new  Field();
                $field->setToken($node->name());

                return $field;
            }
        }, $smartNodes);
    }

    private function filterNullColumns($columns)
    {
        return array_filter($columns);
    }
}
