<?php

namespace Adelf\Ventriloquist;

use Adelf\Ventriloquist\Handlers\GetRelationsFromSmartNodes;
use Adelf\Ventriloquist\Handlers\GetSelectsFromSmartNodes;
use Adelf\Ventriloquist\QueryParser\Field;

class ParsedNodes
{
    protected $nodes;
    protected $model;

    public function nodes($nodes = null)
    {
        if (is_null($nodes)) {
            return $this->nodes;
        }

        $this->nodes = $nodes;
    }

    public function model($model = null)
    {
        if (is_null($model)) {
            return $this->model;
        }

        $this->model = $model;
    }

    public function getSelects()
    {
        return (new GetSelectsFromSmartNodes())($this->nodes);
    }

    public function getRelations()
    {
        return (new GetRelationsFromSmartNodes())($this->nodes);
    }

    public function getRelationsForModel()
    {
        return array_filter(array_map(function (Field $field) {
            return $field->tokenWithSelect();
        }, $this->getRelations()));
    }

    public function getRelationsWithHandler()
    {

    }
}
