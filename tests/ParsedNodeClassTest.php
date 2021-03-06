<?php

namespace Adelf\Ventriloquist\Tests;

use Adelf\Ventriloquist\Generator;
use Adelf\Ventriloquist\Tests\Stubs\FakeModel;
use PHPUnit\Framework\TestCase;

class ParsedNodeClassTest extends TestCase
{
    public function correctQueryProvider()
    {
        $firstQuery = '
        [
          {
            "name": "relation_test_one",
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
          },
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
          },
          {
            "name": "just_column"
          },
          {
            "name": "just_column_two"
          }
        ]
        ';

        return [
            [json_decode($firstQuery)],
        ];
    }

    public function incorrectQueryProvider()
    {
        $firstQuery = '
        [
          {
            "name_a": "relation_test_one",
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
          },
          {
            "name_b": "relation_test_two",
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
          },
          {
            "name_c": "just_column"
          },
          {
            "name_d": "just_column_two"
          }
        ]
        ';

        return [
            [json_decode($firstQuery)],
        ];
    }

    /**
     * @param $query
     * @dataProvider correctQueryProvider
     */
    public function test_get_and_set($query)
    {
        $parser = new Generator();
        $parser->query($query);
        $parser->rootModel(new FakeModel());
        $parsedNodes = $parser->parse();

        $this->assertInternalType('array', $parsedNodes->getRelations());
        $this->assertInternalType('array', $parsedNodes->getSelects());
        $this->assertInternalType('array', $parsedNodes->nodes());
        $this->assertInstanceOf(FakeModel::class, $parsedNodes->model());
    }
}
