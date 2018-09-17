<?php

    function aff_product($resultat)
    {
        $i = 0;
        while($donnees = mysqli_fetch_assoc($resultat))
        {
            echo"<li class=\"lol\">
                <img src=\"".$donnees['photo']."\"/>
                <div class=\"infos\">
                    <p><i class=\"nom\">".$donnees['nom']."</i><i class=\"prix\">".$donnees['prix']."€   "."</i></p>
                    <p>".$donnees['descrip']."</p>
                    <form action=\"./User_action/cart.php\" methode=\"GET\">
                        <input type=\"hidden\" name=\"price\" value= \"".$donnees['prix']."\">
                        <input type=\"hidden\" name=\"id_produit\" value=\"".$donnees['productsid']."\">
                        <input type=\"hidden\" name=\"prodname\" value=\"".$donnees['nom']."\">
                        <input type=\"hidden\" name=\"prodcategory\" value=\"".$donnees['cat']."\">
                        Quantité : <input type=\"number\" name=\"quantity\" min=\"1\" max=\"5\" value=\"1\">
                        <label for=\"panier\"><i class=\"fas fa-cart-plus\"></i></label>
                        <input class=\"fas fa-cart-plus\" id=\"panier\"name=\"cart-action\" type=\"submit\" value=\"Ajouter au Panier\">";
                        /*if (isset($_POST['cart-action']) && isset($_POST['quantity']))
                        {
                            $_POST['cart-action']='Ajouter au Panier';
                            echo $_POST['quantity']." Produit(s) ajouté(s) au panier";
                        }*/
                   echo" </form>
                </div>
            </li>";
            
            $i++;
            if($i == 3)
            {
                echo "</ul><ul>";
                $i=0;
            }
        }
    }

    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');

    echo "<ul>";
    if (!(isset($_GET['category'])))
        $_GET['category'] = "default";
    switch($_GET['category'])
    {
        case 'classic':
            $resultat = mysqli_query($bdd, 'SELECT * FROM products WHERE cat="classic"');
            aff_product($resultat);
            break;
        case 'race':
            $resultat = mysqli_query($bdd, 'SELECT * FROM products WHERE cat="race"');
            aff_product($resultat);
            break;
        case 'freeride':
            $resultat = mysqli_query($bdd, 'SELECT * FROM products WHERE cat="freeride"');
            aff_product($resultat);
            break;

        case 'freestyle':
            $resultat = mysqli_query($bdd, 'SELECT * FROM products WHERE cat="freestyle"');
            aff_product($resultat);
            break;

        case 'allaround':
            $resultat = mysqli_query($bdd, 'SELECT * FROM products WHERE cat="allaround"');
            aff_product($resultat);
            break;

        default :
            $resultat = mysqli_query($bdd, 'SELECT * FROM products ORDER BY prix ASC LIMIT 3');
            aff_product($resultat);
            break;
    }
    echo "</ul>";
?>
        