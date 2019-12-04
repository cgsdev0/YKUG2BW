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
$message="";
$getallrows = mysql_query("SELECT * FROM approved");
while($cur_row = mysql_fetch_array($getallrows)) {
$cur_id = $cur_row['id'];
$getgood = mysql_query("SELECT * FROM rate_good WHERE id='$cur_id'");
$getbad = mysql_query("SELECT * FROM rate_bad WHERE id='$cur_id'");
$totalgood[$cur_id] = mysql_num_rows($getgood);
$totalbad[$cur_id] = mysql_num_rows($getbad);
$message.=$totalgood[$cur_id];
$message.="      ";
$message.=$totalbad[$cur_id];
$message.="      ";
mysql_query("UPDATE approved SET good=ABS($totalgood[$cur_id]), bad=ABS($totalbad[$cur_id]) WHERE id=$cur_id");
}
$message.="I hope you're Shane...";
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