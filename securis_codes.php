<?php
function ConnectToMySQL()
{
  global $securis_codes_connection;
  include("securis_codes_conf.php");
  $securis_codes_connection=mysql_connect($SQL_Server_Adress,$SQL_User,$SQL_Pass);
  mysql_select_db($Database,$securis_codes_connection);
}
function DisconnectFromMySQL()
{
  global $securis_codes_connection;
  mysql_close($securis_codes_connection);
}
function ApplyKey($id,$foruser)
{
  ConnectToMySQL();
  mysql_query("UPDATE securis_codes SET usedby='$foruser',used='1' WHERE id='$id'",$securis_codes_connection);
  DisconnectFromMySQL();
}
function IsKey($key)
{
  ConnectToMySQL();
  $key_data = mysql_query("SELECT id FROM securis_codes WHERE securis_codes.key='$key' LIMIT 1",$securis_codes_connection);
  if(mysql_num_rows($key_data)>0)
  {
    DisconnectFromMySQL();
    return true;
  }
  else
  {
    DisconnectFromMySQL();
    return false;
  }
}
function GetKeyIDFromKey($key)
{
  ConnectToMySQL();
  $key_data = mysql_query("SELECT id FROM securis_codes WHERE securis_codes.key='$key' LIMIT 1",$securis_codes_connection);
  while($line = mysql_fetch_array($key_data)){
    DisconnectFromMySQL();
    return $line['id'];
  }
  DisconnectFromMySQL();
  return 0;
}
function IsUsed($id)
{
  ConnectToMySQL();
  $key_data = mysql_query("SELECT used FROM securis_codes WHERE id='$id' LIMIT 1",$securis_codes_connection);
  while($line = mysql_fetch_array($key_data)){
    DisconnectFromMySQL();
    if($line['used']==1)
      return true;
    else
      return false;
  }
  DisconnectFromMySQL();
  return true;
}
function GetKeyData($key)
{
  ConnectToMySQL();
  $key_data = mysql_query("SELECT * FROM securis_codes WHERE securis_codes.key='$key' LIMIT 1",$securis_codes_connection);
  while($line = mysql_fetch_array($key_data)){
    DisconnectFromMySQL();
    return $line;
  }
  DisconnectFromMySQL();
  return array();
}
function GenerateKey()
{
  $key =strval(rand(1000,9999));
  $key.="-";
  $key.=strval(rand(1000,9999));
  $key.="-";
  $key.=strval(rand(1000,9999));
  if(IsKey($key))
  {
    while (IsKey($key)) {
      $key =strval(rand(1000,9999));
      $key.="-";
      $key.=strval(rand(1000,9999));
      $key.="-";
      $key.=strval(rand(1000,9999));
    }
  }
  return strval($key);
}
function CreateKey($user,$type,$subtype)
{
  ConnectToMySQL();
  $key=GenerateKey();
  mysql_query("INSERT INTO securis_codes VALUES ('','$key','$type','$subtype','$user','','0')",$securis_codes_connection);
  DisconnectFromMySQL();
  return $key;
}
?>
