<?php
    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');
    function aff_tab($bdd)
    {
        if((isset($_GET['type'])) && (!isset($_GET['action'])))
        {
            switch($_GET['type'])
            {
                case 'products':
                    $resultat = mysqli_query($bdd, 'SELECT * FROM products');
                    echo "<table><tr><th>nom</th><th>qqt</th><th>prix</th><th>cat</th><th>desription</th><th>photo</th><td colspan=\"3\"></td></tr>";
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        echo "<tr><td>".$donnees['nom']."</td><td>".$donnees['qqt']."</td><td>".$donnees['prix']."</td><td>".$donnees['cat']."</td><td>".$donnees['descrip']."</td><td>".$donnees['photo']."</td>";
                        echo "<td><a href=\"./Admin.php?type=products&action=suppr&id=".$donnees['productsid']."\"><i class=\"fas fa-trash-alt\"></i></a></td>";
                        echo "<td><a href=\"./Admin.php?type=products&action=modif&id=".$donnees['productsid']."\"><i class=\"fas fa-pencil-alt\"></i></a></td>";
                        echo "<td><a href=\"./Admin.php?type=products&action=add&id=".$donnees['productsid']."\"><i class=\"fas fa-plus\"></i></a></td></tr>";
                    }
                    echo "</table>";
                    break;
                case 'cat':
                    $resultat = mysqli_query($bdd, 'SELECT * FROM cat');
                    echo'<table><tr><th>nom</th></tr>';
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        echo "<tr><td>".$donnees['nom']."</td>";
                        echo "<td><a href=\"./Admin.php?type=cat&action=suppr&id=".$donnees['catid']."\"><i class=\"fas fa-trash-alt\"></i></a></td>";
                        echo "<td><a href=\"./Admin.php?type=cat&action=modif&id=".$donnees['catid']."\"><i class=\"fas fa-pencil-alt\"></i></a></td>";
                        echo "<td><a href=\"./Admin.php?type=cat&action=add&id=".$donnees['catid']."\"><i class=\"fas fa-plus\"></i></a></td></tr>";
                    }
                    echo "</table>";
                    break;

                case 'users':
                    $resultat = mysqli_query($bdd, 'SELECT * FROM users');
                    echo'<table><tr><th>nom</th><th>prenom</th><th>mail</th><th>tel</th><th>admin</th></tr>';
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        echo "<tr><td>".$donnees['nom']."</td><td>".$donnees['prenom']."</td><td>".$donnees['mail']."</td><td>".$donnees['tel']."</td><td>".$donnees['admin']."</td>";
                        echo "<td><a href=\"./Admin.php?type=users&action=suppr&id=".$donnees['usersid']."\"><i class=\"fas fa-trash-alt\"></i></a></td>";
                        echo "<td><a href=\"./Admin.php?type=users&action=modif&id=".$donnees['usersid']."\"><i class=\"fas fa-pencil-alt\"></i></a></td>";
                        echo "<td><a href=\"./Admin.php?type=users&action=add&id=".$donnees['usersid']."\"><i class=\"fas fa-plus\"></i></a></td></tr>";
                    }
                    echo "</table>";
                    break;

                case 'orders':
                    $resultat = mysqli_query($bdd, 'SELECT * FROM orders');
                    echo'<table><tr><th>usersid</th><th>prodlist</th></tr>';
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        echo "<tr><td>".$donnees['ordersid']."</td><td>";
                        $tab = unserialize($donnees['prodlist']);
                        foreach($tab as $key=>$value)
                        {
                            echo $key."  => ".$value[0];
                        }
                        echo "</td></tr>";
                    }
                    echo "</table>";
                    break;

                default :
                    echo 'Vous vous etes perdu ?' ;
                    break;
            }
        }
        if((isset($_GET['type'])) && (isset($_GET['action'])))
        {
            switch($_GET['action'])
            {
                case 'suppr':
                    include ("./suppr.php");
                    break;
                case 'modif':
                    include ("./modif.php");
                    break;
                case 'add':
                    include ("./add.php");
                    break;
            }
        }

    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Ski_dream Admin page</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <nav>
        <ul>
            <li ><a href="../index.php" title="home"><img class="logo" src="../img/logo.png"></a></li>
            <li class="actadmin"><a href="./Admin.php?type=products">articles</a>
            <li class="actadmin"><a href="./Admin.php?type=cat">catégories</a>
            <li class="actadmin"><a href="./Admin.php?type=users">utilisateurs</a>
            <li class="actadmin"><a href="./Admin.php?type=orders">commandes</a>
            <li class="actuser"><a href="../AFF/aff_logout.php"><i class="fas fa-shopping-cart"> se deconnecter</i></a></li>
            <li class="actuser"><a href="../index.php?account=modify"><i class="fas fa-user"></i>Mon compte</a></li>
        </ul>
    </nav>
    <body>
        <div class="phrase">
            <h2>Bienvenu, Admin</h2>
        </div>
        <center><div class="divblanche"><?php aff_tab($bdd)?></div></center>
    </body>
    <hr/>
    <footer id="pied_de_page">
        <p>Copyright moi, tous droits réservés</p>
    </footer>
</html>