<?php

namespace Adelf\Ventriloquist;


use Adelf\Ventriloquist\QueryParser\Parser;

class Generator
{
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function rootModel($model = null)
    {
        if(($return = $this->parser->rootModel($model)) !== null) {
            return $return;
        }

        return $this;
    }

    public function query($query = null)
    {
        if(($return = $this->parser->query($query)) !== null) {
            return $return;
        }

        return $this;
    }

    public function parse()
    {
        return $this->parser->parse();
    }
}