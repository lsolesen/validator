<?php
require_once 'Validator/Coordinator.php';
require_once 'Validator/Basic.php';
require_once 'Request/Raw.php';
require_once 'Request/Clean.php';
require_once 'Rule/Base.php';
require_once 'Rule/Email.php';

// i think the coordinator needs to contain the logger

class Validator
{
    private $coordinator;
    private $validators = array();
    private $hasValidated = FALSE;

    public function add($validator) {
        $this->validators[] = $validator;
    }

    public function validate($request) {
        $this->coordinator = $this->createCoordinator($request,
                                                      new Request_Clean);
        foreach ($this->validators as $validator) {
            $validator->validate($this->coordinator);
        }
        $this->hasValidated = TRUE;
        return $this->isValid();
    }

    public function isValid() {
        if (!$this->hasValidated) return FALSE;
        return count($this->coordinator->getErrors()) == 0;
    }

    public function createCoordinator($raw, $clean) {
        return new Validator_Coordinator($raw, $clean);
    }

    public function getCleanRequest() {
        if (!$this->isValid()) return FALSE;
        return $this->coordinator->getCleanRequest();
    }

    public function getErrors() {
        if ($this->isValid()) return FALSE;
        return $this->coordinator->getErrors();
    }
}
