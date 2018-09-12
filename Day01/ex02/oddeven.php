#!/usr/bin/php
<?php
echo "Entrez un nombre: ";
while (fscanf(STDIN, "%s", $number))
{
	if ((feof(STDIN)) == TRUE)
		break ;
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
	$number = NULL;
	echo "Entrez un nombre: ";
}
