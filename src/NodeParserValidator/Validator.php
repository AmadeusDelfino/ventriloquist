<?php

namespace Adelf\Ventriloquist\NodeParserValidator;


class Validator
{
    protected $errors = [
        'unknown_nodes' => [],
        'invalid_structure_nodes' => [],
        'unknown_error_nodes' => [],
    ];

    public function isValidRawNode($rawNode) : bool
    {
        return $this->hasNameAttribute($rawNode) && $this->hasValidSelectField($rawNode);
    }

    public function registerInvalidNode($rawNode)
    {
        if(! $this->hasNameAttribute($rawNode)) {
            $this->registerUnknownNode($rawNode);
        }
        if(! $this->hasValidSelectField($rawNode)) {
            $this->registerInvalidStructureNode($rawNode);
        }
        $this->registerUnknownErrorNode($rawNode);

        return $this;
    }

    public function hasErrors() : bool
    {
        foreach($this->errors as $value) {
            if(count($value) > 0) {
                return true;
            }
        }

        return false;
    }

    private function hasNameAttribute($rawNode) : bool
    {
        return isset($rawNode->name);
    }

    private function hasValidSelectField($rawNode) : bool
    {
        if(isset($rawNode->select)) {
            return is_array($rawNode->select);
        }

        return true;
    }

    private function registerInvalidStructureNode($rawNode)
    {
        $this->errors['invalid_structure_nodes'][$rawNode->name] = $rawNode;

        return $this;
    }

    private function registerUnknownNode($rawNode)
    {
        $this->errors['unknown_nodes'][] = $rawNode;

        return $this;
    }

    private function registerUnknownErrorNode($rawNode)
    {
        $this->errors['unknown_error_nodes'][] = $rawNode;
    }
}