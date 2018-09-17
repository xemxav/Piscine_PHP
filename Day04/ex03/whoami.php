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
	if ($_SESSION['loggued_on_user'] !== '')
		echo $_SESSION['loggued_on_user']."\n";
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>