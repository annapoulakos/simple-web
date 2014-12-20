<?php

class Rule extends Container {

    /**
     * Default constructor generates stub functions that need to be fleshed out.
     * @param {string} $rule The name of the Rule.
     */
    public function __construct ($rule) {
        $this->rule = $rule;

        $this->condition = function ($context) {
            return false;
        };

        $this->then = function ($context) {};
    }

    /**
     * Executes this rule's logic
     * @param  {mixed} $value The value to run the rule's logic against.
     * @return {mixed}        Returns a possibly modified value.
     */
    public function execute ($value) {
        $this->value = $value;
        if ($this->condition) {
            $this->then;
        }

        return $this->value;
    }
}
