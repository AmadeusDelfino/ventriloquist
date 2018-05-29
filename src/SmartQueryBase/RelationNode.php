<?php

namespace Adelf\Ventriloquist\SmartQueryBase;

use Adelf\Ventriloquist\Interfaces\Node;

class RelationNode extends Base
{
    protected $select = [];
    protected $nestedNodes = [];

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

    public function addSelect(ColumnNode $columnNode)
    {
        $this->select[$columnNode->name] = $columnNode;
    }

    public function nested()
    {
        return $this->nestedNodes;
    }
}
