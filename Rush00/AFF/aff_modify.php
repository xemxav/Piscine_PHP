<?php
function count_order($order)
{
	if (isset($order))
		return (count($order['ordersid']));
	else
		return 0;
}
function show_order($bdd)
{

	$req_uid = mysqli_query($bdd, "SELECT usersid FROM users WHERE mail=\"".$_SESSION['user']."\"");
	$res_uid = mysqli_fetch_assoc($req_uid);
	$uid = $res_uid['usersid'];
	$req_orders = mysqli_query($bdd, "SELECT * FROM orders WHERE userid=\"".$uid."\"");
	if (!($req_orders))
	{
		return "Vous n'avez pas fait de commande";
	}
	$str = "<table style=\"border: solid #FFF;\">"."<tr>"."<td>N com</td><td>Produits</td>"."<td>Prix</td>"."<td>Quantité</td>"."</tr>";

	while ($order = mysqli_fetch_assoc($req_orders))
	{
		$tab = unserialize($order['prodlist']);
		for($i = 0; $i < count($tab['price']); $i++)
		{
			$str .= "<tr><td style=\"border: solid #FFF;\">".$order['ordersid']."</td>"."<td style=\"border: solid #FFF;\">".$tab['prodname'][$i]."</td>"."<td style=\"border: solid #FFF;\">".$tab['price'][$i]."</td>"."<td style=\"border: solid #FFF;\">".$tab['quantity'][$i]."</td>"."</tr>";
		}
	}
	$str = $str."</table";
	return $str;
}
	$server_name = 'mysql';
	$user_name = 'root';
	$password = 'rootpass';
	$bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');
	$resultat = mysqli_query($bdd, "SELECT * FROM users WHERE mail=\"".$_SESSION['user']."\"");
	$donnees = mysqli_fetch_assoc($resultat);
	echo "<div class =\"user_create_form\" style=\"padding-top: 50px;\">
			<form method=\"POST\" action=\"../User_action/modify.php\">
				Votre adresse email : <input type=\"text\" name=\"login\" value=\"".$donnees['mail']."\" required></br>
				Mot de passe : <input type=\"password\" name=\"passwd\" value=\"\"/></br>
				Nouveau Mot de passe : <input type=\"password\" name=\"newpasswd\" value=\"\"/></br>
				</ br></br>
				Mes coordonneées :
				</br></br>Nom : <input type=\"text\" name=\"nom\" value=\"".$donnees['nom']."\" required>
				Prénom :<input type=\"text\" name=\"prenom\" value=\"".$donnees['prenom']."\" required></br>
				Mon adresse : <input type=\"text\" name=\"adresse\" value=\"".$donnees['adr']."\" required></br>
				Mon numéro de téléphone : <input type=\"text\" name=\"telephone\" value=\"".$donnees['tel']."\" required></br></br>
				<input type=\"submit\" name=\"submit\" value=\"Modifier mon compte\" style=\"color: #FFF; background: #0a8c0a;\"/></br>
				<p style=\"padding-top:20px\"><input type=\"submit\" name=\"submit\" value=\"Supprimer mon compte\" style=\"color: #FFF; background: #F00;\"/></p></br>";
				
	if ($donnees['admin'])
		echo"</br><a href=\"../Admin_tools/Admin.php\"><i class=\"far fa-user\"></i>Admin</a>";
	echo "</form> <h2>Mes commandes</h2>".show_order($bdd)."</div>";
	
?>
