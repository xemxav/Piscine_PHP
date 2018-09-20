<?php
Class NightsWatch {

	public $blackwearer;

	function __construct() {
		$this->blackwearer = array();
	}

	public function recruit($inst){
		if ($inst instanceof IFighter)
			$this->blackwearer[] = $inst;
	}
	public function fight(){
		foreach ($this->blackwearer as $fighter)
			$fighter->fight();
	}
}
?>