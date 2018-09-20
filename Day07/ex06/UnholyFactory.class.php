<?php

Class UnholyFactory {

	public $inventaire;
	
	function __construct(){
		$this->stock = array('foot soldier' => null, 'archer' => null, 'assassin' => null);
	}

	public function absorb($inst) {
		if ($inst instanceof Fighter)
		{
			if (array_key_exists($inst->type, $this->stock))
			{
				if ($this->stock[$inst->type] == null)
				{	

					printf("(Factory absorbed a fighter of type %s)".PHP_EOL, $inst->type);
					$this->stock[$inst->type] = $inst;
				}
				else
					printf("(Factory already absorbed a fighter of type %s)".PHP_EOL, $inst->type);
			}
			else
			{	
				$this->stock[$inst->type] = $inst;
				printf("(Factory absorbed a fighter of type %s)".PHP_EOL, $inst->type);
			}
		}
		else
			print "(Factory can't absorb this, it's not a fighter)".PHP_EOL;
	}
	
	public function fabricate($order) {

		if (array_key_exists($order, $this->stock))
		{	
			if ($this->stock[$order] instanceof Fighter)
			{	
				printf("(Factory fabricates a fighter of type %s)".PHP_EOL, $order);
				return $this->stock[$order];
			}
			else
				printf("(Factory hasn't absorbed any fighter of type %s)".PHP_EOL, $order);
		}
		else
			printf("(Factory hasn't absorbed any fighter of type %s)".PHP_EOL, $order);

	}
}

?>