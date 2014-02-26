<?php
defined('__sw__') or die('Restricted Access');

if(!class_exists('Template')){
	class Template {
		protected $_d=array(),$_f=null;
		public function __construct($f){
			if(!file_exists($f)) throw new Exception("File Not Found Exception: The requested file ({$f}) was not found on this server.");
			$this->_f=$f;
		}
		public function __set($k,$v){ $this->_d[$k]=$v; }
		public function Render(){
			$o = file_get_contents($this->_f);
			foreach($this->_d as $k=>$v) $o = str_replace("[@{$k}]",$v,$o);
			return $o;
		}
	}
}
