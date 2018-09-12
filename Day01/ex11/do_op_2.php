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

function	clean($tab)
{
	foreach($tab as $v)
	{	
		if (ctype_alpha($v))
			return FALSE;
	}
	return TRUE;
}

function get_op($tab)
{
	$cnt = 0;
	foreach($tab as $v)
	{	
		if ($v == '+' || $v == '-' || $v == '*'|| $v == '/'|| $v == '%')
		{	
			if ($cnt == 0 && $v != '-')
			{	
				$op = $v;
				$cnt += 1;
			}
		}
	}
	if ($cnt == 1)
		return $op;
	return NULL;
}

if ($argc != 2)
	exit("Incorrect Parameters\n");
$tab = ft_epur($argv[1]);
$string = implode("", $tab);
$tab =str_split($string);
if (!(clean($tab)))
	exit("Syntax Error");
$op = get_op($tab);
if ($op == NULL)
	exit("Syntax Error");
unset($tab);
$tab = explode($op, $string);
if ($op == '+')
	echo $tab[0] + $tab[1]."\n";
if ($op == '-')
	echo $tab[0] - $tab[1]."\n";
if ($op == '*')
	echo $tab[0] * $tab[1]."\n";
if ($op == '/')
{	
	if ($tab[1] == 0)
		exit("Incorrect Parameters\n");
	else
		echo $tab[0] / $tab[1]."\n";
}
if ($op == '%')
	echo $tab[0] % $tab[1]."\n";
