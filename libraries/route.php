<?php
defined('__sw__') or die('Restricted Access');

if(!class_exists('Route')){
	class Route {
		protected static $_instance = null;
		protected $_r;
		private function __construct(){
			$this->_r = array_diff(preg_split( '/\//', $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY ),preg_split( '/\//', $_SERVER['SCRIPT_NAME'], -1, PREG_SPLIT_NO_EMPTY ));
		}
		public static function Instance(){
			if(is_null(self::$_instance)) self::$_instance = new Route;
			return self::$_instance;
		}
		public function Controller(){ return (isset($this->_r[0])? $this->_r[0]: 'home'); }
		public function Action(){ return (isset($this->_r[1])? $this->_r[1]: 'display'); }
		public function Params(){ return (count($this->_r)>2? array_slice($this->_r,2): array()); }
		public function Cap(){ return array($this->Controller(), $this->Action(), $this->Params()); }
	}
}
