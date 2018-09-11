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

function pool_sort($s1, $s2)
{
	$s1=strtolower($s1);
	$s2=strtolower($s2);
	$ref ="abcdefghijklmnopqrstuvwxyz0123456789 !\"\#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	$tab1 =str_split($s1);
	$tab2 =str_split($s2);
	$i = 0;
	while ($tab1[$i] === $tab2[$i] && $tab1[$i] != NULL && $tab2[$i] != NULL)
		$i++;
	$i1 = stripos($ref,$tab1[$i]);
	$i2 = stripos($ref,$tab2[$i]);
	if ($i1 == $i2)
		return (0);
	return ($i1 < $i2) ? -1 : 1;
}
$tab = array_slice($argv, 1);
$tab3=array();
foreach($tab as $elem)
{
	$tab2=ft_epur($elem);
	$tab3=array_merge($tab3,$tab2);
}
usort($tab3,"pool_sort");
foreach($tab3 as $elem)
	echo $elem."\n";