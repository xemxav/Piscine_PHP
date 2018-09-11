#!/usr/bin/php
<?php
function ft_epur($string)
{
	$exploded = explode(" ", $string);
	$it = 0;
	foreach($exploded as $value)
	{
		if (!(empty($value)))
		{
			$tab[$it] = $value;
			$it++;
		}
	}
	return $tab;
}
if ($argc > 1)
{
	$tab = ft_epur($argv[1]);
	$tab2 = array_slice($tab, 1);
	foreach($tab2 as $v)
		echo "$v"." ";
	echo "$tab[0]"."\n";
}
