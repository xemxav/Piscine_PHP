#!/usr/bin/php
<?php
echo "Entrez un nombre: ";
while (fscanf(STDIN, "%s", $number))
{
	if (is_numeric($number))
	{
		echo "Le chiffre ";
		if ($number % 2 == 0)
		{	echo "$number"." est Pair\n";}
		else
		{	echo "$number"." est Impair\n";}
	}
	else
	{
		echo "'$number'"." n'est pas un chiffre\n";
	}
	if ((feof(STDIN)) == TRUE)
		break ;
	echo "Entrez un nombre: ";
}
