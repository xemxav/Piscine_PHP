<?php
class Tyrion extends Lannister {

	public function sleepWith($inst){
		if (($inst instanceof Jaime) || ($inst instanceof Cersei))
			print "Not even if I'm drunk !".PHP_EOL;
		else
			print "Let's do this.".PHP_EOL;
	}
}
?>