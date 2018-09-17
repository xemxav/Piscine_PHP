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
        echo "<form method=\"POST\" action=\"./modif.php\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"".$_GET['type']."\" ></br>";
        echo "<input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\" ></br>";
        foreach($donnees as $key=>$value)
        {
            if ($key == $_GET['type']."id")
            {
                echo $key." = ".$value."</br>";
            }
            else if ($key == "mdp")
            {
                echo $key." = PRIVE </br>";
            }
            else
                echo $key." <input type=\"text\" name=\"".$key."\" value=\"".$value."\" ></br>";
        }
        echo "<input type=\"submit\" name=\"submit\" value=\"Modifier\" /></form>";
    }
   

    if (isset($_POST['submit']))
    {
        if ($_POST['submit'] == "Modifier")
        {
            $id = $_POST['type']."id";
            $str = "";

            foreach($_POST as $key=>$value)
            {
                if (!(($key == "type") || ($key == "submit") || ($key == "id")))
                {
                    $str = $str.$key."=\"".$value."\", ";
                }
            }
            $str =  substr ($str,0, strlen($str)-2);
            
            $requete2 = "UPDATE ".$_POST['type']." SET ".$str." WHERE ".$id."=\"".$_POST['id']."\"";
            $re = mysqli_query($bdd, $requete2);
            //echo $requete2;
            header("Location: ./Admin.php?type=".$_POST['type']);
        }
    }
?>
        