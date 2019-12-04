<?php
define('INCLUDE_CHECK',1);
require('registerfunctions.php');
$page="register";
include('head.php');
if($loggedin) {
echo("You already have an account!");
}
else {
  ?>
				<div class="post">

					<div class="post_title">
					
						<h1 class="left">Register</h1>
						<div class="post_date right"></div>
						<div class="clearer">&nbsp;</div>
						
					</div>
					
					<div class="post_body"><p>
					<form method="post" name="reg" id="reg" action="goregister.php">
					<table border="0" >
					<tr><td style="padding-right:10px;" align="right"><label>Username:</td><td><input type="text" name="uname" id="uname" /></label> (Between 5 and 15 Characters)</td></td></tr>
					<tr><td style="padding-right:10px;" align="right"><label>Password:</td><td><input type="password" name="pass" id="pass" /></label> (Between 5 and 15 Characters)</td></tr>
					<tr><td style="padding-right:10px;" align="right"><label>Confirm Password:</td><td><input type="password" name="pass2" id="pass2" /></label></td></tr>
					<tr><td style="padding-right:10px;" align="right"><label>E-mail Address:</td><td><input type="text" name="email" id="email" /></label></td></td></tr>
					<tr><td style="padding-right:10px;" align="right"><label>First Name:</td><td><input type="text" name="fname" id="fname" /></label></td></tr>
					<tr><td style="padding-right:10px;" align="right"><label>Last Name:</td><td><input type="text" name="lname" id="lname" /></label> (Will not be displayed)</td></tr>
					<tr><td style="padding-right:10px;" align="right">Birthday:</td><td><select id="month" name="month"><option value="0">Month:</option><?=generate_options(1,12,'callback_month')?></select>
    <select id="day" name="day"><option value="0">Day:</option><?=generate_options(1,31)?></select>
	<select id="year" name="year"><option value="0">Year:</option><?=generate_options(date('Y'),1900)?></select></td></tr>
	        </table><br/><br/>
					<img src="captcha.php" /><br/>
					<label>Image Code: <input type="text" name="code" id="code" /></label><br/><br/>
					<input type="submit" value="Register" />
					</form>
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
}
include('nav.php');
?>
<?php
include('foot.php');
?>