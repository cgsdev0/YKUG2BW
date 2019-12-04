<?php
//removing quotes from inputs
//shasch80
//4196152
//schul030_butcher
//*****
$error2 = 0;
$mysql2=mysql_connect("scorchingstrings.com","schul030_butcher","*****");
if(!$mysql2) 
  {
  $error2 = 1;
  }
if($error2==0) {
mysql_select_db("schul030_butcher",$mysql2);
}
//check for new messages
$mailbox="{mail.scorchingstrings.com:110/pop3/notls}";
$conn = imap_open($mailbox, 'butcher@scorchingstrings.com', '*****');
$headers = @imap_headers($conn);

if(!$headers) {
//No email
}
else {

$numEmails = sizeof($headers);

//how many emails you have

for($i = 1; $i < $numEmails+1; $i++)

{

$mailHeader = @imap_headerinfo($conn, $i);

$from = $mailHeader->fromaddress;

$subject = strip_tags($mailHeader->subject);

$date = $mailHeader->date;

if(strtolower($from)=="CENSORED@vtext.com") {
$cleansedstring = str_replace("shane","",$subject);
$answer = ereg_replace("[^A-Za-z]", "", $cleansedstring);
$id = ereg_replace("[^0-9]", "", $cleansedstring);
if(strtolower($answer=="yes")) {
          $postcountq = mysql_query("SELECT * FROM approved");
          $postcount = mysql_num_rows($postcountq);
          $info = mysql_query("SELECT * FROM waiting where tempid='$id'");
          if(mysql_num_rows($info)>0) {
          while($rowinfo = mysql_fetch_array($info)) {
          $posterid = $rowinfo['posterid'];
          $posterip = $rowinfo['posterip'];
          $time = $rowinfo['time'];
          $content = quote($rowinfo['content']);
          }
          if(!mysql_query("INSERT into approved (posterid, approverid, id, content, time) VALUES ('$posterid', '0', '$postcount', $content, '$time')")) {
//we have a mysql error, oh well
exit;
          }
          mysql_query("DELETE FROM waiting WHERE tempid=$id");
//Post approved
          }
}
else if(strtolower($answer=="no")) {
					mysql_query("DELETE FROM waiting WHERE tempid=$id");
//post disapproved
}
imap_delete($conn,$i);
imap_expunge($conn);
}
else {
imap_delete($conn,$i);
imap_expunge($conn);
}

}
}
imap_close($conn);
mysql_close($mysql2);
?>