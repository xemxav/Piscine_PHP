#!/usr/bin/php
<?php

if ($argc != 4)
	exit("Incorrect Parameters\n");
$tab = array_slice($argv,1);
if (strcmp(trim($tab[1]),'+') == 0)
	echo $tab[0] + $tab[2]."\n";
if (strcmp(trim($tab[1]),'-') == 0)
	echo $tab[0] - $tab[2]."\n";
if (strcmp(trim($tab[1]),'*') == 0)
	echo $tab[0] * $tab[2]."\n";
if (strcmp(trim($tab[1]),'/') == 0)
	echo $tab[0] / $tab[2]."\n";
if (strcmp(trim($tab[1]),'%') == 0)
	echo $tab[0] % $tab[2]."\n";