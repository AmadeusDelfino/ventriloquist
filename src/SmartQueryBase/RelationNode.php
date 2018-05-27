<?php

namespace Adelf\Ventriloquist\SmartQueryBase;

use Adelf\Ventriloquist\Interfaces\Node;

class RelationNode implements Node
{
    protected $name;
    protected $select;
    protected $nestedNodes = [];

    public function name($name = null)
    {
        if (is_null($name)) {
            return $this->name;
        }

        $this->name = $name;

        return $this;
    }

    public function select($select = null)
    {
        if (is_null($select)) {
            return $this->select;
        }

        $this->select = $select;

        return $this;
    }

    public function addNestedNode(Node $node)
    {
        $this->nestedNodes[$node->name()] = $node;
    }

    public function nested()
    {
        return $this->nestedNodes;
    }
}
