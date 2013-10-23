<?php
if(!class_exists('Container')){
	class Container {
		protected $_data = array();

		/**
		 * __set
		 * Magic setter method
		 * @param <string||int> $key The key to store the value in.
		 * @param <mixed> $value The value being stored.
		 * @return <Container> Returns reference to self.
		 */
		public function __set($key, $value){
			$this->_data[$key] = $value;

			return $this;
		}

		/**
		 * __get
		 * Magic getter method.
		 * @param <string||int> $key The key to retrieve.
		 * @return <mixed> Returns the value stored by the requested key. If callable, returns the callable function. Throws exception if key not found.
		 */
		public function __get($key){
			if(!isset($this->_data[$key])){
				throw new Exception("The requested key '{$key}' does not exist.");
			}

			if(is_callable($this->_data[$key])){
				return $this->_data[$key]($this);
			}
			return $this->_data[$key];
		}

		/**
		 * _
		 * Pseudo-singleton pattern callable factory function.
		 * @param <Closure> $lambda The closure which creates the singleton object.
		 * @return <mixed> Returns a singleton object of the type defined in the lambda function.
		 */
		public function _($lambda){
			return function($me) use($lambda){
				static $output;
				if(is_null($output)){
					$output = $lambda($me);
				}
				return $output;
			}
		}
	}
}
