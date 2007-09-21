<?php
// somehow it would be clever if this could be used as a memory
class Request_Raw
{
    private $data = array();

    /**
     * Constructs with optional data
     *
     * After construction the object, destroy the globals to prevent non-validated input
     * from being used inadvertently.
     *
     * @param array $data Optional data array
     */
    public function __construct($data = null)
    {
        $this->data = $data
                    ? $data
                    : $this->initFromHttp();
        unset($_REQUEST);
        unset($_POST);
        unset($_GET);
    }

    /**
     * POST overrides GET
     */
    private function initFromHttp()
    {
        if (!empty($_POST)) return $_POST;
        if (!empty($_GET)) return $_GET;
        return array();
    }

    public function getForValidation($var) {
        return $this->data[$var];
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
