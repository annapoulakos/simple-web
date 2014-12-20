<?php

class RuleGroup extends Container {
    /**
     * Default constructor sets the group's name.
     * @param {string} $rule_group The name of the RuleGroup.
     */
    public function __construct ($rule_group) {
        $this->rule_group = $rule_group;
    }

    /**
     * Adds a set of rules to be run during execution.
     * @param {Rule[]} $rules An array of Rule objects.
     */
    public function set_rules (array $rules) {
        $this->rules = $rules;
    }

    /**
     * Executes each Rule's logic in this RuleGroup.
     * @param  {mixed} $value The value to run the rules against.
     * @return {mixed}        The value after all rules have been applied.
     */
    public function execute ($value) {
        foreach ($this->rules as $rule) {
            $value = $rule->execute($value);
        }

        return $value;
    }
}
