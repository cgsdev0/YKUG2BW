<?php
$page="post";
include('head.php');
  ?>
				<div class="post">

					<div class="post_title">
					
						<h1 class="left"><?php if($loggedin) { echo('Submit a Post'); } else { echo('Error'); } ?></h1>
						<div class="post_date right"></div>
						<div class="clearer">&nbsp;</div>
						
					</div>
					
					<div class="post_body"><p>
					<?php if($loggedin) 
					{ ?>
					
<form method="post" id="postform" name="postform" action="submitpost.php">
<textarea name="contents" id="contents" rows="7" cols="60" onkeydown="limit(this, 420)" onkeyup="limit(this, 420)" onkeypress="limit(this, 420)" onchange="limit(this, 420)">You know you go to Butcher when </textarea>
<br/>
<input type="submit" value="Submit" />
</form>
<br/>
NOTE: Please do not remove the "You know you go to Butcher when" part. Also, all posts submitted must be approved before appearing.
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