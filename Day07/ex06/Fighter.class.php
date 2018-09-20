<?php
abstract Class Fighter {

	public $type;

	function __construct($str) {
		$this->type = $str;
	}

	abstract public function fight($target);
}
?>