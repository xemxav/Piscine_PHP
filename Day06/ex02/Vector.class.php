<?php
Class Vector {

	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0;
	static $verbose = false;

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	static function doc () {
		echo file_get_contents('Vector.doc.txt').PHP_EOL;
	}

	function __toString () {
			return sprintf ("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
	}

	function __construct(array $kwargs) {
		if (array_key_exists('dest', $kwargs))
		{
			if (!(array_key_exists('orig', $kwargs)))
			{
				
				$kwargs['orig'] = new Vertex (array ('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1));
			}
			$this->_x = $kwargs['dest']->getX() - $kwargs['orig']->getX();
			$this->_y = $kwargs['dest']->getY() - $kwargs['orig']->getY();
			$this->_z = $kwargs['dest']->getZ() - $kwargs['orig']->getZ();
		}
		else
			return;
		if (self::$verbose)
			printf ("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w);
		return ;
	}

	function __destruct() {
		if (self::$verbose)
			printf ("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w);
		return ;
	}

	public function magnitude () {
		return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
	}

	public function normalize() {
		$mag = self::magnitude();
		$tmpVertex = new Vertex (array('x' => ($this->_x)/$mag, 'y'=> ($this->_y)/$mag, 'z' => ($this->_z)/$mag));
		return new Vector (array('dest' => $tmpVertex));
	}

	public function add($rhs) {
		$x = $this->_x + $rhs->getX();
		$y = $this->_y + $rhs->getY();
		$z = $this->_z + $rhs->getZ();
		$tmpVertex = new Vertex (array('x' => $x, 'y'=> $y, 'z' => $z));
		return new Vector (array('dest' => $tmpVertex));
	}

	public function sub($rhs) {
		$x = $this->_x - $rhs->getX();
		$y = $this->_y - $rhs->getY();
		$z = $this->_z - $rhs->getZ();
		$tmpVertex = new Vertex (array('x' => $x, 'y'=> $y, 'z' => $z));
		return new Vector (array('dest' => $tmpVertex));
	}

	public function opposite() {
		$x = $this->_x * -1;
		$y = $this->_y * -1;
		$z = $this->_z * -1;
		$tmpVertex = new Vertex (array('x' => $x, 'y'=> $y, 'z' => $z));
		return new Vector (array('dest' => $tmpVertex));
	}

	public function scalarProduct($k) {
		$x = $this->_x * $k;
		$y = $this->_y * $k;
		$z = $this->_z * $k;
		$tmpVertex = new Vertex (array('x' => $x, 'y'=> $y, 'z' => $z));
		return new Vector (array('dest' => $tmpVertex));
	}

	public function dotProduct($rhs) {
		$x = $this->_x * $rhs->getX();
		$y = $this->_y * $rhs->getY();
		$z = $this->_z * $rhs->getZ();
		return $x + $y + $z;
	}

	public function  cos($rhs){
		$scal = self::dotProduct($rhs);
		$mag1 = self::magnitude();
		$mag2 = $rhs->magnitude();
		return $scal / ($mag1 * $mag2);
	}

	public function crossProduct($rhs) {
		$x = $this->_y * $rhs->getZ() - $this->_z * $rhs->getY();
		$y = $this->_z * $rhs->getX() - $this->_x * $rhs->getZ();
		$z = $this->_x * $rhs->getY() - $this->_y * $rhs->getX();
		$tmpVertex = new Vertex (array('x' => $x, 'y'=> $y, 'z' => $z));
		return new Vector (array('dest' => $tmpVertex));
	}
 }

?>