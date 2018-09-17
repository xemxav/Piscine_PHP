<?php
    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');

    if((isset($_GET['type'])) &&($_GET['id']))
    {
        echo ("<form method=\"POST\" action=\"./suppr.php\">
            Etes vous sur ?<br>
            <input type=\"hidden\" name=\"type\" value=\"".$_GET['type']."\" ></br>
            <input type=\"hidden\" name=\"id\" value=\"".$_GET['id']."\" ></br>
            <input type=\"radio\" name=\"nouo\" value=\"oui\"> oui<br>
            <input type=\"radio\" name=\"nouo\" value=\"non\"> non<br>");
        echo "<input type=\"submit\" name=\"submit\" value=\"valider\" /></form>";
    }
    

    if (isset($_POST['submit']))
    {
        if ($_POST['submit'] == "valider")
        {
            if($_POST['nouo'] == "oui")
            {
                $id = $_POST['type']."id";
                $requete3 = "DELETE FROM ".$_POST['type']." WHERE ".$id."=\"".$_POST['id']."\"";
                echo $requete3;
                $re = mysqli_query($bdd, $requete3);
                header("Location: ./Admin.php?type=".$_POST['type']);
            }
            else
                header("Location: ./Admin.php?type=".$_POST['type']);
        }
    }
?>

