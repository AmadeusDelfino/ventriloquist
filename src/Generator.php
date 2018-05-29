<?php

namespace Adelf\Ventriloquist;

use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\QueryParser\Parser;

class Generator
{
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function type($type = null)
    {
        $type = is_string($type) ? new $type : (($type instanceof Type) ? $type : null);

        if (($return = $this->parser->type($type)) !== null) {
            return $return;
        }

        return $this;
    }

    public function query($query = null)
    {
        if (($return = $this->parser->query($query)) !== null) {
            return $return;
        }

        return $this;
    }

    public function parse()
    {
        return $this->parser->parse();
    }
}
