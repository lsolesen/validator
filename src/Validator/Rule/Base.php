<?php
class Rule_Base
{
    protected $fieldname;

    function __construct($fieldname)
    {
        $this->fieldname = $fieldname;
    }

    function getValidatedField()
    {
        return $this->fieldname;
    }
}