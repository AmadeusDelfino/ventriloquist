<?php

namespace Adelf\Ventriloquist\DataStructure;


use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\DataStructureValidator\Validators\ListValidator;
use Adelf\Ventriloquist\Interfaces\ListOfType as IListOfType;

class ListOfStructure extends Base implements IListOfType
{
    protected $dataDescribe = Constants::LIST_OF_STRUCTURE_DESCRIBE;
    protected $list;

    protected $validators = [
        ListValidator::class,
    ];

    function resolver($value)
    {
        return (int) $value;
    }

    public function defineList(array $list)
    {
        $this->list = $list;

        return $this;
    }


    public function getList(): array
    {
        return $this->list;
    }

    public function defineSubtype($type)
    {
        // TODO: Implement defineSubtype() method.
    }
}
