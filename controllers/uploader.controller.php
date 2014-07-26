<?php

@require_once("mysql.php");

$error_code = 516;
// 999 - File size greater
// 719 - Invalid filetype
// 0 - file succesfull uploaded
// 904 - moving file failed;
// 871 - invalid image props
// 444 - empty file


$max_image_width	= 6000;
$max_image_height	= 6000;
$max_image_size		= 6000*6000;
$valid_types 		=  array("gif","jpg", "png", "jpeg");

if (isset($_FILES["userfile"])) {
	if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		$filename = $_FILES['userfile']['tmp_name'];
		$ext = substr($_FILES['userfile']['name'], 
			1 + strrpos($_FILES['userfile']['name'], "."));
		if (filesize($filename) > $max_image_size) {
			$error_code = 999;
		} elseif (!in_array($ext, $valid_types)) {
			$error_code = 719;
		} else {
 			$size = GetImageSize($filename);
 			if (($size) && ($size[0] < $max_image_width) 
				&& ($size[1] < $max_image_height)) {

 				$query = core_mysql_query("SELECT MAX(id_image) FROM `images`;");
 				$query = mysql_fetch_row($query);
				if (@move_uploaded_file($filename, "cache/".md5(intval($query[0])+1).".jpg")) {
					$error_code = 0;
					$time_now = time();
					$query = core_mysql_query("INSERT INTO `images` (`time_uploaded`) VALUES ('$time_now');");
				} else {
					$error_code = 904;
				}
			} else {
				$error_code = 871;
			}
		}
	} else {
		$error_code = 444;
	}
}

?>
<html>
<head>
	<title></title>
</head>
<body>

<form enctype="multipart/form-data" method="post"> 
	Send this file: <input name="userfile" type="file"> 
	<input type="submit" value="Send File"> 
	</form>
</body>
</html>