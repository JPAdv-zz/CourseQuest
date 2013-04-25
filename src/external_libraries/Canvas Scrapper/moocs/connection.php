<?php
$mysql_hostname = "localhost";
$mysql_user = "sjsucsor_160s2g1";
$mysql_password = "kash!db160";
$mysql_database = "sjsucsor_160s2g12013s";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");

?>