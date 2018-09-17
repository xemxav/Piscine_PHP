<?php
session_start();
function my_isset($global, $string)
{
	foreach($global as $k => $v)
		if ($k == $string)
			return true;
	return false;
}
if (my_isset($_SESSION, 'loggued_on_user'))
{
	$_SESSION['loggued_on_user']= '';
}
?>