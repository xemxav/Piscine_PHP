<html>
<head>
<title>Mes premiers scripts en PHP</title>
</head>
<body style="background:#FFF; font-size: 1.1em">
<?php
/* mon premier script, au menu :
- première chaîne de caractères
- date et heure du jour
*/
echo 'Texte généré par PHP. 1er script'; // chaîne à écrire via PHP
echo '<br />Date du jour = <font color="red"><strong>'.date("d/m/y - H:i:s").'</strong></font>';
?>
</body>
</html>