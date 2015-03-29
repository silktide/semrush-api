<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi\Model;

use AndyWaite\SemRushApi\Model\Exception\InvalidTypeException;

class Definition {

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $definition;

    /**
     * @param string $type
     * @throws InvalidTypeException
     */
    public function __construct($type)
    {
        $this->type = $type;
        $this->loadDefinition();
    }

    /**
     * Load the definition from the JSON file
     */
    protected function loadDefinition()
    {
        chdir(__DIR__);
        $data = json_decode(file_get_contents("request.json"), true);
        if (!isset($data[$this->type])) {
            throw new InvalidTypeException("The type of request provided [{$this->type}] was not valid or is not currently supported.");
        }
        $this->definition = $data[$this->type];
    }

    /**
     * Get this type's required fields
     *
     * @return string[]
     */
    public function getRequiredFields()
    {
        return $this->definition['required_fields'];
    }

    /**
     * Get this type's optional fields
     *
     * @return string[]
     */
    public function getOptionalFields()
    {
        return $this->definition['optional_fields'];
    }

    /**
     * Get this type's available fields
     *
     * @return string[]
     */
    public function getAvailableFields()
    {
        return array_merge($this->definition['optional_fields'], $this->definition['required_fields']);
    }

    /**
     * Get this type's preset fields
     *
     * @return string[]
     */
    public function getPresetFields()
    {
        return $this->definition['preset_fields'];
    }

    /**
     * Get this type's default columns
     *
     * @return string[]
     */
    public function getDefaultColumns()
    {
        return $this->definition['default_columns'];
    }

    /**
     * Get this type's valid columns
     *
     * @return string[]
     */
    public function getValidColumns()
    {
        return $this->definition['valid_columns'];
    }

} 