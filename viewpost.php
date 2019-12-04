<?php
$page="viewposts";
include('head.php');
$postid = quote($_GET['id']);
$commentsq = mysql_query("SELECT * FROM comments WHERE id = $postid ORDER by time");
$totalcomments = mysql_num_rows($commentsq);
$query1 = mysql_query("SELECT * FROM approved where id=$postid");
while($row1 = mysql_fetch_array($query1)) {
$goodq = mysql_query("SELECT * FROM rate_good WHERE id=$postid");
$badq = mysql_query("SELECT * FROM rate_bad WHERE id=$postid");
$good = mysql_num_rows($goodq);
$bad = mysql_num_rows($badq);
  ?>
				<div class="post">

					<div class="post_title">
					
						<h1 class="left"><a href="<?php echo("viewpost.php?id=".$row1['id']); ?>">#<?php echo($row1['id']); ?></a></h1>
						<div class="post_date right"><?php echo(date("F jS, Y",$row1['time'])); ?></div>
						<div class="clearer">&nbsp;</div>
						
					</div>
					
					<div class="post_body"><p>
					<?php echo(str_replace("\n","<br/>",htmlentities($row1['content']))); ?>
					</p>
					
            <div class="post_metadata">
              <div class="content">
                <div class="left">
                  Posted by <?php $query3 = mysql_query("SELECT * FROM users WHERE uid='$row1[posterid]'"); while($row3 = mysql_fetch_array($query3)) { echo($row3['uname']." (".$row3['fname'].")"); } if(mysql_num_rows($query3)==0) { echo("Unknown"); }?>
                </div>
                <div class="right">
                  <span class="comment"><a href="<?php echo("viewpost.php?id=".$row1['id']); ?>"><?php echo($totalcomments); ?> Comments</a> | <a href="castvote.php?id=<?php echo($row1['id']); ?>&good=1">Good:</a> <?php echo($good); ?> | <a href="castvote.php?id=<?php echo($row1['id']); ?>">Bad:</a> <?php echo($bad); ?></span>
                </div>
                <div class="clearer">&nbsp;</div>
                </div>
              </div>
            </div>
            <div class="post_bottom"></div>
				</div>
	<?php
  } if($totalcomments>0) { ?> 
    				<div class="post" id="comments">
    									<div class="post_title">
						<h1><?php echo($totalcomments);  ?> Responses</h1>
					</div>
  					<div class="post_body nicelist">

						<ol>
  <?php $i=0; while($commentsrow=mysql_fetch_array($commentsq)) { $thistime=$commentsrow['time']; ?>
					




							<li <?php if(($i % 2)==0) echo("class='alt'"); ?> id="comment-<?php echo($thistime); ?>">
								
								<div class="comment_gravatar left">
									<img alt="" src="img/sample-gravatar.jpg" height="32" width="32" />
								</div>
								
								<div class="comment_author left">
									<span class="comment"><a href="#"><?php $getcommentname = mysql_query("SELECT * FROM users WHERE uid='$commentsrow[uid]'"); while($rowgetcommentname = mysql_fetch_array($getcommentname)) { echo($rowgetcommentname['uname']); } ?></a> <?php if($mod) { ?><a href="deletecomment.php?id=<?php echo($thistime); ?>">(Delete Comment)</a><?php } ?></span>
									<div class="date"><?php echo(date("F jS, Y",$thistime)); ?></div>
								</div>

								<div class="clearer">&nbsp;</div>
								
								<div class="body">									
									<p><?php echo(str_replace("\n","<br/>",htmlentities($commentsrow['content']))); ?></p>
								</div>
				
							</li>			

<?php $i++; } ?>
						</ol>

					</div>
					</div>

<?php } if($loggedin) { ?>
				<div class="post" id="respond">

					<div class="post_title"><h1>Leave a Reply</h1></div>

					<div class="post_body">

						<form action="leavecomment.php" method="post" id="commentform">

							<p>Feel free to share your thoughts about this entry.</p>

							<p><textarea name="comment" id="comment" cols="60" rows="7" tabindex="1" onkeydown="limit(this, 420)" onkeyup="limit(this, 420)" onkeypress="limit(this, 420)" onchange="limit(this, 420)"></textarea></p>

							<p><input type="image" src="img/button_submit.gif" tabindex="2" /></p>
							<input type="hidden" name="id" id="id" value="<?php echo($_GET['id']); ?>" />

						</form>

					</div>

					<div class="post_bottom"></div>

				</div>
<?php }
include('nav.php');
?>
<?php
include('foot.php');
?>