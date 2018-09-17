<?php
function my_isset($global, $string)
{
	foreach($global as $k => $v)
		if ($k == $string)
			return true;
	return false;
}

function close_function()
{
	header('HTTP/1.0 401 Unauthorized');
	header("Content-type: text/html");
	header("Connexion: close");
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>";
}

if (!my_isset($_SERVER,'PHP_AUTH_USER'))
{
	header('WWW-Authenticate: Basic realm="members_only"');
	header('HTTP/1.0 401 Unauthorized');
	close_function();
}
else
{
	if ($_SERVER['PHP_AUTH_USER'] == 'zaz' && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys")
	{
		header("Content-type: text/html");
		echo "<html><body>\nBonjour Zaz<br />\n<img src='data:image/png;base64,".base64_encode(file_get_contents("../img/42.png"))."'>\n</body></html>";
	}
	else
		close_function();
}
?>