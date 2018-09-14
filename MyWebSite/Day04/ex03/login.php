<?php
session_start();
include 'auth.php';
function my_isset($global, $string)
{
	foreach($global as $k => $v)
		if ($k == $string)
			return true;
	return false;
}
if (my_isset($_GET, 'login') && my_isset($_GET, 'passwd'))
{
	if (auth($_GET['login'], $_GET['passwd']))
	{
		$_SESSION['loggued_on_user'] = $_GET['login'];
		echo "OK\n";
	}
	else
	{	
		$_SESSION['loggued_on_user']= '';
		echo "ERROR\n";
	}
}
?>