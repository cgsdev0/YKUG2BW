<?php
$page="functionpage";
include('head2.php');
unset($_SESSION['userid']);
$message='You have been logged out successfully.';
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