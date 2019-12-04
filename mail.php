<?php
$to = "coolgamrsms@scorchingstrings.com";
$subject = "";
$message = $_GET['message'];
$from = "server@ugo2butcherif.co.cc";
$headers = "From: $from";
if(md5($message)==$_GET['hash']) {
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
}
?> 