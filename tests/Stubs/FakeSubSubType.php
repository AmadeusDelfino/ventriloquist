<?php

namespace Adelf\Ventriloquist\Tests\Stubs;

use Adelf\Ventriloquist\Abstracts\Type;
use Adelf\Ventriloquist\DataStructure\GenericStructure;
use Adelf\Ventriloquist\DataStructure\ListOfStructure;
use Adelf\Ventriloquist\DataStructure\StringStructure;

class FakeSubSubType extends Type
{
    protected $model = FakeModel::class;

    function attributes(): array
    {
        return [
            'sub_sub_1' => [
                'structure' => StringStructure::class,
            ],
            'sub_sub_2' => [
                'structure' => StringStructure::class,
            ],
            'sub_sub_3' => [
                'structure' => StringStructure::class,
            ],
        ];
    }
}
