<?php

namespace Adelf\Ventriloquist\Tests\Stubs;

use Adelf\Ventriloquist\Abstracts\Type;

class FakeType extends Type
{
    function attributes(): array
    {
        return [
            [
                'name' => 'column_1',
            ],
            [
                'name' => 'column_foo_2',
                'in_database' => 'column_2',
            ],
            [
                'name' => 'nice_relation',
                'real_relation' => 'beautiful_relation_in_model',
            ],
            [
                'name' => 'column_1',
                'selectable' => false,
                'handler' => function($selects, $relations, $rootModel, $rootType) {

                }
            ],
        ];
    }
}
