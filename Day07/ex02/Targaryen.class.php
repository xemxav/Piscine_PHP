<?php
Class Targaryen {

	public function getBurned (){

		if (static::resistsFire())
			return "emerges naked but unharmed";
		else
			return "burns alive";
		return ;
	}

	public function resistsFire() {
		return false;
	}
}
?>