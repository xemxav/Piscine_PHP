<?php
    function is_logged()
    {
        if (isset($_SESSION['user']))
        {
            if($_SESSION['user'] != "")
                return TRUE;
            else
                return FALSE;
        }
        else
            return false;
    }
?>
<nav>
    <ul>
        <li ><a href="./index.php" title="home"><img class="logo" src="./img/logo.png"></a></li>
        <li class="classic"><a href="./index.php?category=classic">Classic</a>
            <ul class="submenu">
                <li><a href="./index.php?category=debutant">Debutants</a> </li>
                <li><a href="./index.php?category=confirmes">Confirmés</a></li>
                <li><a href="./index.php?category=experts">Experts</a></li>
            </ul>
        </li>
        <li class="race"><a href="./index.php?category=race">Race</a></li>
        <li class="freestyle"><a href="./index.php?category=freestyle">Free-style</a></li>
        <li class="freeride"><a href="./index.php?category=freeride">Free-ride</a></li>
        <li class="allarround"><a href="./index.php?category=allaround">All-arround</a></li>
		<li class="acthome"><a href="./index.php?showcart=show"><i class="fas fa-shopping-cart"> Panier</i></a></li>		
		<?php if (is_logged() == false){?>
        <li class="acthome"><a href="./index.php?account=create"><i class="fas fa-user"></i> Creer un compte</a></li>
		<li class="acthome"><a href="./index.php?account=login"><i class="far fa-user"></i> Se connecter</a></li>
		<?php } else { ?>
		<li class="acthome"><a href="./index.php?account=modify"><i class="fas fa-user"></i> Mon Compte</a></li>
        <li class="acthome"><a href="./index.php?account=logout"><i class="far fa-user"></i> Se déconnecter</a></li> <?php } ?>
    </ul>
</nav>