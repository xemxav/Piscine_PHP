#!/usr/bin/php
<?php

if ($argc < 2)
	exit();
$string = $argv[1];
$string = preg_replace('/^[ \t]{1,}|[ \t]{1,}$/',"", $string);
$string = preg_replace('/[ \t]{2,}/'," ", $string);
echo "$string\n";