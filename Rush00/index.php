<?php
	session_start();
    include_once("install.php");
    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $co = mysqli_connect($server_name, $user_name, $password);
    if(!(mysqli_select_db($co, 'Skishop')))
    {
        $bdd = install_db();
    }
    $bdd = mysqli_connect($server_name, $user_name, $password,'Skishop', '3306');

function getdiv()
{
		if (isset($_GET['category']))
            include ("./AFF/aff_product.php");
		else if(isset($_GET['showcart']))
			include ("./AFF/aff_cart.php");
		else if (isset($_GET['account']))
		{	
			if ($_GET['account'] == 'login')
				include ("./AFF/aff_login.php");
			else if ($_GET['account'] == 'loginwrong')
			{
				include ("./AFF/aff_login.php");
				echo "<p style=\"font-size: x-large; font-style: italic; color: #F00;\"> mauvais mot de passe</p>";
			}
			else if ($_GET['account'] == 'create')
				include ("./AFF/aff_create.php");
			else if ($_GET['account'] == 'logout')
				include ("./AFF/aff_logout.php");
			else if ($_GET['account'] == 'modify')
				include ("./AFF/aff_modify.php");
			else
				echo "ERROR\n";
		}
		else
            include ("./AFF/aff_product.php");
}

function our_title()
{
	if(isset($_GET['showcart']))
		echo "Votre Panier";
	else if (isset($_GET['account']))
	{	
			if (($_GET['account'] == 'login') || ($_GET['account'] == 'loginwrong'))
				echo "Connection";
			else if ($_GET['account'] == 'create')
				echo "Creez votre compte";
			else if ($_GET['account'] == 'logout')
				echo "Bye Bye !";
			else if ($_GET['account'] == 'modify')//verifier en fonction du cookie de session
				echo "Gestion de votre compte";
			else
				echo "ERROR\n";
	}
	else if(isset($_GET['category']))
	{
		switch($_GET['category'])
		{
			case 'classic':
				echo 'classic';
				break;
			case 'race':
				echo 'race';
				break;
			case 'freeride':
				echo 'freeride';
				break;

			case 'freestyle':
				echo 'freestyle';
				break;

			case 'allaround':
				echo 'allaround';
				break;
		}
	}
	else if(isset($_GET['merci']))
	{
		echo "Votre commande est validée !! Merci et Bon Ride !";
	}
	else
		echo "Nos derniers produits:";
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Ski_dream</title>
		<link rel="stylesheet" href="menu.css">
		<link rel="stylesheet" href="aff.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>
        <?php  include("nav.php"); ?>
        <div class="phrase">
            <h2><?php our_title()?></h2>
        </div>
        <center><div class="divblanche"><?php getdiv();?></div></center>
    </body>
    <!--<hr/>
    <footer id="pied_de_page">
        <p>Copyright moi, tous droits réservés</p>
    </footer>-->
</html>