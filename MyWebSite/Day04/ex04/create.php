<?php
function err()
{
	echo "ERROR\n";
}

function succes()
{
	echo "OK\n";
	header('Location: index.html?create=OK');
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
		err();
}

function get_db()
{
	if(!(file_exists('../private/passwd')))
		return null;
	$db = file_get_contents('../private/passwd');
	return (unserialize($db));
}

function create_user($db, $user, $passwd)
{
	if ($db != null)
	{
		foreach($db as $entry)
		{
			if ($entry['login'] == $user)
					return err();
		}
	}
	$new_entry['login'] = $user;
	$new_entry['passwd'] = $passwd;
	if ($db == null)
		$db = array($new_entry);
	else
		$db[]=$new_entry;
	file_put_contents('../private/passwd', serialize($db));
	succes();	
}

if (my_isset($_POST,'login') && my_isset($_POST,'passwd') && my_isset($_POST,'submit'))
{
	if ($_POST['submit'] == 'OK')
	{
		if(!(file_exists('../private/')))
			create_db();
		$user = $_POST['login'];
		$passwd = hash("whirlpool",$_POST['passwd']);
		$db = get_db();
		create_user($db, $user, $passwd);
	}
	else
		err();
}
else
	err();
?>