<?php
function err($string)
{
	echo "ERROR\n";
	echo $string."\n";
}

function succes()
{
	echo "OK\n";
}

function my_isset($global, $string)
{
	foreach($global as $k => $v)
		if ($k == $string)
			return true;
	return false;
}

function create_db()
{
	if (!(mkdir('../private')))
		err(null);
}

function get_db()
{
	if(!(file_exists('../private/passwd')))
		return null;
	$db = file_get_contents('../private/passwd');
	return (unserialize($db));
}

function modify_user($db, $user,$oldpw,$newpw)
{
	foreach($db as $v => $entry)
	{
		if ($entry['login'] == $user && $entry['passwd'] == $oldpw)
		{
			$key = $v;
			break;
		}
	}
	if ($key == NULL)
		return err("key est null");
	
	$new_entry['login'] = $user;
	$new_entry['passwd'] = $newpw;
	echo $new_entry['login'];
	echo $new_entry['passwd'];
	$db[$key]= array($new_entry);
	file_put_contents('../private/passwd', serialize($db));
	return succes();
}

if (my_isset($_POST,'login') && my_isset($_POST,'oldpw') && my_isset($_POST,'newpw') && my_isset($_POST,'submit'))
{
	if ($_POST['submit'] == 'OK')
	{
		if(!(file_exists('../private/passwd')))
			err(null);
		$user = $_POST['login'];
		$oldpw = hash("whirlpool",$_POST['oldpw']);
		$newpw = hash("whirlpool",$_POST['newpw']);
		$db = get_db();
		if ($db == null)
			return err(null);
		modify_user($db, $user,$oldpw,$newpw);
	}
	else
		return err(null);
}
else
	return err(null);
?>