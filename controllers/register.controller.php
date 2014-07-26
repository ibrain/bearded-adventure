<?php 

	error_reporting(E_ALL | E_NOTICE);
	require_once("mysql.php");
	require_once("invites.controller.php");

	$error_code = 516;
		//error code in register. will be usefull for API in future
		// 0 - successfull registration
	    // 666 - invite is already used
		// 113 - username is already ised
		// 977 - password too short
		// 888 - captcha is needed
		// 516 - something wrong

	if(isset($_POST['register']) && $_POST['register'] == 'true')
	{
		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
		{
			if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['invite']) && !empty($_POST['invite']))
			{
				$invite = mysql_real_escape_string($_POST['invite']);
				$query = core_mysql_query("SELECT `is_used` FROM `invites` WHERE `invite_code`='$invite';");
				$query = mysql_fetch_row($query);
				if($query[0] == '0')
				{
					$username = mysql_real_escape_string($_POST['username']);
					$username = htmlspecialchars($username);
					$password = mysql_real_escape_string($_POST['password']);
					if(strlen($password>8))
					{
						$error_code = 977;
					}else{

						$query = core_mysql_query("SELECT `id_user` FROM `users` WHERE `username`='$username';");
						$query = mysql_fetch_assoc($query);
						if($query)
						{
							$error_code = 113;
						}else{

							$email = mysql_real_escape_string($_POST['email']);
							$email = htmlspecialchars($email);
							$password = md5($password);
							$query = core_mysql_query("INSERT INTO `users` (`username`, `password`, `user_email`) VALUES ('$username', '$password', '$email');");
							if($query)
							{
								$query = core_mysql_query("UPDATE `invites` SET `is_used`=1 WHERE  `invite_code`='$invite' LIMIT 1;");
								if($query)
								{
									$error_code = 0;
								}
							}
							
						}
					}

				}else{
					$error_code = 666;
				}

			}
		}

		die(strval($error_code));

	}

 ?>

 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <form method="post">
<input type="hidden" name="register" value="true" /><br/>
<input type="text" name="username" /><br/>
<input type="text" name="email" /><br/>
<input type="text" name="invite" /><br/>
<input type="password" name="password" /><br/>
<input type="submit" />
 </form>
 </body>
 </html>