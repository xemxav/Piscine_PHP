<?php

Class Color {

	public $red = 0;
	public $green = 0;
	public $blue = 0;
	static $verbose = false;

	function __constructor(array $kwargs) {

		if (array_key_exists('rgb', $kwargs))
		{

		}
		else if (array_key_exists('red', $kwargs) && array_key_exists('green', $kwargs) & array_key_exists('blue', $kwargs))
		{

		}
		else
			return ;
		settype($red, "integer");
		settype($green, "integer");
		settype($blue, "integer");

		if ($verbose)
		return ;
	}

	public function doc () {
		lire depuis Color.doc.txt
	}

	function __destruct() {
		if ($verbose)
		return ;
	}

	function __to_string{


	}

	function add (){

	}

	function sub (){

	}

	function mult () {
		
	}
	?>