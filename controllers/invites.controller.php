<?php 
	//invite controller
	@require_once("mysql.php");
	function utility_string_random($lenght)
	{
		//utility funciton to generate random string
		// TODO : out this in separate file
		$alphabet = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@#$%^&*()_+|[];',.{}:";
		$str = "";
		for($i=0;$i<$lenght;$i++)
		{
			$alph_lenght = strlen($alphabet)-1;
			$index = rand(0,$alph_lenght);
			$str.=$alphabet[$index];
		}
		return $str;
	}


	function core_generate_invites($count)
	{
		//core function to make-up invitations
		//just generating random strings hashes
		//TODO : add unique checking
		for($i =0;$i<$count;$i++)
		{
			$invite = md5(utility_string_random(32));
			core_mysql_query("INSERT INTO `invites` (`invite_code`) VALUES ('$invite');");
		}
	}
 ?>