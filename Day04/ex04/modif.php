<?php

function my_isset($global, $string)
{
	foreach($global as $k => $v)
		if ($k == $string)
			return true;
	return false;
}

if (my_isset($_POST,'login') && my_isset($_POST,'oldpw') && my_isset($_POST,'newpw') && my_isset($_POST,'submit'))
{
	if ($_POST['submit'] == 'OK')
	{
		$db = unserialize(file_get_contents('../private/passwd'));
		if ($db)
		{
			$changed = 0;
			foreach($db as $k => $v)
			{
				if ($v['login'] === $_POST['login'] && $v['passwd'] === hash("whirlpool",$_POST['oldpw']))
				{
					$db[$k]['passwd'] = hash("whirlpool",$_POST['newpw']);
					
					$changed = 1;
				}
			}
			if ($changed == 1)
			{
				file_put_contents('../private/passwd', serialize($db));
				echo "OK\n";
				header('Location: index.html?modif=OK');
			}
			else
				echo "ERROR\n";
		}
		else
			echo "ERROR\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";

?>