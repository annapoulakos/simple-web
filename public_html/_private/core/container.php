<?php

class Container {
    public $_data = array();

    /**
     * Returns the item by key. For callable functions, returns the called return value.
     * @param  {string} $key The key to search for
     * @return {mixed}      Returns the item by key, unless the keyed item is callable in which case
     *                              it returns the called function's return value.
     * @throws {Exception} If the key requested does not exist.
     */
    public function __get ($key) {
        if (!isset($this->_data[$key])) {
            throw new Exception("{$key} is not a valid key.");
        }

        if (is_callable($this->_data[$key]) {
            return $this->_data[$key]($this);
        }

        return $this->_data[$key];
    }

    /**
     * Used to set a value to a key
     * @param {string} $key   The key to store the value in.
     * @param {mixed} $value The item to store
     */
    public function __set ($key, $value) {
        $this->_data[$key] = $value;
    }

    /**
     * Used to generate singleton-style items and/or functions. Note: The lamdba is only ever called once.
     * @param  {Closure} $lambda A lambda function that is run and has its return value stored statically.
     * @return {mixed}         The result of the lambda function's execution.
     */
    public function _ ($lambda) {
        return function ($context) use ($lambda) {
            static $object = null;
            if (is_null($object)) {
                $object = $lambda($context);
            }
            return $object;
        }
    }
}
