#!/usr/bin/php
<?php


if ($argc < 2)
	exit();
//$handle = fopen($argv[1],"r");
$file = file_get_contents($argv[1]);

$matches=array();

preg_match("/title=\"(.*)\"/", $file, $matches);
print_r($matches);


// $ret = preg_replace_callback("/\".*\"/",function ($matches) {
// 	return strtoupper($matches[0]);
// },$file);


// echo $ret;
// echo'\n\n';
// echo $file;




// <[^>]*title="([^"]*)