<?php
/**
 * An example on a Specification
 *
 * However, this is not a real object, as it uses no object variables,
 * so maybe it is more clever to let the rule extend the SingleFieldSpecification?
 */
final class Rule_Email extends Rule_Base
{

    /**
     * Applies rule
     *
     * @param array $data Data to be applied
     *
     * @return boolean
     */
    public function isSatisfiedBy($candidate)
    {
        $email = $candidate->get($this->fieldname);
        if (empty($email) OR !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
            return false;
        }
        return true;
    }
}
