<?php 
	
	@require_once("config.php");


	function core_mysql_connect()
	{
		$connection = mysql_connect($mysql_host,$mysql_login,$mysql_password);
		return $connection;
	}

	function core_mysql_query($query_string)
	{
		$result = mysql_query($query_string);
	}
	


 ?>
