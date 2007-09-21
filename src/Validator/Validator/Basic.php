<?php
/**
 * Responsible for any kind of validation. The actual validation is farmed out
 * to a specification object. This validator is responsible for either setting the
 * clean values or adding an error message. All this is assembled by the coordinator.
 *
 * The responsibility of the validator itself is to talk back; to report to the coordinator
 * what’s OK and what isn’t. In the constructor, we supply it with an error message that
 * it can use for that purpose. It also needs the Specification object that encapsulates the
 * nature of the check being performed.
 *
 * If the Specification object is satisfied, the validator uses setClean() to report that fact
 * to the coordinator. The coordinator then copies the value to the CleanRequest object.
 *
 * Returning TRUE is not strictly necessary in the context, but it’s logical.
 *
 * If the Specification object is not satisfied, the validator adds the error message to the
 * coordinator’s error list.
 */
class Validator_Basic
{

    private $specification;
    private $message;

    public function __construct($specification, $message)
    {
        $this->specification = $specification;
        $this->message = $message;
    }

    public function validate($coordinator)
    {
        if ($this->specification->isSatisfiedBy($coordinator)) {
            $coordinator->setClean($this->specification->getValidatedField());
            return true;
        } else {
            $coordinator->addError($this->specification->getValidatedField(), $this->message);
            return false;
        }
    }
}
