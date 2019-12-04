<?php
if(!isset($page)) {
die("<html><head><title>ACCESS DENIED</title></head><body><div align='center'><span style='font-weight:bold; font-family:Arial; color:red; font-size:24pt;'>ACCESS DENIED</span></div></body></html>");
}
session_start();
//removing quotes from inputs
function check_email_address($email) {
// First, we check that there's one @ symbol, and that the lengths are right
if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
return false;
}
// Split it into sections to make life easier
$email_array = explode("@", $email);
$local_array = explode(".", $email_array[0]);
for ($i = 0; $i < sizeof($local_array); $i++) {
if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
return false;
}
}
if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
$domain_array = explode(".", $email_array[1]);
if (sizeof($domain_array) < 2) {
return false; // Not enough parts to domain
}
for ($i = 0; $i < sizeof($domain_array); $i++) {
if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
return false;
}
}
}
return true;
}
function quote($value)
{
   if (get_magic_quotes_gpc()) {
      $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
      $value = "'" . mysql_real_escape_string($value) . "'";
   }

   return $value;
}
//shasch80
//4196152
//schul030_butcher
//*****
$error = 0;
$mysql=mysql_connect("scorchingstrings.com","schul030_butcher","*****");
if(!$mysql)
  {
  $error = 1;
  }
if($error==0) {
mysql_select_db("schul030_butcher",$mysql);
}
?>
