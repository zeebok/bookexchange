<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Interstudent Bookstore: Edit Profile</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="css/index.css" />
</head>

<body>
<div id="container">
	<div id="header">
		<a class="home" href="home.php"> <img src="css/logo.png"/> </a>
	</div>
	<div id="nav">
		<ul>
			<li><a class="profile" href="profile.php"></a></li>
			<li><a class="listing" href="createlisting.php"></a></li>
			<li><a class="browse" href="browse.php"></a></li>
			<li><a class="report" href="report.php"></a></li>
			<li>	
				<form action="browse.php" method="get" id="searchform">
					<fieldset class="search">
						<input type="text" class="box" name="keyword" />
						<button class="btn" type="submit" title="Search!"></button>
					</fieldset>
				</form>
			</li>
		</ul>
	</div>
	<div id="pagebody">
		<?php

		include 'access.php';

		if(!isset($_POST['update'])):
			//HTML for sign up
			?>
			<h1>Update your profile</h1>
			<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<table class="listingtable">
						<th scope="row">Password</th>
						<td><input type="text" name="password" /></td>
					</tr>
						<th scope="row">Email</th>
						<td><input type="text" name="email" /></td>
					</tr>
				</table>
				<input type="submit" name="update" value="Update Profile" />
			</form>
			
			<?php
		else:
		
			$backup = mysql_query("select * from Users where user_id = '$_SESSION[uid]'");
			$row = mysql_fetch_array($backup);
			
			$pass = ($_POST['password']=='')? $row['password'] : $_POST['password'];
			$email = ($_POST['email']=='')? $row['email'] : $_POST['email'];
			
			$query = "update Users set password = '$pass', email = '$email' where user_id = '$_SESSION[uid]'";
			
			$result = mysql_query($query);
			if(!$result)
			{
				error('Error occurred updating profile.' . mysql_error());
				die(mysql_error());
			}

			
			?>
			<p><b>Profile updated!</b></p>
			<p>View your <a href="profile.php">new profile</a> and get trading.</p>
			<?php
		endif;
		?>
		</div>
	</div>	
</body>
</html>
