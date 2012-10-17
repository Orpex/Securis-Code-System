<?php
function ApplyKey($id,$foruser)
{
  mysql_query("update securis_codes set usedby='$foruser',used='1' where id='$id'");
}
function IsKey($key)
{
  $key_data = mysql_query("select id from securis_codes where securis_codes.key='$key' limit 1");
  if(mysql_num_rows($key_data)>0)
    return true;
  else
    return false;
}
function GetKeyIDFromKey($key)
{
  $key_data = mysql_query("select id from securis_codes where securis_codes.key='$key' limit 1");
  while($radek = mysql_fetch_array($key_data)){
    return $radek['id'];
  }
  return 0;
}
function IsUsed($id)
{
  $key_data = mysql_query("select used from securis_codes where id='$id' limit 1");
  while($radek = mysql_fetch_array($key_data)){
    if($radek['used']==1)
      return true;
    else
      return false;
  }
  return true;
}
function GetKeyData($key)
{
  $key_data = mysql_query("select * from securis_codes where securis_codes.key='$key' limit 1");
  while($radek = mysql_fetch_array($key_data)){
    return $radek;
  }
  return "";
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
?>
