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
if ($argc < 2)
	exit();
$tab = ft_epur($argv[1]);
$string = implode(" ", $tab);
echo $string."\n";