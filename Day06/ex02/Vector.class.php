<?php
Class Vector {

	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;
	private $_dest_vertex;
	private $_orig_vertex;
	static $verbose = false;

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	static function doc () {
		echo file_get_contents('Vector.doc.txt').PHP_EOL;
	}

	function __toString () {
		if (self::$verbose)
			return "avec verbose";
		else
			return "sans verbose";
		return ;

	function __construct(array $kwargs) {
		if (array_key_exists('dest', $kwargs))
		{
			$this->_dest_vertex = $kwargs['dest'];
			if (array_key_exists('orig', $kwargs))
				$this->_orig_vertex = $kwargs['orig'];
			else
			{
				$this->_orig_vertex = new Vertex (array ('x' => 0, 'y' => 0, 'z' => 0));
			}
		}
		else
			return;
		if (self::$verbose)
			printf ("constructed");
		return ;
	}

	function __destruct() {
		if (self::$verbose)
			printf("destructed");
		return ;
	}

	public function float magnitude () {
		echo "magnitude";
	}

	public function Vector normalize() {
		echo "normalize"
	}

	public function Vector add( Vector $rhs) {
		echo "add";
	}

	public function Vector sub (Vector $rhs) {
		echo "sub";
	}

	public function Vector opposite() {
		echo "opposite";
	}

	public function Vector scalarProduct($k) {
		echo "scalar product";
	}

	public function float dotProduct(Vector $rhs) {
		echo "dotProduct";
	}

	public function float cos(Vector $rhs){
		echo "cos";

	}

	public function Vector cross(Vector $rhs) {
		echo "cross";
	}
}
?>