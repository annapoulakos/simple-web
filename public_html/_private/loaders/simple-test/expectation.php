<?php

class Expectation {
    protected $value;
    public function __construct($value){
        $this->value = $value;
    }

    protected function Status($condition){
        return ($condition)? '<span class="text-success">Success</span>': '<span class="text-error">Failure</span>';
    }
    protected function Expect($expectation){
        SimpleTest::AddExpectation( sprintf(SimpleTest::EXPECTATION_TEMPLATE, $expectation) );
    }
    public function ToBe($test){
        $expectation = 'Expects '. $this->value .' to be '. $test .': ' . $this->Status($test===$this->value);
        $this->Expect($expectation);
    }
    public function NotToBe($test){
        $expectation = 'Expects '. $this->value .' not to be '. $test .': ' . $this->Status($test !== $this->value);
        $this->Expect($expectation);
    }
    public function ToEqual($test){
        $expectation = 'Expects '. $this->value .' to equal '. $test .': ' . $this->Status($test == $this->value);
        $this->Expect($expectation);
    }
    public function ToBeLessThan($test){
        $expectation = 'Expects '. $this->value .' to be less than '. $test .': '. $this->Status($this->value < $test);
        $this->Expect($expectation);
    }
    public function ToBeGreaterThan($test){
        $expectation = 'Expects '. $this->value .' to be greater than '. $test .': '. $this->Status($this->value > $test);
        $this->Expect($expectation);
    }
    public function ToBeType($type){
        $expectation = 'Expects $this->value to be of type '. $type .': ' .$this->Status(gettype($this->value)==$type);
        $this->Expect($expectation);
    }
    public function ToHaveClass($class){
        $expectation = 'Expects this object to have class '. $class .': '. $this->Status(get_class($this->value)==$class);
        $this->Expect($expectation);
    }
    public function ToHaveKey($key){
        $expectation = 'Expects $this->value to have this key '. $key .': '. $this->Status(array_key_exists($key, $this->value));
        $this->Expect($expectation);
    }
    public function ToContain($value){
        $expectation = 'Expects $this->value to contain this value '. $value .': '. $this->Status(false !== array_search($value, $this->value));
        $this->Expect($expectation);
    }
}
