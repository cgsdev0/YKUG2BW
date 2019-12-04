<?php
if(!isset($page)) {
die("<html><head><title>ACCESS DENIED</title></head><body><div align='center'><span style='font-weight:bold; font-family:Arial; color:red; font-size:24pt;'>ACCESS DENIED</span></div></body></html>");
}
?>
			<ul>
				<li<?php if($page=="viewposts") { echo(' class="current_page_item"'); } ?>><a href="index.php"><span>View Posts</span></a></li>
				<?php if($loggedin==true) { echo('<li'); if($page=="post") { echo(' class="current_page_item"'); } echo('><a href="post.php"><span>Submit a Post</span></a></li>'); } ?>
				<?php if($mod==true) { echo('<li'); if($page=="approve") { echo(' class="current_page_item"'); } echo('><a href="approve.php"><span>Approve Posts</span></a></li>'); } ?>
				<?php if($loggedin==false) { echo('<li'); if($page=="register") { echo(' class="current_page_item"'); } echo('><a href="register.php"><span>Register</span></a></li>'); } ?>
			</ul>