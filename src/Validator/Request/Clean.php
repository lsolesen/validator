<?php
class Request_Clean
{
    private $data = array();

    public function get($var)
    {
        if (!array_key_exists($var,$this->data)) return '';
        return $this->data[$var];
    }

    /**
     * Returns a clone, because it is only a value object, which identity is not important.
     */
    public function set($var,$value)
    {
        $clone = clone $this;
        $clone->data[$var] = $value;
        return $clone;
    }

    public function toQueryString() {
        if (count($this->data) == 0) return '';
        $vars = array();
        foreach ($this->data as $var => $val) {
            $vars[] = "$var=$val";
        }
        return "?".join('&',$vars);
    }
}
