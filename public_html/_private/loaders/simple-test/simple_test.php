<?php

class SimpleTest {
    const SUITE_TEMPLATE = '<div class="container"><h1>%s</h1><hr>%s</div>';
    const SPECIFICATION_TEMPLATE = '<div class="row-fluid"><div class="col-md-4"><h2>%s</h2></div><div class="col-md-8"><ul class="list-unstyled">%s</ul></div></div><hr>';
    const EXPECTATION_TEMPLATE = '<li>%s</li>';

    protected static $expectations = array();
    public static function AddExpectation($expectation){
        self::$expectations = $expectation;
    }

    protected static $specifications = array();
    protected static $currentSpecification = null;
    public static function AddSpecification($specification){
        if(!is_null(self::$currentSpecification)){
            self::$specifications[self::$currentSpecification] = self::$expectations;
            self::$expectations = array();
        }

        self::$currentSpecification = $specification;
    }

    protected static $suites = array();
    protected static $currentSuite = null;
    public static function AddSuite($suite){
        if(!is_null(self::$currentSuite)){
            self::$specifications[self::$currentSpecification] = self::$expectations;
            self::$expectations = array();
            self::$currentSpecification = null;
            self::$suites[self::$currentSuite] = self::$specifications;
            self::$specifications = array();
        }

        self::$currentSuite = $suite;
    }

    public static function Render(){
        if(!is_null(self::$currentSuite)){
            self::$specifications[self::$currentSpecification] = self::$expectations;
            self::$expectations = array();
            self::$currentSpecification = null;
            self::$suites[self::$currentSuite] = self::$specifications;
            self::$specifications = array();
        }

        $suites = array();
        foreach(self::$suites as $suite => $specifications){
            $specs = array();
            foreach($specifications as $specification => $expectations){
                $specs[] = sprintf(self::SPECIFICATION_TEMPLATE, $specification, implode('', $expectations));
            }
            $suites[] = sprintf(self::SUITE_TEMPLATE, $suite, implode('', $specs));
        }

        echo implode('', $suites);
    }

    public static function Raw(){
        echo '<pre>' . print_r(self::$suites, true). '</pre>';
    }
}
