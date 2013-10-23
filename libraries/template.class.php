<?php
if(!class_exists('Template')){
	class Template {
		public $_file;
		public $_data = array();

		/**
		 * __construct
		 * Default construtor method
		 * @param <string> $file Path to template file. Best to use absolute filepaths for this.
		 * @return Throws an exception if the template cannot be found.
		 */
		public function __construct($file){
			if(!file_exists($file)){
				throw new Exception("The template file {$file} was not found on this server.");
			}

			$this->_file = $file;
		}

		/**
		 * __get
		 * Magic getter method.
		 * @param <string||int> $key The key to request.
		 * @return <mixed> Returns the value stored via the requested key. Throws an exception if the requested key cannot be found.
		 */
		public function __get($key){
			if(isset($this->_data[$key])) return $this->_data[$key];

			throw new Exception("The requested key '{$key}' was not found.");
		}

		/**
		 * __set
		 * Magic setter method
		 * @param <string||int> $key The key to store the value at.
		 * @param <mixed> $value The value to store in the specified key.
		 * @return <Template> Returns a reference to self.
		 */
		public function __set($key, $value){
			$this->_data[$key] = $value;
			return $this;
		}

		/**
		 * Render
		 * Renders the template to a string.
		 * @return <string> Returns the fully rendered template.
		 */
		public function Render(){
			$output = file_get_contents($this->_file);
			foreach($this->_data as $key => $value){
				$output = str_replace("[@{$key}]", $value, $output);
			}

			return $output;
		}
	}
}
