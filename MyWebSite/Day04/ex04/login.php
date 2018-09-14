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


if (!(my_isset($_POST, 'login') && my_isset($_POST, 'passwd')))
	return (echo "ERROR\n");
else
{
	if (!(auth($_POST['login'], $_POST['passwd'])))
	{
		$_SESSION['loggued_on_user']= '';
		return echo "ERROR\n";
	}
	else
	{	
		$_SESSION['loggued_on_user'] = $_POST['login'];}}?>
		<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
		<?php
	}
}

?>

