<?php
session_start();
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

function add_to_cart($prodname, $qty, $id, $price)
{
	
	if (cart_creation())
	{
		$product_position = array_search($id, $_SESSION['cart']['id']);
		if ($product_position !== false)
		{
			$_SESSION['cart']['quantity'][$product_position] += $qty;
		}
		else
		{
			array_push($_SESSION['cart']['id'],$id);
			array_push($_SESSION['cart']['quantity'],$qty);
			array_push($_SESSION['cart']['price'],$price);
			array_push($_SESSION['cart']['prodname'],$prodname);
		}
	}
	else
		echo "Un problème est survenu, pas tapper svp !";
}

function count_product()
{
	if (isset($_SESSION['cart']))
		return (count($_SESSION['cart']['id']));
	else
		return 0;
}
$error = false;
$action =(isset($_GET['cart-action'])) ? $_GET['cart-action']:null;
if ($action !== null)
{
	
	if (!(in_array($action, array('Ajouter au Panier','Supprimer', 'Rafraichir',"Valider votre commande"))))
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
		Case "Ajouter au Panier" :
			add_to_cart($name, $qty, $id, $price);
			break;
		Default :
			echo "une erreur est survenue";
			break;
	}

}
header('Location: ../index.php?category='.$prodcategory);

?>
