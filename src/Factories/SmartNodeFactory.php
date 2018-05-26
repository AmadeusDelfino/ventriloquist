<?php

namespace App\Support\SmartQueryGenerator\Factories;


use App\Support\SmartQueryGenerator\Constants;
use App\Support\SmartQueryGenerator\Exceptions\NodeTypeNotValidException;
use App\Support\SmartQueryGenerator\SmartQueryBase\ColumnNode;
use App\Support\SmartQueryGenerator\SmartQueryBase\RelationNode;

class SmartNodeFactory
{
    /**
     * @param $data
     * @return ColumnNode|RelationNode
     * @throws NodeTypeNotValidException
     */
    public static function make($data)
    {
        return self::makeByType(self::typeOfNode($data), $data);
    }

    /**
     * @param $type
     * @param $data
     * @return ColumnNode|RelationNode
     * @throws NodeTypeNotValidException
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
     * @return RelationNode
     * @throws NodeTypeNotValidException
     */
    private static function makeRelationType($data)
    {
        $type = new RelationNode();
        $type->name($data->name);
        if(self::hasNestedResource($data->select)) {
            self::setNestedResource($data, $type);

        }
        $type->select($data->select);

        return $type;
    }

    private static function hasNestedResource($data)
    {
        foreach ($data as $select) {
            if(self::isNested($select)) {
                return true;
            }
        };

        return false;
    }

    private static function isNested($data)
    {
        return is_object($data);
    }

    private static function getAndRemoveNestedResources(&$selects)
    {
        $nested = [];
        foreach($selects as $key=>$select) {
            if(self::isNested($select)) {
                $nested[] = array_pull($selects, $key);
            }
        }

        return $nested;
    }

    /**
     * @param $rawNode
     * @return string
     * @throws NodeTypeNotValidException
     */
    private static function typeOfNode($rawNode)
    {
        if(isset($rawNode) && isset($rawNode->select)) {
            return Constants::RELATION_NODE_TYPE;
        }

        if(isset($rawNode) && !isset($rawNode->select)) {
            return Constants::COLUMN_NODE_TYPE;
        }

        throw new NodeTypeNotValidException();
    }

    /**
     * @param $data
     * @param $type
     * @throws NodeTypeNotValidException
     */
    private static function setNestedResource($data, RelationNode $type)
    {
        foreach (self::getAndRemoveNestedResources($data->select) as $nested) {
            $type->addNestedNode(self::make($nested));
        }
    }
}