#!/usr/bin/php
<?php







if ($argc < 3)
	exit();
$key = $argv[1];
if ((strpos($key, ":")))
	exit();
$tab=array_slice($argv,2);
$hash = array();
foreach($tab as $v)
{
	$tmp = explode(":", $v);
	$hash[$tmp[0]] = $tmp[1];
}
if (array_key_exists($key,$hash))
	echo $hash[$key]."\n";
exit();
