<?php

namespace Adelf\Ventriloquist\Tests;

use Adelf\Ventriloquist\Exceptions\NodeFormatInvalidException;
use Adelf\Ventriloquist\Generator;
use Adelf\Ventriloquist\NodeParser;
use Adelf\Ventriloquist\Tests\Stubs\FakeModel;
use Adelf\Ventriloquist\Tests\Stubs\FakeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use PHPUnit\Framework\TestCase;

class ValidatorClassTest extends TestCase
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
            "name": "column_1"
          },
          {
            "name": "column_foo_2"
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
    public function test_if_validation_in_one_level_works($query)
    {
        $parser = new Generator();
        $parser->query($query);
        $parser->type(new FakeType());
        $parser->validate();
        $parsedNodes = $parser->parse();

        $this->assertInternalType('array', $parsedNodes->getRelations());
        $this->assertInternalType('array', $parsedNodes->getSelects());
    }

    /**
     * @dataProvider correctQueryProvider
     */
    public function test_get_and_set($query)
    {

    }

    /**
     * @dataProvider incorrectQueryProvider
     */
    public function test_parse_invalid_node($query)
    {

    }
}
