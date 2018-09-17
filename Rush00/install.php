<?php
    function install_db()
    {
        $server_name = 'mysql';
        $user_name = 'root';
        $password = 'rootpass';

        $co = mysqli_connect($server_name, $user_name, $password);
        if (!$co)
            ("Connection failed : " . mysqli_connect_error());
        $sql = "CREATE DATABASE IF NOT EXISTS Skishop";
        if (!mysqli_query($co, $sql))
            echo "Error creating database : " . mysqli_error($co);
        if($bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306'))
        {
            // Si la connexion a réussi, rien ne se passe.
        }
        else
        {
            echo 'Erreur'.mysqli_error($bdd); // On affiche un message d'erreur.
        }

    
        echo "looooool";
        //session_start();
        create_users_table($bdd);
		add_admin($bdd, 'chapard', 'marie', hash('whirlpool', 'admin'), 'mchapard@student.le-101.fr', '11 passage panama 69002 lyon', '0629556472', true);
		add_admin($bdd, 'moreau', 'xavier', hash('whirlpool', 'admin'), 'reivax29@gmail.com', '11 passage panama 69002 lyon', '0629556472', true);
        create_cat_table($bdd);
        create_products_table($bdd);
        create_orders_table($bdd);
        return ($bdd);
    }
   
    function create_users_table($bdd)
    {
        $sql = "CREATE TABLE IF NOT EXISTS users(usersid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, nom VARCHAR(64) NOT NULL, prenom VARCHAR(64) NOT NULL, mdp VARCHAR(256) NOT NULL,  mail VARCHAR(64) NOT NULL UNIQUE, adr VARCHAR(256) NOT NULL, tel CHAR(10), `admin` BOOLEAN NOT NULL )";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors de la création de la table users".mysqli_error($bdd);
    }

    function create_products_table($bdd)
    {
        $sql = "CREATE TABLE IF NOT EXISTS products(productsid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, nom VARCHAR(64) NOT NULL, qqt INT NOT NULL, prix INT NOT NULL, cat VARCHAR(64) NOT NULL, descrip VARCHAR(512) NOT NULL, photo VARCHAR(512) NOT NULL)";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors de la création de la table products".mysqli_error($bdd);
        create_products($bdd);
    }

    function create_orders_table($bdd)
    {
        $sql = "CREATE TABLE IF NOT EXISTS orders(ordersid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, userid INT NOT NULL, prodlist VARCHAR(1024) NOT NULL)";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors de la création de la table orders".mysqli_error($bdd);
        $sql = "ALTER TABLE orders ADD FOREIGN KEY (userid) REFERENCES users(userid)";
        mysqli_query($bdd, $sql);
    }

    function create_cat_table($bdd)
    {
        $sql = "CREATE TABLE IF NOT EXISTS cat(catid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, nom VARCHAR(64) NOT NULL)";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors de la création de la table users".mysqli_error($bdd);
        create_cat($bdd);
    }


    function add_admin($bdd, $nom, $prenom, $mdp, $mail, $adr, $tel, $admin)
    {
        $sql = "INSERT INTO users(nom, prenom, mdp, mail, adr, tel, `admin`) VALUES ('$nom', '$prenom', '$mdp', '$mail', '$adr', '$tel', '$admin')";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors du remplissage de la table admin".mysqli_error($bdd);
    }

    function add_products($bdd, $nom, $qqt, $prix, $cat, $descrip, $photo)
    {
        $sql = "INSERT INTO products(nom, qqt, prix, cat, descrip, photo) VALUES ('$nom', '$qqt', '$prix', '$cat', '$descrip', '$photo')";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors du remplissage de la table products".mysqli_error($bdd);
    }

    function add_cat($bdd, $nom)
    {
        $sql = "INSERT INTO cat(nom) VALUES ('$nom')";
        if (!mysqli_query($bdd, $sql))
            echo "Erreur lors du remplissage de la table products".mysqli_error($bdd);
    }

    function create_products($bdd)
    {
        add_products($bdd, 'ski 1', '3', '320', 'classic', 'tres beau jadore la piste ca tout ca', './img/ski.jpg');
        add_products($bdd, 'ski 1bis', '3', '299', 'classic', 'tres beau jadore la piste ca tout ca', './img/ski2.jpg');
        add_products($bdd, 'ski 1ter', '3', '352', 'classic', 'tres beau jadore la piste ca tout ca', './img/ski3.jpg');
        add_products($bdd, 'ski mieu', '3', '302', 'classic', 'tres beau jadore la piste ca tout ca', './img/ski4.jpg');
        add_products($bdd, 'ski 2', '5', '425', 'classic', 'tres beau --- jadore la piste ca tout ca', './img/ski5.jpg');

        add_products($bdd, 'ski race', '3', '400', 'race', 'tres beau jadore ski race ca tout ca', './img/ski6.jpg');
        add_products($bdd, 'ski race', '3', '400', 'race', 'tres beau jadore ski race ca tout ca', './img/all4.jpg');
        add_products($bdd, 'ski race', '3', '400', 'race', 'tres beau jadore ski race ca tout ca', './img/ski2.jpg');

        add_products($bdd, 'ski freestyle', '3', '420', 'freestyle', 'tres beau jadore freestyle ca tout ca', './img/freestyle.jpg');
        add_products($bdd, 'ski freestyle2', '8', '473', 'freestyle', 'tres beau jadore freestyle ca tout ca', './img/ski.jpg');
        add_products($bdd, 'ski freestyle2', '8', '473', 'freestyle', 'tres beau jadore freestyle ca tout ca', './img/ski5.jpg');

        add_products($bdd, 'ski 3', '5', '500', 'freeride', 'tres beau --- jadore tout ca freeride', './img/freeride.jpg');
        add_products($bdd, 'ski 3', '1', '523', 'freeride', 'tres beau --- jadore tout ca freeride', '/img/freeride2.jpg');
        add_products($bdd, 'ski 3', '8', '489', 'freeride', 'tres beau --- jadore tout ca freeride', '/img/freeride3.jpg');

        add_products($bdd, 'ski 3', '8', '456', 'allaround', 'tres beau --- jadore tout ca allarround', './img/all.jpg');
        add_products($bdd, 'ski 3', '8', '487', 'allaround', 'tres beau --- jadore tout ca allarround', './img/all2.jpg');
        add_products($bdd, 'ski 3', '8', '519', 'allaround', 'tres beau --- jadore tout ca allarround', './img/all3.jpg');
    }

    function create_cat($bdd)
    {
        add_cat($bdd, "classic");
        add_cat($bdd, "race");
        add_cat($bdd, "freeride");
        add_cat($bdd, "freestyle");
        add_cat($bdd, "allaround");
    }
        
?>