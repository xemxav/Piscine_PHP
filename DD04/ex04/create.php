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

if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']))
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