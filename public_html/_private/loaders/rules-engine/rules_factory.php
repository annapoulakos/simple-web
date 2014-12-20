<?php

class RulesFactory {
    protected static $_rules = array();
    public static $_rule_groups = array();

    /**
     * Returns a Rule from the cache; creates a Rule if there is no matching cached rule.
     * @param {string} $rule The name of the Rule.
     * @return {Rule} The requested Rule.
     */
    public static function Rule ($rule) {
        if (!isset(self::$_rules[$rule])) {
            self::$_rules[$rule] = new Rule($rule);
        }

        return self::$_rules[$rule];
    }

    /**
     * Returns a RuleGroup from the cache; creates a RuleGroup if there is no matching cached rule group.
     * @param {string} $rule_group The name of the RuleGroup.
     * @return {RuleGroup} The requested RuleGroup.
     */
    public static function RuleGroup ($rule_group) {
        if (!isset(self::$_rule_groups[$rule_group])) {
            self::$_rule_groups[$rule_group] = new RuleGroup($rule_group);
        }

        return self::$_rule_groups[$rule_group];
    }
}
