<?php

namespace Adelf\Ventriloquist\Tests;


use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use Adelf\Ventriloquist\SmartQueryBase\RelationNode;
use PHPUnit\Framework\TestCase;

class RelationNodeTest extends TestCase
{
    public function test_get_and_set()
    {
        $nodeName = 'Nice name';
        $nodeSelect = [
            "column_1",
            "column_2",
            "column_3",
            "column_4",
        ];

        $relationNode = new RelationNode();
        $nestedRelationNode = new RelationNode();
        $nestedRelationNode->name('Nested');

        $relationNode->name($nodeName);
        $relationNode->select($nodeSelect);
        $relationNode->addNestedNode($nestedRelationNode);


        $this->assertEquals($nodeName, $relationNode->name());
        $this->assertEquals($nodeSelect, $relationNode->select());
        $this->assertEquals([$nestedRelationNode->name() => $nestedRelationNode], $relationNode->nested());
    }
}