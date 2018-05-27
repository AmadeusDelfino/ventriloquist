<?php

namespace Adelf\Ventriloquist\Factories;

use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use Adelf\Ventriloquist\SmartQueryBase\RelationNode;

class SmartNodeFactory
{
    /**
     * @param $data
     *
     * @throws NodeTypeNotValidException
     *
     * @return ColumnNode|RelationNode
     */
    public static function make($data)
    {
        return self::makeByType(self::typeOfNode($data), $data);
    }

    /**
     * @param $type
     * @param $data
     *
     * @throws NodeTypeNotValidException
     *
     * @return ColumnNode|RelationNode
     */
    private static function makeByType($type, $data)
    {
        switch ($type) {
            case Constants::COLUMN_NODE_TYPE:
                return self::makeColumnType($data);

            case Constants::RELATION_NODE_TYPE:
                return self::makeRelationType($data);
        }
    }

    private static function makeColumnType($data)
    {
        $type = new ColumnNode();
        $type->name($data->name);

        return $type;
    }

    /**
     * @param $data
     *
     * @throws NodeTypeNotValidException
     *
     * @return RelationNode
     */
    private static function makeRelationType($data)
    {
        $type = new RelationNode();
        $type->name($data->name);
        if (self::hasNestedResource($data->select)) {
            self::setNestedResource($data, $type);
        }
        $type->select($data->select);

        return $type;
    }

    private static function hasNestedResource($data)
    {
        foreach ($data as $select) {
            if (self::isNested($select)) {
                return true;
            }
        }

        return false;
    }

    private static function isNested($data)
    {
        return is_object($data);
    }

    private static function getAndRemoveNestedResources(&$selects)
    {
        $nested = [];
        foreach ($selects as $key=>$select) {
            if (self::isNested($select)) {
                $nested[] = array_pull($selects, $key);
            }
        }

        return $nested;
    }

    /**
     * @param $rawNode
     *
     * @throws NodeTypeNotValidException
     *
     * @return string
     */
    private static function typeOfNode($rawNode)
    {
        if (isset($rawNode->name) && isset($rawNode->select)) {
            return Constants::RELATION_NODE_TYPE;
        }

        if (isset($rawNode->name) && !isset($rawNode->select)) {
            return Constants::COLUMN_NODE_TYPE;
        }

        throw new NodeTypeNotValidException();
    }

    /**
     * @param $data
     * @param $type
     *
     * @throws NodeTypeNotValidException
     */
    private static function setNestedResource($data, RelationNode $type)
    {
        foreach (self::getAndRemoveNestedResources($data->select) as $nested) {
            $type->addNestedNode(self::make($nested));
        }
    }
}
