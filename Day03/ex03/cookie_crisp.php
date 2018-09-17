<?php $act = null;
$val= null;
$name= null;
foreach($_GET as $k => $v)
{
	if ($k === 'value')
		$val = $v;
	if ($k === 'action')
		$act = $v;
	if ($k === 'name')
		$name = $v;
}
if ($act == "set" && $val != null && $name != null)
	setcookie($name, $val, time() + 3600*24*31);
else if ($act == "get" && $name != null)
{
	foreach($_COOKIE as $k=>$v)
		if ($k === $name)
			echo $_COOKIE[$name]."\n";
}
else if ($act=== "del" && $name != null)
{	
	foreach($_COOKIE as $k=>$v)
		if ($k === $name)
			setcookie($name, null, 3600*24*31);
}
?>