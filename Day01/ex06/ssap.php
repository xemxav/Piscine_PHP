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

$tab = array_slice($argv, 1);
$tab3=array();
foreach($tab as $elem)
{
	$tab2=ft_epur($elem);
	$tab3=array_merge($tab3,$tab2);
}
sort($tab3);
foreach($tab3 as $elem)
	echo $elem."\n";