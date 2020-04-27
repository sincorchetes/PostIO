<?php 

$db_server = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "jojjo";

$con=mysql_connect($db_server,$db_user,$db_pass) or die ("Problemas con la conexión");
mysql_select_db($db_name,$con) or die ("Problema al conectar con la DB");

?>