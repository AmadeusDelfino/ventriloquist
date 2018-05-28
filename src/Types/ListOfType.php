<?php

namespace Adelf\Ventriloquist\Types;


use Adelf\Ventriloquist\Constants;
use Adelf\Ventriloquist\Interfaces\ListOfType as IListOfType;
use Adelf\Ventriloquist\TypeValidator\Validators\ListValidator;

class ListOfType extends Base implements IListOfType
{
    protected $typeDescribe = Constants::LIST_OF_TYPE_DESCRIBE;
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
