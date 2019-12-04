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
if($mod) {
$idnumber=$_GET['id'];
if(ctype_digit($idnumber)) {
mysql_query("DELETE FROM comments WHERE time='$idnumber'");
$message="The comment was deleted successfully.";
}
else {
$message="The ID number doesn't appear to be a valid number.";
}
}
else {
$message="You must be logged an administrator to delete a comment.";
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