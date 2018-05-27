<?php

namespace Adelf\Ventriloquist\Tests;


use Adelf\Ventriloquist\SmartQueryBase\ColumnNode;
use PHPUnit\Framework\TestCase;

class ColumnNodeTest extends TestCase
{
    public function test_get_and_set()
    {
        $nodeName = 'Nice name';
        $columnNode = new ColumnNode();
        $columnNode->name($nodeName);

        $this->assertEquals($nodeName, $columnNode->name());
    }
}