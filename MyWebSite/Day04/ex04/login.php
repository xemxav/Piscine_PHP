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

iframe()
{
	<html>
		<body>
			<iframe id = "mon_iframe" title ="frame" width="550px" src="char.php">
			</iframe>
		</body>
	</html>
}

if (my_isset($_POST, 'login') && my_isset($_POST, 'passwd'))
{
	if (auth($_POST['login'], $_POST['passwd']))
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		iframe();
	}
	else
	{	
		$_SESSION['loggued_on_user']= '';
		echo "ERROR\n";
	}
}
?>