<?php
function auth($login, $passwd)
{
	$db = unserialize(file_get_contents('../private/passwd'));
	foreach($db as $k => $v)
	{
		if ($v['login'] === $login && $v['passwd'] === hash("whirlpool",$passwd))
			return (TRUE);
	}
	return FALSE;
}
?>