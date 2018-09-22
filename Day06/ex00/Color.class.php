<?php

Class Color {

	public $red = 0;
	public $green = 0;
	public $blue = 0;
	static $verbose = false;

	function __construct (array $kwargs) {
		
		if (array_key_exists('rgb', $kwargs))
		{
			settype($kwargs['rgb'], "integer");
			$this->red = ($kwargs['rgb'] & 0xff0000) >> 16;
			$this->green = ($kwargs['rgb'] & 0x00ff00) >> 8;
			$this->blue = $kwargs['rgb'] & 0xff;
		}
		else if (array_key_exists('red', $kwargs) && array_key_exists('green', $kwargs) && array_key_exists('blue', $kwargs))
		{
			settype($kwargs['red'], "integer");
			settype($kwargs['green'], "integer");
			settype($kwargs['blue'], "integer");
			$this->red = $kwargs['red'];
			$this->green = $kwargs['green'];
			$this->blue = $kwargs['blue'];
		}
		if (self::$verbose)
		{	printf('Color( red: %3d, green: %3d, blue :%3d) constructed.', $this->red, $this->green, $this->blue);
			echo PHP_EOL;}
		return ;
	}

	static function doc () {
		echo file_get_contents('Color.doc.txt').PHP_EOL;
	}

	function __destruct() {
		if (self::$verbose)
		{	printf('Color( red: %3d, green: %3d, blue :%3d) destructed.', $this->red, $this->green, $this->blue);
			echo PHP_EOL;}
		return ;
	}

	function __toString () {
		 return sprintf('Color( red: %3d, green: %3d, blue :%3d)', $this->red, $this->green, $this->blue);
	}

	function add ($inst){
		
		$newinst = new Color( array( 'red' => $this->red + $inst->red, 'green' => $this->green + $inst->green, 'blue' => $this->blue + $inst->blue));
		$newinst->verbose = self::$verbose;
		return $newinst;
	}

	function sub ($inst){
		
		$newinst = new Color( array( 'red' => $this->red - $inst->red, 'green' => $this->green - $inst->green, 'blue' => $this->blue - $inst->blue));
		$newinst->verbose = self::$verbose;
		return $newinst;
	}
	

	function mult ($f){
		
		$newinst = new Color( array( 'red' => $this->red * $f, 'green' => $this->green * $f, 'blue' => $this->blue * $f));
		$newinst->verbose = self::$verbose;
		return $newinst;
	}
	
	}
?>