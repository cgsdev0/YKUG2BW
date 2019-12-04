<?php
$page="post";
include('head.php');
  ?>
				<div class="post">

					<div class="post_title">
					
						<h1 class="left"><?php if($loggedin) { echo('Post submitted!'); } else { echo('Error'); } ?></h1>
						<div class="post_date right"></div>
						<div class="clearer">&nbsp;</div>
						
					</div>
					
					<div class="post_body"><p>
					<?php if($loggedin) 
					{ 
					$content = quote($_POST['contents']);
					$ip = str_replace("."," ",$_SERVER['REMOTE_ADDR']);
					$time = time();
					$getnewid = mysql_query("SELECT * FROM totalsubmitted");
					while($rowgetnewid = mysql_fetch_array($getnewid)) {
					$newid=$rowgetnewid['amount'];
					$newid2=$newid+1;
					mysql_query("UPDATE totalsubmitted SET amount = '$newid2' WHERE amount='$newid'");
					}
					if(!mysql_query("INSERT into waiting (posterid, posterip, content, time, tempid) VALUES ($userid, '$ip', $content, $time, $newid)")) {
  die('Error: ' . mysql_error());
					}
					?>
					<?php
$to      = 'CENSORED@vzwpix.com';
$subject = date("g:i a",$time);
$message = '"'.$username.': '.str_replace('\"','"',str_replace("\'","'",$_POST['contents'])).'" To approve this, either go online or reply with the code '.$newid.' and the word yes or no.';
$headers = "From: butcher@scorchingstrings.com";
mail($to, $subject, $message, $headers);
?>
					Thanks! Your post has been submitted!
					<?php } else { echo('You must be logged in to use this feature.'); } ?>
					</p>
					
            <div class="post_metadata">
              <div class="content">
                <div class="left">
                </div>
                <div class="right">
                </div>
                <div class="clearer">&nbsp;</div>
                </div>
              </div>
            </div>
            <div class="post_bottom"></div>
				</div>
<?php
include('nav.php');
?>
<?php
include('foot.php');
?>