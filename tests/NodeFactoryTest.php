<?php

namespace Adelf\Ventriloquist\Tests;


use Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException;
use Adelf\Ventriloquist\Factories\SmartNodeFactory;
use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use Adelf\Ventriloquist\SmartQueryBase\RelationNode;
use PHPUnit\Framework\TestCase;

class NodeFactoryTest extends TestCase
{
    public function stubColumnNodeProvider()
    {
        return [
            [
                new class {
                    public $name = 'Column Test';
                }
            ],
            [
                new class {
                    public $name = 'Another Column Test';
                }
            ]
        ];
    }

    public function stubRelationNodeProvider()
    {
        $firsRelationString = '
        {
          "name": "relation_test",
          "select": [
            "relation_field",
            "second_relation_field",
            {
              "name": "sub_relation_test",
              "select": [
                "a_nice_field"
              ] 
            }
          ]
        }
        ';
        $secondRelationString = '
        {
          "name": "relation_test_two",
          "select": [
            "relation_field",
            "second_relation_field",
            {
              "name": "sub_relation_test",
              "select": [
                "a_nice_field"
              ] 
            }
          ]
        }
        ';
        return [
            [
                json_decode($firsRelationString),
            ],
            [
                json_decode($secondRelationString),
            ]
        ];
    }

    public function stubInvalidNodesProvider()
    {
        $firsRelationString = '
        {
          "name_a": "wrong_test_one",
          "select": [
            "relation_field",
            "second_relation_field",
            {
              "name": "sub_relation_test",
              "select": [
                "a_nice_field"
              ] 
            }
          ]
        }
        ';
        $secondRelationString = '
        {
          "abc": "wrong_test_two",
          "select": [
            "relation_field",
            "second_relation_field",
            {
              "name": "sub_relation_test",
              "select": [
                "a_nice_field"
              ] 
            }
          ]
        }
        ';
        return [
            [
                json_decode($firsRelationString),
            ],
            [
                json_decode($secondRelationString),
            ]
        ];
    }

    /**
     * @dataProvider stubColumnNodeProvider
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     */
    public function test_if_column_factory_works($rawNode)
    {
        $node = SmartNodeFactory::make($rawNode);

        $this->assertInstanceOf(ColumnNode::class, $node);
    }

    /**
     * @param $rawNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     * @dataProvider stubRelationNodeProvider
     */
    public function test_if_relation_factory_works($rawNode)
    {
        $node = SmartNodeFactory::make($rawNode);

        $this->assertInstanceOf(RelationNode::class, $node);
    }

    /**
     * @param $rawNode
     * @throws \Adelf\Ventriloquist\Exceptions\NodeTypeNotValidException
     * @dataProvider stubInvalidNodesProvider
     */
    public function test_if_factory_validation_works($rawNode)
    {
        $this->expectException(NodeTypeNotValidException::class);

        SmartNodeFactory::make($rawNode);
    }
}