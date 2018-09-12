#!/usr/bin/php
<?php

if ($argc < 2)
	exit();
setlocale(LC_TImE,"fr_fR");
date_default_timezone_set("Europe/Paris");
$ref_day = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
$ref_month = array("janvier" => 1, "fevrier"=> 2, "mars"=>3, "avril" => 4, "mai"=>5, "juin"=>6, "juillet"=>7, "aout"=>8, "septembre"=>9, "octobre"=>10, "novembre"=>11, "decembre"=>12, "février"=>2, "août"=>8, "décembre"=> 12);
$input = array_slice($argv, 1);
{
	foreach ($input as $str)
	{
		if (preg_match('/^\w{5,7} \d{1,2} \w{3,9} \d{4} [0-5]{1}\d{1}:[0-5]{1}\d{1}:[0-5]{1}\d{1}$/', $str))
		{
			$tab = explode(" ", $str);
			$tab[0] = strtolower($tab[0]);
			$tab[2] = strtolower($tab[2]);
			if (!(array_search($tab[0], $ref_day)))
				exit("Wrong Format\n");
			if (!(array_key_exists($tab[2], $ref_month)))
				exit("Wrong Format\n");
			$d = $tab[2];
			$str = date("$ref_month[$d]/$tab[1]/$tab[3] $tab[4]");
			if (($timestamp = strtotime($str)) == false)
				echo ("Wrong Format\n");
			else
				echo ($timestamp."\n");
		}
		else
			exit("Wrong Format\n");
	}
}
