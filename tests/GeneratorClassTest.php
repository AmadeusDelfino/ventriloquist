<?php

namespace Adelf\Ventriloquist\Tests;

use Adelf\Ventriloquist\Exceptions\NodeFormatInvalidException;
use Adelf\Ventriloquist\Generator;
use Adelf\Ventriloquist\NodeParser;
use Adelf\Ventriloquist\Tests\Stubs\FakeType;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;

class GeneratorClassTest extends TestCase
{
    public function correctQueryProvider()
    {
        $firstQuery = '
        [
          {
            "name": "relation_test_one",
            "select": [
              "just_column_sub",
              {
                "name": "relation_test_sub",
                "select": [
                  "sub_sub_1",
                  "sub_sub_2",
                  "sub_sub_3"               
                ]
              }
              
            ]
          },
          {
            "name": "just_column"
          },
          {
            "name": "just_column_two"
          },
          {
            "name": "with_handler"
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
    public function test_if_parse_works($query)
    {
        $parser = new Generator();
        $parser->query($query);
        $parser->type(FakeType::class);
        $parsedNodes = $parser->parse();

        $fields = $parsedNodes->getRelationsForModel();
        dd($fields);
        $this->assertInternalType('array', $parsedNodes->getRelations());
        $this->assertInternalType('array', $parsedNodes->getSelects());

        //TODO test with eloquent
//        $this->assertInstanceOf(Builder::class, $parsedNodes->eloquentBuilder());
    }

    /**
     * @dataProvider correctQueryProvider
     */
    public function test_get_and_set($query)
    {
        $parser = new Generator();
        $parser->query($query);
        $parser->type(FakeType::class);

        $this->assertInstanceOf(Model::class, $parser->rootModel());
        $this->assertInternalType('array', $parser->query());
    }

    /**
     * @dataProvider incorrectQueryProvider
     */
    public function test_parse_invalid_node($query)
    {
        $this->expectException(NodeFormatInvalidException::class);
        $parser = new NodeParser();
        $parser->tokenizer($query, new FakeType());
    }
}
