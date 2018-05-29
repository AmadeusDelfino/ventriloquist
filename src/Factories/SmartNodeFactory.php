<?php

namespace Adelf\Ventriloquist\Factories;

use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException;
use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use Adelf\Ventriloquist\SmartQueryBase\RelationNode;

class SmartNodeFactory
{
    /** @var Type */
    protected $rootType;

    /**
     * @param $rawNode
     *
     * @param $rootType
     * @return ColumnNode|RelationNode
     * @throws NodeTypeNotValidException
     */
    public function make($rawNode, Type $rootType)
    {
        $this->rootType = $rootType;
        return $this->makeByType($this->typeOfNode($rawNode), $rawNode);
    }

    /**
     * @param $nodeType
     * @param $rawNode
     *
     *
     * @return ColumnNode|RelationNode
     */
    private function makeByType($nodeType, $rawNode)
    {
        switch ($nodeType) {
            case Constants::COLUMN_NODE_TYPE:
                return (new SmartNodeColumnFactory())($rawNode, $this->rootType);

            case Constants::RELATION_NODE_TYPE:
                return (new SmartNodeRelationFactory())($rawNode, $this->rootType);
        }
    }

    /**
     * @param $rawNode
     *
     * @throws NodeTypeNotValidException
     *
     * @return string
     */
    private function typeOfNode($rawNode)
    {
        if (isset($rawNode->name) && isset($rawNode->select)) {
            return Constants::RELATION_NODE_TYPE;
        }

        if (isset($rawNode->name) && !isset($rawNode->select)) {
            return Constants::COLUMN_NODE_TYPE;
        }

        throw new NodeTypeNotValidException();
    }
}
