<?php

namespace Adelf\Ventriloquist\Factories;

use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\SmartQueryBase\RelationNode;
use Adelf\Ventriloquist\Traits\ClassInstance;

class SmartNodeRelationFactory
{
    use ClassInstance;

    /**
     * @param $rawNode
     * @param Type $type
     * @return RelationNode|null
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    public function __invoke($rawNode, Type $type)
    {
        $attribute = $type->getAttribute($rawNode->name);

        $type = $this->getRelatedType($attribute);

        if($this->selectsIsValid($rawNode->select, $attribute)) {
            $node = new RelationNode();
            $node->name($rawNode->name);

            $this->setSelect($node, $rawNode->select, $type);

            $this->setNestedResource($node, $rawNode, $this->getRelatedType($attribute));


            return $node;
        }

        return null;
    }

    private function selectsIsValid($selects, $attribute)
    {
        $relatedType = $this->getRelatedType($attribute);
        foreach($selects as $select) {
            if((! $this->isNested($select)) && is_null($relatedType->getAttribute($select))) {
                return false;
            }
        }

        return true;
    }

    private function getRelatedType($attribute) : Type
    {

        return $this->instanceOfClass($attribute['type']);
    }

    /**
     * @param RelationNode $node
     * @param $data
     * @param Type $type
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    private function setNestedResource(RelationNode $node, $data, Type $type)
    {
        foreach ($this->getAndRemoveNestedResources($data->select) as $nested) {
            $node->addNestedNode((new SmartNodeFactory())->make($nested, $type));
        }
    }

    private function getAndRemoveNestedResources(&$selects)
    {
        $nested = [];
        foreach ($selects as $key=>$select) {
            if ($this->isNested($select)) {
                $nested[] = array_pull($selects, $key);
            }
        }

        return $nested;
    }

    private function isNested($data)
    {
        return is_object($data);
    }

    /**
     * @param RelationNode $node
     * @param $selects
     * @param Type $type
     * @return RelationNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    private function setSelect(RelationNode $node, $selects, Type $type)
    {
        foreach($selects as $select) {
            if($this->isNested($select)) {
                $node->addNestedNode((new SmartNodeFactory())->make($select, $type));

                continue;
            }

            $select = (object) [
                'name' => $select,
            ];
            $node->addSelect((new SmartNodeFactory())->make($select, $type));
        }

        return $node;
    }
}