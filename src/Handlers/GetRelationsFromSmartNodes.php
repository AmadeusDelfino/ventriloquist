<?php

namespace Adelf\Ventriloquist\Handlers;

use Adelf\Ventriloquist\Interfaces\Node;
use Adelf\Ventriloquist\QueryParser\Field;
use Adelf\Ventriloquist\SmartQueryBase\RelationNode;

class GetRelationsFromSmartNodes
{
    private $currentPrefix;
    private $previouslyPrefix;
    private $rootPrefix;

    public function __invoke($smartNodes)
    {
        return array_flatten($this->getRelations($this->filterSelectNodes($smartNodes)));
    }

    private function filterSelectNodes($smartNodes)
    {
        return array_filter(array_filter($smartNodes, function (Node $node) {
            if ($node instanceof RelationNode) {
                return $node;
            }
        }));
    }

    private function getRelations($smartNodes, $previouslyPrefix = null)
    {
        $this->previouslyPrefix = $previouslyPrefix;

        return array_map([$this, 'getRelationsWithNested'], $smartNodes);
    }

    private function getRelationsWithNested(RelationNode $node)
    {
        $selects = [];
        if ($this->rootPrefix === null) {
            $this->rootPrefix = $node->name();
        }
        $this->currentPrefix = $node->name();

        array_push($selects, $this->getSelectWithPrefix($node->select()));

        foreach ($node->nested() as $nested) {
            $selects = $this->addNestedSelects($nested, $selects);
        }

        $this->currentPrefix = $node->name();

        if ($this->currentPrefix === $this->rootPrefix) {
            $this->rootPrefix = null;
        }

        $this->previouslyPrefix = $this->rootPrefix;
        $this->currentPrefix = null;

        return $selects;
    }

    private function buildPrefix()
    {
        if ($this->previouslyPrefix === null) {
            return $this->currentPrefix;
        }

        if ($this->previouslyPrefix !== null && $this->currentPrefix === null) {
            return $this->previouslyPrefix;
        }

        return $this->previouslyPrefix.'.'.$this->currentPrefix;
    }

    private function getSelectWithPrefix($selects)
    {
        $field = new Field();
        $field
            ->setToken($this->buildPrefix())
            ->setSelects($selects);

        return $field;
    }

    private function getSelectsName($selects)
    {
        return array_map(function($select) {
            return $select->name();
        }, $selects);
    }

    /**
     * @param $nested
     * @param $selects
     *
     * @return array
     */
    private function addNestedSelects($nested, $selects): array
    {
        if (!is_null($nested)) {
            $selects[] = $this->getRelations([$nested], $this->buildPrefix());
        }

        return $selects;
    }
}
