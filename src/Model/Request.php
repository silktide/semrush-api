<?php

namespace Silktide\SemRushApi\Model;

use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Exception\InvalidOptionException;

class Request
{
    const DOMAIN = "http://api.semrush.com";

    /**
     * @var string
     */
    protected $type;

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
    public function __construct($type, $options = [], $endpoint_path)
    {
        $this->type = $type;
        $this->options = ['type' => $type] + $options;
        $this->endpoint_path = $endpoint_path;
        $this->loadRequestDefinition();
        $this->mergePresets();
        // If the request is a domain overview request, we must add the
        // export_columns option.
        if ($endpoint_path == \Silktide\SemRushApi\Data\ApiEndpoint::ENDPOINT_DOMAIN) {
            $this->options['export_columns'] = $this->getExpectedResultColumns();
        }
        $this->validate();
    }

    /**
     * Merge in presets from the definition
     */
    protected function mergePresets()
    {
        $presets = $this->definition->getPresetFields();
        $this->options = $this->options + $presets;
    }

    /**
     * Validate this request
     */
    protected function validate()
    {
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
        if (count($unknownOptions) > 0) {
            throw new InvalidOptionException("Invalid option(s) [" . implode(", ", $unknownOptions) . "] passed for request [{$this->type}]");
        }

        //check for missing options
        $requiredOptions = array_keys($this->definition->getRequiredFields());
        $missingOptions = array_diff($requiredOptions, $optionsPassed);
        if (count($missingOptions) > 0) {
            throw new InvalidOptionException("Missing option(s) [" . implode(", ", $missingOptions) . "] which are required for request [{$this->type}]");
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
                break;

            case "string":
                $this->validateString($option, $value);
                break;

            case "domain":
                $this->validateDomain($option, $value);
                break;

            case "database":
                $this->validateDatabase($option, $value);
                break;

            case "date":
                $this->validateDate($option, $value);
                break;

            case "columns":
                $this->validateColumns($option, $value);
                break;

            case "boolean":
                $this->validateBoolean($option, $value);
                break;

            case "integer":
                $this->validateInteger($option, $value);
                break;
        }
    }

    /**
     * Validate boolean option (1 or 0)
     *
     * @param string $key
     * @param mixed $value
     * @throws InvalidOptionException
     */
    protected function validateBoolean($key, $value)
    {
        $value = strval($value);
        if (!($value == "1" || $value == "0")) {
            throw new InvalidOptionException("[{$key}] was not 1 or 0 [{$value}]");
        }
    }

    /**
     * Validate database
     *
     * @param string $key
     * @param string $database
     * @throws InvalidOptionException
     */
    protected function validateDatabase($key, $database)
    {
        if (!in_array($database, Database::getDatabases())) {
            throw new InvalidOptionException("[{$key}] was not a database [{$database}]");
        }
    }

    /**
     * Validate integer
     *
     * @param string $key
     * @param string $string
     * @throws InvalidOptionException
     */
    protected function validateInteger($key, $string)
    {
        if (!is_int($string)) {
            throw new InvalidOptionException("[{$key}] was not an integer [{$string}]");
        }
    }

    /**
     * Validate string
     *
     * @param string $key
     * @param string $string
     * @throws InvalidOptionException
     */
    protected function validateString($key, $string)
    {
        if (!is_string($string)) {
            throw new InvalidOptionException("[{$key}] was not a string [{$string}]");
        }
    }

    /**
     * Validate domain
     *
     * @param string $key
     * @param string $domain
     * @throws InvalidOptionException
     */
    protected function validateDomain($key, $domain)
    {
        if (!preg_match('/^[a-z0-9-.]+$/i', $domain)) {
            throw new InvalidOptionException("[{$key}] was not a valid domain [{$domain}]");
        }
    }

    /**
     * Validate date
     *
     * @param string $key
     * @param string $date
     * @throws InvalidOptionException
     */
    protected function validateDate($key, $date)
    {
        if (!preg_match('/^20[0-2][0-9][0-1][0-9]15$/', $date)) {
            throw new InvalidOptionException("[{$key}] was not a valid date [{$date}]");
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
        if (count($unknownColumns) > 0) {
            throw new InvalidOptionException("Invalid [{$key}](s) [" . implode(", ", $unknownColumns) . "] passed for request [{$this->type}]");
        }
    }

    /**
     * Load request definition
     *
     * @return Definition
     */
    protected function loadRequestDefinition()
    {
        $this->definition = new Definition($this->type);
    }

    /**
     * Get the columns for this request
     *
     * @return string[]
     */
    public function getExpectedResultColumns()
    {
        if (isset($this->options['export_columns'])) {
            return $this->options['export_columns'];
        }
        return $this->definition->getDefaultColumns();
    }

    /**
     * Get all the options of this request
     *
     * @return array
     */
    public function getUrlParameters()
    {
        return $this->options;
    }

    /**
     * Get the request endpoint relative path.
     *
     * @return string
     */
    protected function getEndpointPath()
    {
        return $this->endpoint_path;
    }

    /**
     * Get the request endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return static::DOMAIN . $this->getEndpointPath();
    }


} 