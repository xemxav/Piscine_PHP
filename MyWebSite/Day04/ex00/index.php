<?php
session_start();
function my_isset($global, $string)
{
	foreach($global as $k => $v)
		if ($k == $string)
			return true;
	return false;
}
if (my_isset($_GET,'login') && my_isset($_GET,'passwd') && my_isset($_GET,'submit'))
{
	
	if ($_GET["submit"]=='OK')
	{	
		$_SESSION['login']= $_GET['login'];
		$_SESSION['passwd']=$_GET['passwd'];
		$_SESSION['submit']=$_GET['submit'];
	}

}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Index</title>
		<style></style>
	</head>
	<body>
		<form method="GET">
			Identifiant: <input type="text" name="login" value="<?php if(my_isset($_SESSION, 'login')){ echo $_SESSION['login'];} ?>"/><br />
			Mot de passe: <input type="password" name="passwd" value="<?php if (my_isset($_SESSION, 'passwd')){ echo $_SESSION['passwd'];}?>" />
			<input type="submit" name="submit" value="OK"/>
		</form> 
	</body>
</html>