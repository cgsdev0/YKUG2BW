<?php
if(!isset($page)) {
die("<html><head><title>ACCESS DENIED</title></head><body><div align='center'><span style='font-weight:bold; font-family:Arial; color:red; font-size:24pt;'>ACCESS DENIED</span></div></body></html>");
}
?>
			</div>

		</div>

		<div class="right" id="main_right">
	
			<div id="sidebar">

				<div class="box">
					<div class="box_title">Login</div>
					<div class="box_body">
					<?php if($loggedin==false) { ?>
						<form method="post" id="login" name="login" action="login.php">
						<div>
							<table class="search">
							<tr>
								<td style="padding-bottom:1px;"><input type="text" value="Username" name="user" id="user" onClick="document.login.user.value='';" /></td>
							</tr>
							<tr>
								<td style="padding-bottom:2px;"><input type="password" value="Password" name="pass" id="pass" onClick="document.login.pass.value='';" /></td>
							</tr>
							<tr>
								<td><input type="image" value="Submit" src="img/button_submit.gif" /></td>
							</tr>
							</table>
						</div>
						</form>
						<?php } else { ?>
						You are logged in as:<br/>
						<?php echo($username); ?><br/>
						<a href="logout.php">Log out</a>
						<?php } ?>
					</div>
					<div class="box_bottom"></div>
				</div>
				
				<div class="box">
					<div class="box_title">Users</div>
					<div class="box_body">
					<?php $usercounterq = mysql_query("SELECT * FROM users");
					$users = mysql_num_rows($usercounterq); 
					$newuserq = mysql_query("SELECT * FROM users ORDER by uid + 0 DESC LIMIT 1"); 
					while($newuserrow = mysql_fetch_array($newuserq)) {
					$newuser=$newuserrow['uname'];
					} ?>
					We have <b><?php echo($users); ?></b> registered member(s).<br/><br/>
					Our newest member is <b><?php echo($newuser); ?></b>
					</div>
					<div class="box_bottom"></div>
				</div>
				
				<div class="box">
					<div class="box_title">Activity</div>
					<div class="box_body">
<?php 
$curtime=time();
$activeuserlist=mysql_query("SELECT * FROM activity WHERE time>$curtime");
if(mysql_num_rows($activeuserlist)==0) {
echo("No users signed in");
}
echo("<table border='0'>");
while($rowaul=mysql_fetch_array($activeuserlist)) {
$lastseen=date("g:i",$rowaul['time']-600);
$hisid=$rowaul['uid'];
$getusername=mysql_query("SELECT * FROM users WHERE uid=$hisid");
while($getusernamerow = mysql_fetch_array($getusername)) {
$username=$getusernamerow['uname'];
}
echo("<tr><td>$username</td><td align='right' style='padding-left:10px;'>$lastseen</td></tr>");
}
echo("</table>");
?>
					</div>
					<div class="box_bottom"></div>
				</div>
				
				
								<div class="box">
					<div class="box_title">Birthdays</div>
					<div class="box_body">
<?php 
$curday=date("j",$curtime);
$curmonth=date("n",$curtime);
$curyear=date("Y",$curtime);
$getbirthdaysq = mysql_query("SELECT * FROM users WHERE bday='$curday' AND bmonth='$curmonth'");
if(mysql_num_rows($getbirthdaysq)==0) {
echo('There are no birthdays today.');
}
else {
echo("<table>");
while($birthdayrow = mysql_fetch_array($getbirthdaysq)) {
$age=$curyear-$birthdayrow['byear'];
echo("<tr><td>".$birthdayrow['uname']."</td><td style='padding-left:7px;'>(".$age.")</td></tr>");
}
echo("</table>");
}

?>
					</div>
					<div class="box_bottom"></div>
				</div>
				
				<div class="box">
				<div class="box_title">Sorting</div>
				<div class="box_body">
				<div align="center">
				<form method="get" id="sortform" name="sortform" action="index.php">
				Sort by: <select name="sort" id="sort">

				<option value="0">Newest</option>
				<option value="3">Oldest</option>
				<option value="1">Highest Rating</option>
				<option value="2">Lowest Rating</option>
				</select>
				<br/>
				<input type="submit" value="Go!" />
				</form>
				</div>
				</div>
				<div class="box_bottom"></div>
				</div>



				<div class="box">
				<div class="box_title">Top Posters <a id="ranklink" href="javascript:showmoreranks();">(Show More)</a></div>
				<div class="box_body">
				<table CELLSPACING=0 width='100%'>
<?php
for($finali=0; $finali<5; $finali++) {
$tpp = $topposter[$finali]['uid'];
$tpc = $topposter[$finali]['posts'];
$gethisname = mysql_query("SELECT * FROM users WHERE uid=$tpp LIMIT 1");
$highlight="";
while($gethisnamer = mysql_fetch_array($gethisname)) {
$tpu = $gethisnamer['uname'];
if($loggedin) {
if(strtolower($tpu)==$usernamelow) {
$highlight = " style='background-color:#B2BEC6;' ";
}
}
}
$tpc2 = 0-$tpc;
echo("<tr$highlight id='rank$finali'><td style='padding-top:1px; padding-right:8px;'>".abs($finali+1).".</td><td style='padding-top:1px; padding-right:4px;'>$tpu</td><td> ($tpc2)</td></tr>");
}
while($finali<sizeof($topposter)) {
$tpp = $topposter[$finali]['uid'];
$tpc = $topposter[$finali]['posts'];
$gethisname = mysql_query("SELECT * FROM users WHERE uid=$tpp LIMIT 1");
while($gethisnamer = mysql_fetch_array($gethisname)) {
$tpu = $gethisnamer['uname'];
}
$tpc2 = 0-$tpc;
echo("<tr id='rank$finali' style=\"display:none;\"><td style='padding-top:1px; padding-right:4px;'>".abs($finali+1).".</td><td style='padding-top:1px; padding-right:4px;'>$tpu</td><td> ($tpc2)</td></tr>");
$finali++;
}
?>
        </table>
				</div>
				<div class="box_bottom"></div>
				</div>
				



			</div>
		</div>

		<div class="clearer">&nbsp;</div>

	</div>