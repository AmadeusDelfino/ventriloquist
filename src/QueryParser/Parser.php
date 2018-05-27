<?php

namespace Adelf\Ventriloquist\QueryParser;

use Adelf\Ventriloquist\NodeParser;
use Adelf\Ventriloquist\ParsedNodes;
use Illuminate\Database\Eloquent\Model;

class Parser
{
    protected $query;
    protected $rootModel;

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
     * @param Model $model
     *
     * @return Model|null
     */
    public function rootModel($model = null)
    {
        if (is_null($model)) {
            return $this->rootModel;
        }

        $this->rootModel = $model;
    }

    public function parse()
    {
        $parsedNodes = new ParsedNodes();
        $parsedNodes->nodes(app(NodeParser::class)->parse($this->query));
        $parsedNodes->model($this->rootModel());

        return $parsedNodes;
    }
}
