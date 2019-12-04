<?php
$page="functionpage";
include('head2.php');
$mod=false;
$loggedin=false;
if(isset($_SESSION['userid'])) {
$userid=quote($_SESSION['userid']);
$query4 = mysql_query("SELECT * from users where uid=$userid");
while($row4=mysql_fetch_array($query4)) {
$loggedin=true;
mysql_query("DELETE FROM activity WHERE uid=$userid");
$userid=$row4['uid'];
$username=$row4['uname'];
$activetime=time()+600;
mysql_query("DELETE FROM activity WHERE uid=$userid");
mysql_query("INSERT INTO activity (uid, time) VALUES ($userid, $activetime)");
$query5 = mysql_query("SELECT * from mods where uid=$userid");
while($row5=mysql_fetch_array($query5)) {
$mod=true;
}
}
}
if($loggedin) {
if(!ctype_digit($_GET['id'])) {
$message="The post ID number is invalid.";
}
else {
$id=$_GET['id'];
$checkgood = mysql_query("SELECT * FROM rate_good WHERE id='$id' AND uid='$userid'");
$checkbad = mysql_query("SELECT * FROM rate_bad WHERE id='$id' AND uid='$userid'");
if((mysql_num_rows($checkgood)==0) && (mysql_num_rows($checkbad)==0)) {
if($_GET['good']==1) {
mysql_query("INSERT INTO rate_good (uid, id) VALUES ('$userid', $id)");
$getoldgood=mysql_query("SELECT * FROM rate_good WHERE id='$id'");
$oldgood=mysql_num_rows($getoldgood);
mysql_query("UPDATE approved SET good=$oldgood WHERE id='$id'");
}
else {
mysql_query("INSERT INTO rate_bad (uid, id) VALUES ('$userid', $id)");
$getoldbad=mysql_query("SELECT * FROM rate_bad WHERE id='$id'");
$oldbad=mysql_num_rows($getoldbad);
mysql_query("UPDATE approved SET bad=$oldbad WHERE id='$id'");
}

$message="Your rating has been submitted.";
}
else {
$message="You have already rated this post!";
}
}
}
else {
$message="You must be logged in to rate a post.";
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