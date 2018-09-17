<?php
session_start();
function auth($login, $passwd)
{
	$server_name = 'mysql';
	$user_name = 'root';
	$password = 'rootpass';
	$bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');
	$resultat = mysqli_query($bdd, 'SELECT mail, mdp, `admin` FROM users');
	$passwdhash = hash("whirlpool",$passwd);
	while($donnees = mysqli_fetch_assoc($resultat))
    {
		if ($donnees['mail'] == $login)
		{
			if ($donnees['mdp'] === $passwdhash)
			{
				return(TRUE);
			}
			else
			{
				return (FALSE);
			}
			
		}
	}
	return (FALSE);
}

$server_name = 'mysql';
$user_name = 'root';
$password = 'rootpass';
$bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');
$resultat = mysqli_query($bdd, 'SELECT mail, mdp, `admin` FROM users');
$donnees = mysqli_fetch_assoc($resultat);
if (isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'])
{
	if ($_POST['submit'] == 'OK')
	{
		print_r($_POST);
		if (auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION['user'] = $_POST['login'];
			header('Location: ../index.php');
			exit;
		}
		else
		{
			header('Location: ../index.php?account=loginwrong');
		}
			
	}
}
else
	echo "Error";
exit;
?>