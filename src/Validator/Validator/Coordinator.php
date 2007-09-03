<?php
/**
 * Essentially this is a stand in for the requests. It helps to make sure, that
 * the validated object is not copied into a clean value object before the values
 * are validated.
 *
 * It should be simple to put in a logger object to remember the messages.
 */
class Validator_Coordinator
{
    private $raw;
    private $clean;
    private $errors = array();

    public function __construct($raw,$clean) {
        $this->raw = $raw;
        $this->clean = $clean;
    }

    public function get($name) {
        return $this->raw->getForValidation($name);
    }

    public function setClean($name=FALSE) {
        if (!$name) return FALSE;
        $this->clean = $this->clean->set(
        $name,
        $this->raw->getForValidation($name));
    }

    public function addError($error) {
        $this->errors[] = $error;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getCleanRequest() {
        return $this->clean;
    }
}
