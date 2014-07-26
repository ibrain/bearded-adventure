<?php 

	error_reporting(E_ALL | E_NOTICE);
	require_once("mysql.php");
	if(isset($_POST['register']) && $_POST['register'] == 'true')
	{
		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
		{
			if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['invite']) && !empty($_POST['invite']))
			{

			}
		}
	}

 ?>