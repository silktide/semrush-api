<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi;

use AndyWaite\SemRushApi\Data\Database;
use AndyWaite\SemRushApi\Data\Type;
use AndyWaite\SemRushApi\Exception\InvalidOptionException;
use AndyWaite\SemRushApi\Model\Definition;

class Request {

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $typeDefinition = [];

    const ENDPOINT = "http://api.semrush.com/";

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var Definition
     */
    protected $definition;

    /**
     * @param string $type
     * @param array $options
     */
    public function __construct($type, $options = [])
    {
        $this->type = $type;
        $this->options = array_merge(['type' => $type], $options);
        $this->validate();
    }

    /**
     * Validate this request
     */
    protected function validate()
    {
        $this->loadRequestDefinition();
        $this->validateOptions();
    }

    /**
     * Validate the options passed
     * @throws InvalidOptionException
     */
    protected function validateOptions()
    {
        $optionsPassed = array_keys($this->options);

        //check for invalid options
        $validOptions = array_keys($this->definition->getAvailableFields());
        $unknownOptions = array_diff($optionsPassed, $validOptions);
        if (count($unknownOptions) > 0)
        {
            throw new InvalidOptionException("Invalid option(s) [".implode(", ", $unknownOptions)."] passed for request [{$this->type}]");
        }

        //check for missing options
        $requiredOptions = array_keys($this->definition->getRequiredFields());
        $missingRequiredOptions = array_diff($requiredOptions, $optionsPassed);
        if (count($missingRequiredOptions) > 0)
        {
            throw new InvalidOptionException("Missing option(s) [".implode(", ", $missingRequiredOptions)."] which are required for request [{$this->type}]");
        }

        //validate each field
        foreach ($this->options as $option => $value) {
            $this->validateOption($option, $value);
        }
    }

    /**
     * Validate the option passed
     *
     * @param string $option
     * @param mixed $value
     */
    protected function validateOption($option, $value)
    {
        $fieldDefinitions = $this->definition->getAvailableFields();
        $fieldType = $fieldDefinitions[$option];
        switch ($fieldType) {
            case "type":
                if (!in_array($value, Type::getTypes())) {
                    throw new InvalidOptionException("[{$option}] invalid type [{$value}]");
                }
                break;

            case "string":
                if (!is_string($value)) {
                    throw new InvalidOptionException("[{$option}] was not a string [{$value}]");
                }
                break;

            //TODO: Implement domain validation
            case "domain":
                if (!is_string($value)) {
                    throw new InvalidOptionException("[{$option}] was not a valid domain [{$value}]");
                }
                break;

            case "database":
                if (!in_array($value, Database::getDatabases())) {
                    throw new InvalidOptionException("[{$option}] was not a valid database [{$value}]");
                }
                break;

            //TODO: Implement date validation
            case "date":
                if (!is_string($value)) {
                    throw new InvalidOptionException("[{$option}] was not a valid date [{$value}]");
                }
                break;

            case "columns":
                $this->validateColumns($option, $value);
                break;

            default:
                throw new InvalidOptionException("[{$option}] was an unknown field type [{$fieldType}]");
                break;
        }
    }

    /**
     * Validate columns
     *
     * @param string $key
     * @param string[] $columns
     * @throws InvalidOptionException
     */
    protected function validateColumns($key, $columns)
    {
        if (!is_array($columns)) {
            throw new InvalidOptionException("[{$key}] is expected to be array for [{$this->type}]");
        }

        //check for invalid columns
        $validColumns = $this->definition->getValidColumns();
        $unknownColumns = array_diff($columns, $validColumns);
        if (count($unknownColumns) > 0)
        {
            throw new InvalidOptionException("Invalid [{$key}](s) [".implode(", ", $unknownColumns)."] passed for request [{$this->type}]");
        }
    }

    /**
     * Load request definition
     */
    protected function loadRequestDefinition()
    {
        $this->definition = new Definition($this->type);
    }


    /**
     * Get the URL of this request
     *
     * TODO: Write this
     */
    public function getUrl()
    {

    }

} 