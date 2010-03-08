<?php
/**
 * An example on a Specification
 *
 * However, this is not a real object, as it uses no object variables,
 * so maybe it is more clever to let the rule extend the SingleFieldSpecification?
 */
final class Rule_Equal extends Rule_Base
{
    private $fieldname_compare;

    function __construct($fieldname, $compare)
    {
        $this->fieldname = $fieldname;
        $this->fieldname_compare = $compare;
    }

    /**
     * Applies rule
     *
     * @param object $candidate
     *
     * @return boolean
     */
    public function isSatisfiedBy($candidate)
    {
        return ($candidate->get($this->fieldname_compare) == $candidate->get($this->fieldname));
    }
}
