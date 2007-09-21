<?php
/**
 * A facade to make it easy to validate objects.
 */

class Validator
{
    private $coordinator;
    private $validators = array();
    private $hasValidated = FALSE;

    public function add($validator)
    {
        $this->validators[] = $validator;
    }

    public function addBasicValidator($rule, $message)
    {
        $this->validators[] = new Validator_Basic($rule, $message);
    }

    public function validate($request)
    {
        $this->coordinator = $this->createCoordinator($request, new Request_Clean);
        foreach ($this->validators as $validator) {
            $validator->validate($this->coordinator);
        }
        $this->hasValidated = TRUE;
        return $this->isValid();
    }

    public function isValid()
    {
        if (!$this->hasValidated) return FALSE;
        return count($this->coordinator->getErrors()) == 0;
    }

    public function createCoordinator($raw, $clean)
    {
        return new Validator_Coordinator($raw, $clean);
    }

    public function getCleanRequest()
    {
        if (!$this->isValid()) {
            return false;
        }
        return $this->coordinator->getCleanRequest();
    }

    public function getErrors()
    {
        if ($this->isValid()) {
            return false;
        }
        return $this->coordinator->getErrors();
    }
}
