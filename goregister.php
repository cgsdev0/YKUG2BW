<?php
$page="functionpage";
$regerror=0;
include('head2.php');
$uname=quote($_POST['uname']); //
$fname=quote($_POST['fname']); //
$lname=quote($_POST['lname']); //
$email=$_POST['email']; //
$pass1=$_POST['pass']; //
$pass2=$_POST['pass2']; //
$day=$_POST['day']; //
$month=$_POST['month']; //
$year=$_POST['year']; //
$code=$_POST['code']; //
if($code==$_SESSION['security_code']) {

}
else {
$message="The security code you entered does not match the image.";
$regerror=1;
}
if($pass1==$pass2) {

}
else {
$message="The two passwords do not match.";
$regerror=1;
}
if(!check_email_address($email)) {
$message="The e-mail address is not valid.";
$regerror=1;
}
if(!ctype_digit($day)) {
$message="The birthday you entered is invalid.";
$regerror=1;
}
if(!ctype_digit($month)) {
$message="The birthday you entered is invalid.";
$regerror=1;
}
if(!ctype_digit($year)) {
$message="The birthday you entered is invalid.";
$regerror=1;
}
if(!(($day>0) && ($day<32))) {
$message="The birthday you entered is invalid.";
$regerror=1;
}
if(!(($month>0) && ($month<13))) {
$message="The birthday you entered is invalid.";
$regerror=1;
}
if(!(($year>1899) && ($year<2011))) {
$message="The birthday you entered is invalid.";
$regerror=1;
}
if(strlen($fname)>15) {
$message="Your first name can't be more than 15 characters.";
$regerror=1;
}
if(strlen($lname)>15) {
$message="Your last name can't be more than 15 characters.";
$regerror=1;
}
if(strlen($_POST['uname'])>15) {
$message="Your username can't be more than 15 characters.";
$regerror=1;
}
if(strlen($_POST['uname'])<5) {
$message="Your username can't be less than 5 characters.";
$regerror=1;
}
if(strlen($pass1)>15) {
$message="Your password can't be more than 15 characters.";
$regerror=1;
}
if(strlen($pass1)<5) {
$message="Your password can't be less than 5 characters.";
$regerror=1;
}
if(!ctype_alpha($_POST['fname'])) {
$message="Your first name may only contain letters.";
$regerror=1;
}
if(!ctype_alpha($_POST['lname'])) {
$message="Your last name may only contain letters.";
$regerror=1;
}
if(!ctype_alnum(str_replace("_","",$_POST['uname']))) {
$message="Your username can only contain letters, numbers, and underscores.";
$regerror=1;
}
if(!strlen($fname)>0) {
$message="You must enter a first name.";
$regerror=1;
}
if(!strlen($lname)>0) {
$message="You must enter a last name.";
$regerror=1;
}
$allusers = mysql_query("SELECT * FROM users");
$newid = mysql_num_rows($allusers);
while($rowallusers = mysql_fetch_array($allusers)) {
if(strtolower($_POST['uname'])==$rowallusers['uname_low']) {
$message="The username you chose is already taken.";
$regerror=1;
}
}
if($regerror==0) {
$uname_low=strtolower($uname);
$hash = md5($pass1);
$email2 = quote($email);
mysql_query("INSERT INTO users (uid, uname_low, uname, fname, lname, hash, bday, bmonth, byear, email, hash_back) VALUES ($newid, $uname_low, $uname, $fname, $lname, '$hash', '$day', '$month', '$year', $email2, '$hash')");
$message="You have been successfully registered. You may now log in.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="description"/>
<meta name="keywords" content="keywords"/> 
<meta name="author" content="author"/> 
<title>YKUG2BW</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="ie_fixes.css" media="screen" /><![endif]-->
</head>
<body>
<div align="center" style="padding-top: 200px;">
<span class="post2">
<?php
echo($message);
include('foot2.php');
?>