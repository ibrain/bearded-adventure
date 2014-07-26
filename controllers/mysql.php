<?php 
	
	@require_once("config.php");


	function core_mysql_connect()
	{
		$connection = mysql_connect($mysql_host,$mysql_login,$mysql_password);
		mysql_select_db($mysql_dbname);
		mysql_query("SET names utf8;");
		return $connection;
	}

	function core_mysql_query($query_string)
	{
		$result = mysql_query($query_string);
	}
	


 ?>
