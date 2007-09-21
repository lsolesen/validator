<?php
/**
 * This is a stand in for the requests. It helps to make sure, that
 * validated object is not copied into a clean value object before the values
 * are validated.
 *
 * Should probably get a logger also, or should we just make it possible using some form of callback?
 */
class Validator_Coordinator
{
    private $raw;
    private $clean;
    private $errors = array();

    public function __construct($raw, $clean)
    {
        $this->raw = $raw;
        $this->clean = $clean;
    }

    public function get($name)
    {
        return $this->raw->getForValidation($name);
    }

    public function setClean($name = false)
    {
        if (!$name) {
                return false;
        }
        $this->clean = $this->clean->set($name, $this->raw->getForValidation($name));
    }

    public function getCleanRequest()
    {
        return $this->clean;
    }

    // we need to be able to remember the errors for next page
    public function addError($field, $error)
    {
        $this->errors[$field] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /*
    public function __sleep() {
        $properties = array();
        $class = new ReflectionClass($this);
        foreach ($class->getProperties() as $property) {
            $properties[] = $property->getName();
        }
        return $properties;
    }
    */

}
