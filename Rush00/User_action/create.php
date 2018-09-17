<?php

    $server_name = 'mysql';
    $user_name = 'root';
    $password = 'rootpass';
    $bdd = mysqli_connect($server_name, $user_name, $password, 'Skishop', '3306');

    if (isset($_POST['submit']))
    {
        if ($_POST['submit'] == "OK")
        {
            $str = "";
            $keys = "";

            foreach($_POST as $key=>$value)
            {
                if (($key != "mdp") && ($key != "submit"))
                {
                    $str = $str."\"".$value."\", ";
                    $keys = $keys.$key.", ";
                }
                if ($key == "mdp")
                {
                    $keys = $keys.$key.", ";
                    $Hmdp = hash("whirlpool",$value);
                    $str = $str."\"".$Hmdp."\", ";
                }
                if ($key == "submit")
                {
                    /*$str = $str."\"0\", ";
                    $keys = $keys."\"admin\", ";*/
                }
            }
            $requete4 = "INSERT INTO users (".$keys." admin) VALUES (".$str." 0)";
            echo $requete4;
            $re = mysqli_query($bdd, $requete4);
            header("Location: ../index.php");
        }
    }
?>