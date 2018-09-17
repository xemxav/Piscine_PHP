<?php
function auth($login, $passwd)
{
	if ($login == '' || $passwd == '')
		return FALSE;
	$db = unserialize(file_get_contents('../private/passwd'));
	foreach($db as $k => $v)
	{
		if ($v['login'] === $login && $v['passwd'] === hash("whirlpool",$passwd))
			return (TRUE);
	}
	return FALSE;
}
?>