<?php 
function cart_creation()
{
	
	if (!(isset($_SESSION['cart'])))
	{
		$_SESSION['cart'] = array();
		$_SESSION['cart']['price'] = array();
		$_SESSION['cart']['quantity']= array();
		$_SESSION['cart']['id']= array();
		$_SESSION['cart']['prodname']= array();
	}
	return true;
}

function del_from_cart($id)
{

	if (cart_creation())
	{
		$tmp = array();
		$tmp['price'] = array();
		$tmp['quantity']= array();
		$tmp['id']= array();
		$tmp['prodname']= array();

		
		for($i = 0; $i < count($_SESSION['cart']['id']); $i++)
		{
			
			if ($_SESSION['cart']['id'][$i] !== $id)
			{
				
				array_push($tmp['id'],$_SESSION['cart']['id'][$i]);
				array_push($tmp['quantity'],$_SESSION['cart']['quantity'][$i]);
				array_push($tmp['price'],$_SESSION['cart']['price'][$i]);
				array_push($tmp['prodname'],$_SESSION['cart']['prodname'][$i]);
			}
		}
		$_SESSION['cart']= $tmp;
		unset($tmp);
		header('Location: ../index.php?showcart=show');
	}
	else
		echo "Un problème est survenu, pas tapper svp !";
}

function modif_cart($id, $quantity)
{
	if (cart_creation())
	{
		if ($quantity > 0)
		{
			$product_position = array_search($id, $_SESSION['cart']['id']);
			if ($product_position !== false)
			{
				$_SESSION['cart']['quantity'][$product_position] = $quantity;
			}
		}
		else
			del_from_cart($id);
		header('Location: ../index.php?showcart=show');
	}
	else
		echo "Un problème est survenu, pas tapper svp !";
}

function total_amout()
{
	$total = 0;
	for ($i = 0; $i < count($_SESSION['cart']['id']); $i++)
	{
		$total += $_SESSION['cart']['price'][$i] * $_SESSION['cart']['quantity'][$i];
	}
	return ($total);
}

function count_product()
{
	if (isset($_SESSION['cart']))
		return (count($_SESSION['cart']['id']));
	else
		return 0;
}

function reset_cart()
{
	unset($_SESSION['cart']);
}

function make_prod_list()
{
	if (!(isset($_SESSION['cart'])))
		return false;
	$prodlist = serialize($_SESSION['cart']);
	return $prodlist;
}

function make_order()
{
	$server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
	
	$bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');
	
	$requete = "SELECT usersid FROM users WHERE mail=\"".$_SESSION['user']."\"";
	$resultat = mysqli_query($bdd, $requete);
	$donnees = mysqli_fetch_assoc($resultat);
	$userid = $donnees['usersid'];
	$prodlist = make_prod_list();
	if ($prodlist)
	{
		$sql = "INSERT INTO orders(userid, prodlist) VALUES ('$userid', '$prodlist')";
		if (!mysqli_query($bdd, $sql))
			echo "Erreur lors de l'enregistrement de votre commande".mysqli_error($bdd);
		reset_cart();
		header("Location: ../index.php?merci=merci");
	}
	else
		echo "Erreur lors de l'enregistrement de votre commande";
}

//print_r($_SESSION);
$error = false;
$action =(isset($_GET['cart-action'])) ? $_GET['cart-action']:null;
// echo $action;
// exit;
if ($action !== null)
{
	session_start();
	if (!(in_array($action, array('Ajouter au Panier','Supprimer', 'Actualiser',"Valider votre commande"))))
		$error = true;
	
	$id = (isset($_GET['id_produit'])? $_GET['id_produit']:null ) ;
	$price = (isset($_GET['price'])? $_GET['price']:null ) ;
	$qty = (isset($_GET['quantity'])? $_GET['quantity']:null ) ;
	$name = (isset($_GET['prodname'])? $_GET['prodname']:null ) ;
	$prodcategory = (isset($_GET['prodcategory'])? $_GET['prodcategory']:null ) ;

	if (is_array($qty))
	{
		$QteArticle = array();
	      $i=0;
		  foreach ($qty as $contenu)
		  {
	         $QteArticle[$i++] = intval($contenu);
	      }
	}
	else
		$qty = intval($qty);
}

if (!$error)
{
	switch($action)
	{
		Case "Supprimer" :
			del_from_cart($id);
			break;
		Case "Valider votre commande" :
			make_order();
		Case "Valider votre commande" :
			make_order();
		Default :
			break;
	}
}
?>
	<div class="cart">
		<form method="GET" action="./AFF/aff_cart.php">
				<?php
				if (cart_creation())
				{
					$nb_product = count_product();
					if ($nb_product <= 0)
					{	
						echo "Votre Panier est trop vide";
					}
					else
					{
						echo "<table>";
						echo "<tr>";
						echo "<td>Produits</td>";
						echo "<td>Prix</td>";
						echo "<td>Quantité</td>";
						echo "<td>Supprimer</td>";
						echo "</tr>";
						for($i=0; $i < $nb_product ; $i++)
						{
							echo "<tr>";
							echo "<td>".htmlspecialchars($_SESSION['cart']['prodname'][$i])."</td>";
							echo "<td>".htmlspecialchars($_SESSION['cart']['price'][$i])."</td>";
							echo "<td><input type=\"number\" name=\"quantity\" min=\"0\" max=\"100\"value=\"".htmlspecialchars($_SESSION['cart']['quantity'][$i])."\"/></td>";
							echo "<input type=\"hidden\" name=\"id_produit\" value=\"".$_SESSION['cart']['id'][$i]."\"/>";
							echo "<input type=\"hidden\" name=\"prodname\" value=\"".$_SESSION['cart']['prodname'][$i]."\"/>";
							echo "<input type=\"hidden\" name=\"price\" value=\"".$_SESSION['cart']['price'][$i]."\"/>";
							echo "<td><input type=\"submit\" name=\"cart-action\" value=\"Supprimer\"/>";
							echo "</tr>"; 
							
						}
						echo "<tr><td colspan=\"2\"> </td>";
						echo "<td colspan=\"2\">";
						echo "Total : ".total_amout();
						echo "</td></tr>";
				  
					}
				}
				?>
			</table>
			<?php
			if ($nb_product > 0 && isset($_SESSION['user']))
			{
				if ($_SESSION['user'] != null && $_SESSION['user'] != '')
				{?>
					<form method="post" action="../User_action/cart.php">
					<input type="submit" name="cart-action" value="Valider votre commande">
					</form><?php
				}
				else echo "Vous devez vous connecter pour commander";
			}
			?>
		</form>
	</div>