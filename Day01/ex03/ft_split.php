#!/usr/bin/php
<?php
function ft_split($string)
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
	sort($tab);
	return $tab;
}
?>