<?php
$page="approve";
include('head.php');
  ?>
				<div class="post">

					<div class="post_title">
					
						<h1 class="left"><?php if($mod) { echo('Post Approved/Disapproved'); } else { echo('Error'); } ?></h1>
						<div class="post_date right"></div>
						<div class="clearer">&nbsp;</div>
						
					</div>
					
					<div class="post_body"><p>
					<?php if($mod) 
					{ $time=$_POST['time'];
          if($_POST['yes']=="Approve") 
          { 
          $postcountq = mysql_query("SELECT * FROM approved");
          $postcount = mysql_num_rows($postcountq);
          $info = mysql_query("SELECT * FROM waiting where time=$time");
          while($rowinfo = mysql_fetch_array($info)) {
          $posterid = $rowinfo['posterid'];
          $posterip = $rowinfo['posterip'];
          $content = quote($rowinfo['content']);
          }
          if(!mysql_query("INSERT into approved (posterid, posterip, approverid, id, content, time) VALUES ($posterid, '$posterip', $userid, $postcount, $content, $time)")) {
            die('Error: ' . mysql_error());
          }
          mysql_query("DELETE FROM waiting WHERE time=$time");
          echo('The post has been approved.'); 
          } 
          else if($_POST['no']=="Disapprove") 
					{ 
					mysql_query("DELETE FROM waiting WHERE time=$time");
					echo('The post has been disapproved.'); 
					}
} else { echo('You must be logged in to use this feature.'); } ?>
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