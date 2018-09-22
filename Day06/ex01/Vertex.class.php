<?php

Class Vertex {

	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;
	private $_color;

	static $verbose = false;

	//faire les setteur et geteur
	
	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }
	public function getColor() { return $this->_color; }

	public function setX ($set) { $this->_x = $set; return;}
	public function setY ($set) { $this->_y = $set; return;}
	public function setZ ($set) { $this->_z = $set; return;}
	public function setW ($set) { $this->_w = $set; return;}
	public function setColor ($set) { $this->_color = $set; return;}
	
	static function doc () {
		echo file_get_contents('Vertex.doc.txt').PHP_EOL;
	}

	function __toString () {
		if (self::$verbose)
			return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3d, green: %3d, blue: %3d ) )", $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
		else
			return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
		return ;
   }

   function __construct(array $kwargs) {
		if (array_key_exists('x', $kwargs) && array_key_exists('y', $kwargs) && array_key_exists('z', $kwargs))
		{
			$this->_x = $kwargs['x'];
			$this->_y = $kwargs['y']; 
			$this->_z = $kwargs['z'];  
			if (array_key_exists('w', $kwargs))
				$this->_w = $kwargs['w']; 
			if (array_key_exists('color', $kwargs))
			{	
				if ($kwargs['color'] instanceof Color)
				$this->_color = $kwargs['color'];
			}
			else
				$this->_color = new Color (array('rgb' => 0xFFFFFF)) ;
		}
		else
			return;
		if (self::$verbose)
		{
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
		}
		return ;
   }

   function __destruct() {
		if (self::$verbose)
		{
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
		}
	}
}

?>