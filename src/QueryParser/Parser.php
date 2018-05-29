<?php

namespace Adelf\Ventriloquist\QueryParser;

use Adelf\Ventriloquist\Interfaces\Type;
use Adelf\Ventriloquist\NodeParser;
use Adelf\Ventriloquist\NodeParserValidator\Validator;
use Adelf\Ventriloquist\ParsedNodes;

class Parser
{
    protected $query;
    /** @var Type */
    protected $type;

    /**
     * @param string $query
     *
     * @return string|null
     */
    public function query($query = null)
    {
        if (is_null($query)) {
            return $this->query;
        }

        $this->query = $query;
    }

    /**
     * @param Type $type
     *
     * @return Type|null
     */
    public function type(Type $type = null)
    {
        if (is_null($type)) {
            return $this->type;
        }

        $this->type = $type;
    }

    public function parse()
    {
        $nodes = (new NodeParser())->tokenizer($this->query, $this->type);
        dd($nodes);
        return $this->initParsedNodeClass($nodes);
    }

    private function executeTypeValidation()
    {

    }

    /**
     * @param $nodes
     * @return ParsedNodes
     */
    private function initParsedNodeClass($nodes): ParsedNodes
    {
        $parsedNodes = new ParsedNodes();
        $parsedNodes->nodes($nodes);
        $parsedNodes->model($this->type->model());

        return $parsedNodes;
    }

    private function validateType()
    {
        $validator = new Validator();
    }
}
