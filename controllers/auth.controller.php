<?php 
	
	error_reporting(E_ALL | E_NOTICE);
	require_once("mysql.php");

	$error_code = 0;
	if(isset($_POST['auth']))
	{

		if(isset($_POST['login']) && isset($_POST['password']))
		{
			$login = mysql_real_escape_string($_POST['login']);
			$password = mysql_real_escape_string($_POST['password']);
			$password = md5($password);

			$query = core_mysql_query("SELECT `id_user` FROM `users` WHERE `username`='$login' AND `password`='$password';");
			if($query)
			{
				$query = mysql_fetch_assoc($query);
				if(!$query)
				{
					echo("Auth failed!");
				}else{
					echo("Auth succes!");
				}
			}
		}
	}

 ?>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <form method="post">
<input type="hidden" name="auth" value="true" />
<input type="text" name="login" /><br/>
<input type="password" name="password"/><br/>
<input type="submit" />
 </form>
 </body>
 </html>