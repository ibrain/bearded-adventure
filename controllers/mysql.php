<?php 
	

	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_dbname = "bearded";

		$connection = mysql_connect($mysql_host,$mysql_username,$mysql_password);
		mysql_select_db($mysql_dbname);
		mysql_query("SET names 'utf8';");


	function core_mysql_query($query_string)
	{
		$result = mysql_query($query_string);
	}
	



 ?>
