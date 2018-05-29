<?php

namespace Adelf\Ventriloquist\Traits;


trait ClassInstance
{
    private function instanceOfClass($structureClass)
    {
        return new $structureClass;
    }
}