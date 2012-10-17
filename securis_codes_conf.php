<?php
// Edit this part:
$SQL_Server_Adress = "localhost";
$SQL_User = "root";
$SQL_Pass = "root";
$Database = "";
// Do not edit.
$securis_codes_connection=mysql_connect($SQL_Server_Adress,$SQL_User,$SQL_Pass);
mysql_select_db($Database,$securis_codes_connection);
?>
