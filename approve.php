<?php
$page="approve";
include('head.php');
  ?>
				<div class="post">

					<div class="post_title">
					
						<h1 class="left"><?php if($mod) { echo('Approve Posts'); } else { echo('Error'); } ?></h1>
						<div class="post_date right"></div>
						<div class="clearer">&nbsp;</div>
						
					</div>
					
					<div class="post_body"><p>
					<?php if($mod) 
					{ ?>
					
<form method="post" id="postform" name="postform" action="submitapprove.php">
<?php $queryapprove = mysql_query("SELECT * FROM waiting ORDER BY time LIMIT 1");
while($rowapprove = mysql_fetch_array($queryapprove)) {
echo("<input type='hidden' id='time' name='time' value='".$rowapprove['time']."' />");
echo(str_replace("\n","<br/>",htmlentities($rowapprove['content'])));
}
if(mysql_num_rows($queryapprove)==0) {
echo("No entries in quene.<br/>");
}
else {
?>
<br/>
<input type="submit" id="yes" name="yes" value="Approve" />
<input type="submit" id="no" name="no" value="Disapprove" />
</form>
<br/>
					<?php } } else { echo('You must be an administrator to use this feature.'); } ?>
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