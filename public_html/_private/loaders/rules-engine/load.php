<?php

if (!defined('__RULES_ENGINE__')) {

    include dirname(__FILE__). '/rules_factory.php';
    include dirname(__FILE__). '/rule.php';
    include dirname(__FILE__). '/rule_group.php';

    define('__RULES_ENGINE__', true);
}
