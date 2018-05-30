<?php

namespace Adelf\Ventriloquist\Tests\Stubs;

use Adelf\Ventriloquist\Abstracts\Type;
use Adelf\Ventriloquist\DataStructure\GenericStructure;
use Adelf\Ventriloquist\DataStructure\ListOfStructure;
use Adelf\Ventriloquist\DataStructure\StringStructure;

class FakeSubType extends Type
{
    protected $model = FakeModel::class;

    function attributes(): array
    {
        return [
            'just_column_sub' => [
                'structure' => StringStructure::class,
                'handler' => function($rootType, $rootModel, $selects) {

                }
            ],
            'relation_test_sub' => [
                'type' => FakeSubSubType::class,
            ],
        ];
    }
}
