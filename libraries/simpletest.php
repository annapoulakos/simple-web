<?php

/**
 * Super Simple Test Suite
 */

class SimpleTest {
	const SUITE_TEMPLATE = '<div class="container"><h1>%s</h1></div>';
	const SPECIFICATION_TEMPLATE = '<div class="row-fluid"><div class="col-md-4"><h2>%s</h2></div><div class="col-md-8"><ul class="list-unstyled">%s</ul></div>';
	const EXPECTATION_TEMPLATE = '<li>%s</li>';

	protected static $exepctations = array();
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

function describe( $suite, $lambda ){
	SimpleTest::AddSuite( $suite );
	$lambda();
}
function it( $spec, $lambda ){
	SimpleTest::AddSpecification( $spec );
	$lambda();
}
function expect( $value ){
	return new Expectation($value);
}
function note( $message ){
	SimpleTest::AddExpectation( sprintf(SimpleTest::EXPECTATION_TEMPLATE,'<span class="text-info">'.$message.'</span>') );
}
