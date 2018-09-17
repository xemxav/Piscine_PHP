<?php
    session_start();
    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');

    function auth($login, $passwd, $bdd)
    {
                $passwdhash = hash("whirlpool",$passwd);

        $resultat = mysqli_query($bdd, 'SELECT mail, mdp, `admin` FROM users');
        while($donnees = mysqli_fetch_assoc($resultat))
        {
            if ($donnees['mail'] == $login)
            {
                if ($donnees['mdp'] === $passwdhash)
                {
                    return(TRUE);
                }
                else
                    return (FALSE);
            }
            else
                return (FALSE);
        }
    }

    if (isset($_POST['login']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['telephone']))
    {
        if ($_POST['submit'] == 'Modifier mon compte')
        {
            $requete = "UPDATE users SET mail =\"".$_POST['login']."\", nom = \"".$_POST['nom']."\", prenom = \"".$_POST['prenom']."\", adr = \"".$_POST['adresse']."\", tel = \"".$_POST['telephone']."\" WHERE mail =\"".$_POST['login']."\"";
            $re = mysqli_query($bdd, $requete);
            if ($_POST['passwd'] != "" && $_POST['newpasswd'] != "")
            {
                if (auth($_POST['login'], $_POST['passwd'], $bdd))
                {
                    $newpswd = hash("whirlpool",$_POST['newpasswd']);
                    $requete2 = "UPDATE users SET mdp =\"".$newpswd."\"WHERE mail =\"".$_POST['login']."\"";
                    $res = mysqli_query($bdd, $requete2);
                    header('Location: ../index.php');
                }
                else
                {
                    header('Location: ../AFF/aff_modify.php');
                    echo "Mot de passe invalide";
                }
                    
            }
            else
                header('Location: ../index.php');
        }
        if ($_POST['submit'] == 'Supprimer mon compte')
        {
            $requete5 = "SELECT usersid FROM users WHERE mail=\"".$_POST['login']."\"";
            $resul = mysqli_query($bdd, $requete5);
            $donnees = mysqli_fetch_assoc($resul);
            $id = $donnees['usersid'];
            echo ("<form method=\"POST\" action=\"./modify.php\">
                Etes vous sur ?<br>
                <input type=\"hidden\" name=\"type\" value=\" users\" ></br>
                <input type=\"hidden\" name=\"id\" value=\"".$id."\" ></br>
                <input type=\"radio\" name=\"nouo\" value=\"oui\"> oui<br>
                <input type=\"radio\" name=\"nouo\" value=\"non\"> non<br>");
            echo "<input type=\"submit\" name=\"submit\" value=\"valider\" /></form>";
        }
    }
    else if(isset($_POST['submit']))
    {
        if ($_POST['submit'] == "valider")
        {
            $id = $_POST['type']."id";
            $requete3 = "DELETE FROM ".$_POST['type']." WHERE ".$id."=\"".$_POST['id']."\"";
            echo $requete3;
            $re = mysqli_query($bdd, $requete3);
            $_SESSION["user"] = "";
            header("Location: ../index.php");
        }
    }
    else
        echo "Error";
    exit;
?>