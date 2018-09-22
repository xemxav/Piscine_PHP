<?php
CLass Matrix {

	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 3;
	const RY = 4;
	const RZ = 5;
	const TRANSLATION = 6;
	const PROJECTION = 7;
	static $verbose = false;
	private $_args;
	private $_matrice;
	private $const_array;

	static function doc () {
		echo file_get_contents('Matrix.doc.txt').PHP_EOL;
	}

	public function getArgs() {return $this->_args;}
	public function getMatx() {return $this->_matrice;}
	public function setMatx($set) {$this->_matrice = $set;} 

	function __toString () {
			$ligne0 = "M | vtcX | vtcY | vtcZ | vtxO".PHP_EOL;
			$ligne1 = "-----------------------------".PHP_EOL;
			$lignex = sprintf("x | %.2f | %.2f | %.2f | %.2f ".PHP_EOL, 
			$this->_matrice['vtcX']['x'],$this->_matrice['vtcY']['x'],$this->_matrice['vtcZ']['x'],$this->_matrice['vtxO']['x']);
			$ligney = sprintf("y | %.2f | %.2f | %.2f | %.2f ".PHP_EOL, 
			$this->_matrice['vtcX']['y'],$this->_matrice['vtcY']['y'],$this->_matrice['vtcZ']['y'],$this->_matrice['vtxO']['y']);
			$lignez = sprintf("z | %.2f | %.2f | %.2f | %.2f ".PHP_EOL, 
			$this->_matrice['vtcX']['z'],$this->_matrice['vtcY']['z'],$this->_matrice['vtcZ']['z'],$this->_matrice['vtxO']['z']);
			$lignew = sprintf("w | %.2f | %.2f | %.2f | %.2f ".PHP_EOL, 
			$this->_matrice['vtcX']['w'],$this->_matrice['vtcY']['w'],$this->_matrice['vtcZ']['w'],$this->_matrice['vtxO']['w']);
			return $ligne0.$ligne1.$lignex.$ligney.$lignez.$lignew;
	}

	function __construct(array $kwargs) {
		if (self::goodkawrgs($kwargs))
		{
			//echo "ok pour les arguments\n";
			$this->_args = $kwargs;
			$this->const_array = array('constantes','IDENTITY','SCALE','RX','RY','RZ','TRANSLATION','PROJECTION');
			$this->_matrice = array('vtcX' => array ('x' => 1, 'y'=>0, 'z' => 0, 'w'=>0),
			'vtcY' => array ('x' => 0, 'y'=>1, 'z' => 0, 'w'=>0),
			'vtcZ' => array ('x' => 0, 'y'=>0, 'z' => 1, 'w'=>0),
			'vtxO' => array ('x' => 0, 'y'=>0, 'z' => 0, 'w'=>1));
			self::transform_matrix($this->_args);
		}
		if (self::$verbose)
		{
			if ($this->_args['preset'] == self::IDENTITY)
			{
				printf('Matrix %s instance constructed'.PHP_EOL, $this->const_array[$this->_args['preset']]);
			}
			else if ($this->_args['preset'] == self::RX)
			{
				print('Matrix Ox ROTATION preset instance constructed'.PHP_EOL);
			}
			else if ($this->_args['preset'] == self::RY)
			{
				print('Matrix Oy ROTATION preset instance constructed'.PHP_EOL);
			}
			else if ($this->_args['preset'] == self::RZ)
			{
				print('Matrix Oz ROTATION preset instance constructed'.PHP_EOL);
			}
			else
				printf('Matrix %s preset instance constructed'.PHP_EOL, $this->const_array[$this->_args['preset']]);
		}
		return ;
	}

	function __destruct() {
		if (self::$verbose)
		{
			print('Matrix instance destructed'.PHP_EOL);
		}
		return ;
	}

	public function mult($matrix) {
		
		$matrice = $matrix->getMatx();
		$new = $matrice;
		$new['vtcX']['x'] = $this->_matrice['vtcX']['x'] * $new['vtcX']['x'];
		$new['vtcY']['x'] = $this->_matrice['vtcY']['y'] * $new['vtcY']['y'];
		$new['vtcZ']['x'] = $this->_matrice['vtcZ']['z'] * $new['vtcZ']['z'];
		$new['vtxO']['x'] = $this->_matrice['vtxO']['w'] * $new['vtxO']['w'];
		$new['vtcX']['y'] = $this->_matrice['vtcX']['x'] * $new['vtcX']['x'];
		$new['vtcY']['y'] = $this->_matrice['vtcY']['y'] * $new['vtcY']['y'];
		$new['vtcZ']['y'] = $this->_matrice['vtcZ']['z'] * $new['vtcZ']['z'];
		$new['vtxO']['y'] = $this->_matrice['vtxO']['w'] * $new['vtxO']['w'];
		$new['vtcX']['z'] = $this->_matrice['vtcX']['x'] * $new['vtcX']['x'];
		$new['vtcY']['z'] = $this->_matrice['vtcY']['y'] * $new['vtcY']['y'];
		$new['vtcZ']['z'] = $this->_matrice['vtcZ']['z'] * $new['vtcZ']['z'];
		$new['vtxO']['z'] = $this->_matrice['vtxO']['w'] * $new['vtxO']['w'];
		$new['vtcX']['w'] = $this->_matrice['vtcX']['x'] * $new['vtcX']['x'];
		$new['vtcY']['w'] = $this->_matrice['vtcY']['y'] * $new['vtcY']['y'];
		$new['vtcZ']['w'] = $this->_matrice['vtcZ']['z'] * $new['vtcZ']['z'];
		$new['vtxO']['w'] = $this->_matrice['vtxO']['w'] * $new['vtxO']['w'];
		$new_mat = new Matrix( array( 'preset' => Matrix::IDENTITY ));
		$new_mat->setMatx($new);
		return $new_mat;
	}

	private function goodkawrgs($kwargs) {
		if (!array_key_exists('preset', $kwargs))
			return false;
		if ($kwargs['preset'] < 1 || $kwargs['preset'] > 7)
			return false ;
		if ($kwargs['preset'] == SCALE && (!(array_key_exists('scale', $kwargs))))
			return false ;
		if (($kwargs['preset'] > 2 && $kwargs['preset'] < 6) && (!(array_key_exists('angle', $kwargs))))
			return false ;
		if ($kwargs['preset'] == TRANSLATION && (!(array_key_exists('vtc', $kwargs))))
			return false ;
		if ($kwargs['preset'] == PROJECTION && (!(array_key_exists('fov', $kwargs))))
			return false ;
		if ($kwargs['preset'] == PROJECTION && (!(array_key_exists('ratio', $kwargs))))
			return false ;
		if ($kwargs['preset'] == PROJECTION && (!(array_key_exists('near', $kwargs))))
			return false ;
		if ($kwargs['preset'] == PROJECTION && (!(array_key_exists('far', $kwargs))))
			return false ;		
		return true;
	}

	private function transform_matrix($args) {
		if ($args['preset'] == self::IDENTITY)
			return ;
		if ($args['preset'] == self::TRANSLATION)
			self::translation();
		if ($args['preset'] == self::SCALE)
			self::scale();
		if ($args['preset'] == self::RX)
			self::rotationX();
		if ($args['preset'] == self::RY)
			self::rotationY();
		if ($args['preset'] == self::RZ)
			self::rotationZ();
		if ($args['preset'] == self::PROJECTION)
			self::projection();
		return ;
	}

	private function translation() {
		$this->_matrice['vtxO']['x'] += $this->_args['vtc']->getX();
		$this->_matrice['vtxO']['y'] += $this->_args['vtc']->getY();
		$this->_matrice['vtxO']['z'] += $this->_args['vtc']->getZ();
		return ;
	}

	private function scale() {
		$this->_matrice['vtcX']['x'] *= $this->_args['scale'];
		$this->_matrice['vtcY']['y'] *= $this->_args['scale'];
		$this->_matrice['vtcZ']['z'] *= $this->_args['scale'];
		return ;
	}

	private function rotationX (){
		$this->_matrice['vtcY']['y'] = cos($this->_args['angle']);
		$this->_matrice['vtcZ']['y'] = sin($this->_args['angle']) * -1;
		$this->_matrice['vtcY']['z'] = sin($this->_args['angle']);
		$this->_matrice['vtcZ']['z'] = cos($this->_args['angle']);
	}

	private function rotationY (){
		$this->_matrice['vtcX']['x'] = cos($this->_args['angle']);
		$this->_matrice['vtcX']['z'] = sin($this->_args['angle']) * -1;
		$this->_matrice['vtcZ']['x'] = sin($this->_args['angle']);
		$this->_matrice['vtcZ']['z'] = cos($this->_args['angle']);
	}

	private function rotationZ (){
		$this->_matrice['vtcX']['x'] = cos($this->_args['angle']);
		$this->_matrice['vtcY']['x'] = sin($this->_args['angle']) * -1;
		$this->_matrice['vtcX']['y'] = sin($this->_args['angle']);
		$this->_matrice['vtcY']['y'] = cos($this->_args['angle']);
	}

	private function projection (){
		$far = $this->_args['far'];
		$near = $this->_args['near'];
		$e = 1 / tan($this->_args['fov'] / 2 * M_PI/180);
		$a = $this->_args['ratio'];

		$this->_matrice['vtcX']['x'] = $e / $a;
		$this->_matrice['vtcY']['y'] = $e;
		$this->_matrice['vtcZ']['z'] = -1 * ($far + $near)/($far - $near);
		$this->_matrice['vtxO']['z'] = -(2 * $far * $near)/($far - $near);
		$this->_matrice['vtcZ']['w'] = -1;
	}
}

?>