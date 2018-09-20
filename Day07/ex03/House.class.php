<?php
abstract Class House {

	private $_houseName;
	private $_houseMotto;
	private $_houseSeat;

	public function introduce () {
		$this->_houseName = static::getHouseName();
		$this->_houseMotto = static::getHouseMotto();
		$this->_houseSeat = static::getHouseSeat();
		printf("House %s of %s : \"%s\"".PHP_EOL, $this->_houseName, $this->_houseSeat, $this->_houseMotto);
	}

	abstract function getHouseName();
	abstract function getHouseMotto();
	abstract function getHouseSeat();
}
?>