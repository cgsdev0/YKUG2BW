<?php
if(!isset($page)) {
die("<html><head><title>ACCESS DENIED</title></head><body><div align='center'><span style='font-weight:bold; font-family:Arial; color:red; font-size:24pt;'>ACCESS DENIED</span></div></body></html>");
}
session_start();
//removing quotes from inputs
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
@include("email/email.php");
$error = 0;
$mysql=mysql_connect("scorchingstrings.com","schul030_butcher","*****");
if(!$mysql)
  {
  $error = 1;
  }
if($error==0) {
mysql_select_db("schul030_butcher",$mysql);
}
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
$usernamelow=$row4['uname_low'];
$activetime=time()+600;
mysql_query("DELETE FROM activity WHERE uid=$userid");
mysql_query("INSERT INTO activity (uid, time) VALUES ($userid, $activetime)");
$query5 = mysql_query("SELECT * from mods where uid=$userid");
while($row5=mysql_fetch_array($query5)) {
$mod=true;
}
}
}
function multi2dSortAsc(&$arr, $key){
  $sort_col = array();
  foreach ($arr as $sub) $sort_col[] = $sub[$key];
  array_multisort($sort_col, $arr);
}
$getidlistq = mysql_query("SELECT DISTINCT posterid FROM approved");
$getidlisti = 0;
while($getidlistr = mysql_fetch_array($getidlistq)) {
$topposter[$getidlisti]['uid']=$getidlistr['posterid'];
$temptop = $topposter[$getidlisti]['uid'];
$gettopposts = mysql_query("SELECT * FROM approved WHERE posterid=$temptop");
$topposter[$getidlisti]['posts']= 0-(mysql_num_rows($gettopposts));
$getidlisti++;
}
multi2dSortAsc($topposter,'posts');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>YKUG2BW</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="ie_fixes.css" media="screen" /><![endif]-->
<script type="text/javascript">
function pausecomp(millis)
{
var date = new Date();
var curDate = null;

do { curDate = new Date(); }
while(curDate-date < millis);
}
//here you place the ids of every element you want.
<?php
echo('var ids=new Array(');
for($setupi=5; $setupi<sizeof($topposter)-1; $setupi++) {
echo("'rank$setupi', ");
}
echo("'rank$setupi'");
echo(');  ');
?>
function showmoreranks() {
var link = document.getElementById('ranklink');
if(link.innerHTML == "(Show More)") {
<?php
for($setupi2=0; $setupi2<sizeof($topposter); $setupi2++) {
$tempsetupi = 3*(0.5*(pow(sizeof($topposter)-$setupi2,2)));
echo("setTimeout('showrank($setupi2);',".$tempsetupi."); ");
}
?>
link.innerHTML = "(Show Less)";
}
else {
for(var ii=0;ii<ids.length;ii++) {
hiderank(ii);
}
link.innerHTML = "(Show More)";
}

}
function showrank(id) {
var row = document.getElementById(ids[id]); row.style.display = '';
}
function hiderank(id) {
var row = document.getElementById(ids[id]); row.style.display = 'none';
}
function limit(field, chars) {
	if (field.value.length > chars) field.value = field.value.substr(0, chars);
}
</script>
</head>

<body>

<div id="layout_wrapper">
<div id="layout_edgetop"></div>

<div id="layout_container">

	<div id="site_title">

		<h1 class="left"><a href="index.php">You Know You Go to Butcher When...</a></h1>
		<h2 class="right">A site to post your "you know you go to Butcher when..." jokes</h2>

		<div class="clearer">&nbsp;</div>

	</div>

	<div id="top_separator"></div>

		<div id="navigation">

		<div id="tabs">

<?php include('topnav.php'); ?>

			<div class="clearer">&nbsp;</div>

		</div>

	</div>

	<div class="spacer h5"></div>

	<div id="main">

		<div class="left" id="main_left">

			<div id="main_left_content">
