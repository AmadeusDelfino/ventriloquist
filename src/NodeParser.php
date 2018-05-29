<?php

namespace Adelf\Ventriloquist;

use Adelf\Ventriloquist\Exceptions\NodeFormatInvalidException;
use Adelf\Ventriloquist\Handlers\ParseNode;
use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\NodeParserValidator\Validator;

class NodeParser
{
    protected $rootType;
    protected $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function tokenizer($smartQuery, $rootType)
    {
        $this->rootType = $rootType;
        return array_map([$this, 'parseNode'], $smartQuery);
    }

    /**
     * @param $rawNode
     *
     * @return mixed
     */
    private function parseNode($rawNode)
    {
        if ($this->validator->isValidRawNode($rawNode)) {
            return (new ParseNode())($rawNode, $this->rootType);
        }

        $this->validator->registerInvalidNode($rawNode);

        return null;
    }
}
