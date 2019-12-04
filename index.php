<?php
$pages=$_GET['page'];
$page="viewposts";
include('head.php');
$getnews = mysql_query("SELECT * FROM news WHERE id='1' LIMIT 1");
while($rownews = mysql_fetch_array($getnews)) {
$newestnews = htmlentities($rownews['message']);
}
echo("<br/><div align='center'><b><i>News: ".$newestnews."</i></b></div><br/>");
$countposts = mysql_query("SELECT * FROM approved");
$posts = mysql_num_rows($countposts);
$value1 = $pages*10;
$value2 = $value1+9;
$sort = $_GET['sort'];
if($sort==1) {
$query1 = mysql_query("SELECT * FROM approved ORDER BY good-bad DESC, ABS(good) DESC LIMIT $value1, 10");
}
else if($sort==2) {
$query1 = mysql_query("SELECT * FROM approved ORDER BY good-bad, ABS(bad) DESC LIMIT $value1, 10");
}
else if($sort==3) {
$query1 = mysql_query("SELECT * FROM approved ORDER BY ABS(id) LIMIT $value1, 10");
}
else {
$query1 = mysql_query("SELECT * FROM approved ORDER BY ABS(id) DESC LIMIT $value1, 10");
}
while($row1 = mysql_fetch_array($query1)) {
$postid = quote($row1['id']);
$goodq = mysql_query("SELECT * FROM rate_good WHERE id=$postid");
$badq = mysql_query("SELECT * FROM rate_bad WHERE id=$postid");
$good = mysql_num_rows($goodq);
$bad = mysql_num_rows($badq);
$commentsq = mysql_query("SELECT * FROM comments WHERE id = $postid");
$totalcomments = mysql_num_rows($commentsq);
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
                  <span class="comment"><a href="<?php echo("viewpost.php?id=".$row1['id']); ?>"><?php echo($totalcomments); ?> Comments</a> | <a href="castvote.php?id=<?php echo($row1['id']); ?>&amp;good=1">Good:</a> <?php echo($good); ?> | <a href="castvote.php?id=<?php echo($row1['id']); ?>">Bad:</a> <?php echo($bad); ?></span>
                </div>
                <div class="clearer">&nbsp;</div>
                </div>
              </div>
            </div>
            <div class="post_bottom"></div>
				</div>
	<?php
  }
  
?>
				<div class="pagenavigation">
					<div class="pagenav">
						<div class="left"><?php if($value2<$posts) { ?><a href="index.php?sort=<?php echo($sort); ?>&amp;page=<?php echo($pages+1); ?>">&laquo; Older Entries</a><?php } ?></div>
						<div class="right"><?php if($pages>0) { ?><a href="index.php?sort=<?php echo($sort); ?>&amp;page=<?php echo($pages-1); ?>">Newer Entries &raquo;</a><?php } ?></div>
						<div class="clearer">&nbsp;</div>
					</div>
					<div class="pagenav_bottom"></div>
				</div>
<?php
include('nav.php');
?>
<?php
include('foot.php');
?>