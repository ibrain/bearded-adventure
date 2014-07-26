<?php 

	error_reporting(E_ALL | E_NOTICE);
	require_once("mysql.php");
	require_once("invites.controller.php");

	$error_code = 0;
		//error code in register. will be usefull for API in future
		// 0 - successfull registration
	    // 666 - invite is already used

	if(isset($_POST['register']) && $_POST['register'] == 'true')
	{
		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
		{
			if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['invite']) && !empty($_POST['invite']))
			{
				$invite = $_POST['invite'];
				$query = core_mysql_query("SELECT `is_used` FROM `invites` WHERE `invite_code`='$invite'");
				$query = mysql_fetch_row($query);
				if($query[0] == '0')
				{
					
				}else{
					$error_code = 666;
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
<input type="hidden" name="register" value="true" /><br/>
<input type="text" name="username" /><br/>
<input type="text" name="email" /><br/>
<input type="text" name="invite" /><br/>
<input type="password" name="password" /><br/>
<input type="submit" />
 </form>
 </body>
 </html>