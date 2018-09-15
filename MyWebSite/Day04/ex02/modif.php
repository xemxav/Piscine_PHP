<?php
if (isset($_POST['login']) && isset($_POST['oldpw']) && isset($_POST['newpw']) && isset($_POST['submit']))
{
	if ($_POST['submit'] == 'OK' && $_POST['newpw'] != '' && $_POST['oldpw'] != '')
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