<?php
    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');

    if((isset($_GET['type'])) && (isset($_GET['id'])))
    {
        $requete = "SELECT * FROM ".$_GET['type']." WHERE ".$_GET['type']."id=\"".$_GET['id']."\"";
        $res = mysqli_query($bdd, $requete);
        $donnees = mysqli_fetch_assoc($res);
        echo "<form method=\"POST\" action=\"./add.php\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$_GET['type']."\" ></br>";
        foreach($donnees as $key=>$value)
        {
            if ($key == $_GET['type']."id")
            {
                //echo $key." = ".$value."</br>";
            }
            else if ($key == "mdp")
            {
                echo $key." <input type=\"password\" name=\"mdp\" value=\"\" required/></br>";
            }
            else
                echo $key." <input type=\"text\" name=\"".$key."\" value=\"".$value."\" required/></br>";
        }
        echo "<input type=\"submit\" name=\"submit\" value=\"Ajouter\" /></form>";
    }
   

    if (isset($_POST['submit']))
    {
        if ($_POST['submit'] == "Ajouter")
        {
            $id = $_POST['type']."id";
            $str = "";

            foreach($_POST as $key=>$value)
            {
                if (!(($key == "type") || ($key == "submit" || ($key == "mdp"))))
                {
                    $str = $str."\"".$value."\", ";
                }
                if ($key == "mdp")
                {
                    $Hmdp = hash("whirlpool",$value);
                    $str = $str."\"".$Hmdp."\", ";
                }
            }
            $str =  substr ($str,0, strlen($str)-2);
            $requete4 = "INSERT INTO ".$_POST['type']." VALUES (\"\",".$str.")";
            echo $requete4;
            $re = mysqli_query($bdd, $requete4);
            header("Location: ./Admin.php?type=".$_POST['type']);
        }
    }
?>