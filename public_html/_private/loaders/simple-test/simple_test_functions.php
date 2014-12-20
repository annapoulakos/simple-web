<?php

function describe ($suite, $lambda) {
    SimpleTest::AddSuite($suite);
    $lambda();
}

function it ($specification, $lambda) {
    SimpleTest::AddSpecification($specification);
    $lambda();
}

function expect ($value) {
    return new Expectation($value);
}

function note ($message) {
    SimpleTest::AddExpectation(sprintf(SimpleTest::EXPECTATION_TEMPLATE, '<span class="text-info"><i class="fa fa-fw fa-info-circle"></i> ' . $message . '</span>'));
}

function debug ($value) {
    SimpleTest::AddExpectation(sprintf(SimpleTest::EXPECTATION_TEMPLATE, '<pre>' . print_r($value, true) . '</pre>'));
}
