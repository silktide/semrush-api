<?php


namespace AndyWaite\SemRushApi;

use AndyWaite\SemRushApi\Data\Database;
use AndyWaite\SemRushApi\Data\Type;
use AndyWaite\SemRushApi\Exception\InvalidOptionException;
use AndyWaite\SemRushApi\Model\Definition;

class Request
{

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
        $this->options = ['type' => $type] + $options;
        $this->loadRequestDefinition();
        $this->mergePresets();
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
        if (count($unknownOptions) > 0)
        {
            throw new InvalidOptionException("Invalid option(s) [".implode(", ", $unknownOptions)."] passed for request [{$this->type}]");
        }

        //check for missing options
        $requiredOptions = array_keys($this->definition->getRequiredFields());
        $missingOptions = array_diff($requiredOptions, $optionsPassed);
        if (count($missingOptions) > 0)
        {
            throw new InvalidOptionException("Missing option(s) [".implode(", ", $missingOptions)."] which are required for request [{$this->type}]");
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
    * TODO: Implement proper domain validation
    */
    protected function validateDomain($key, $domain)
    {
        if (!is_string($domain)) {
            throw new InvalidOptionException("[{$key}] was not a valid domain [{$domain}]");
        }
    }

    /**
     * Validate date
     *
     * @param string $key
     * @param string $date
     * @throws InvalidOptionException
     * TODO: Implement proper date validation
     */
    protected function validateDate($key, $date)
    {
        if (!is_string($date)) {
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