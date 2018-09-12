#!/usr/bin/php
<?php

function moyenne_user($file)
{
	$tab=array();
	$ct = array();
	foreach($file as $line)
	{
		$tmp=explode(";",$line);
		if ((is_numeric($tmp[1])))
		{
			$tab[$tmp[0]] += $tmp[1];
			$tab2[$tmp[0]] += 1;
		}
	}
	$moy = array();
	foreach ($tab as $k => $v)
	{
		$moy[$k] = $v/$tab2[$k];
	}
	ksort($moy);
	foreach($moy as $k => $v)
	{
		echo $k.":".$v."\n";
	}
}

function moyenne($file)
{
	$grades = 0;
	$nb = 0;
	foreach($file as $line)
	{
		$tmp=explode(";",$line);
		if ((is_numeric($tmp[1])))
		{	
			$grades += $tmp[1];
			$nb++;
		}
	}
	echo $grades/$nb."\n";
}

function ecart_moulinette($file)
{
	$tab=array();
	$ct = array();
	foreach($file as $line)
	{
		$tmp=explode(";",$line);
		if ((is_numeric($tmp[3])))
		{
			$tab[$tmp[0]] += $tmp[3];
			$tab2[$tmp[0]] += 1;
		}
	}
	$moy = array();
	foreach ($tab as $k => $v)
	{
		$moy[$k] = $v/$tab2[$k];
	}
	ksort($moy);
	foreach($moy as $k => $v)
	{
		echo $k.":".$v."\n";
	}
}

if ($argc != 2)
	exit();
$file = array();
while (fscanf(STDIN, "%s", $line))
{
	$file[]=$line;
	if ((feof(STDIN)) == TRUE)
		break ;
}
$file = array_slice($file, 1);
if ($argv[1] === "moyenne")
	moyenne($file);
if ($argv[1] === "moyenne_user")
	moyenne_user($file);
if ($argv[1] === "ecart_moulinette")
	ecart_moulinette($file);
