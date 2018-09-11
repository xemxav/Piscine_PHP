#!/usr/bin/php
<?php

function ft_is_sort($array)
{
	$copy = array();
	$copy=array_merge($copy, $array);
	sort($copy);
	$i = 0;
	foreach($array as $v)
	{	
		if ($v != $copy[$i])
			return FALSE;
		$i++;
	}
	return TRUE;
}