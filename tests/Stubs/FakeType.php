<?php

namespace Adelf\Ventriloquist\Tests\Stubs;

use Adelf\Ventriloquist\Abstracts\Type;
use Adelf\Ventriloquist\Types\GenericType;
use Adelf\Ventriloquist\Types\StringType;

class FakeType extends Type
{
    function attributes(): array
    {
        return [
            [
                'name' => 'column_1',
                'type' => StringType::class,
            ],
            [
                'name' => 'column_foo_2',
                'database_alias' => 'column_2',
                'type' => StringType::class,
            ],
            [
                'name' => 'nice_relation',
                'real_relation' => 'beautiful_relation_in_model',
                'type' => StringType::class,
            ],
            [
                'name' => 'column_1',
                'type' => StringType::class,
                'handler' => function($selects, $relations, $rootModel, $rootType) {

                },
            ],
            [
                'name' => 'column_validate',
                'type' => GenericType::class,
            ],
            [
                'name' => 'list',
                'type' => GenericType::class,
                'subtype' => StringType::class,
            ],
        ];
    }
}
