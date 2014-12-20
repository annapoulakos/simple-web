<?php

/**
 * All models in this directory need to use the namespaced version of idiorm.
 * Additionally, all models should make sure to set a $_connection_name property.
 */

class Info extends \Idiorm\Model {
    public static $_connection_name = 'testing';
}
