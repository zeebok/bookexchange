<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Book Exchange: Register</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Register</title>
</head>

<body>
	<div id="container">
		<div id="header">
			<a class="home" href="home.php"> <img src="css/logo.png"/> </a>
		</div>
		<div id="pagebody">
			<?php

			include("common.php");

			if(!isset($_POST['register'])):
				//HTML for sign up
				?>

				<h1>Sign up here!</h1>
				<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
					<table class="listingtable">
						<tr>
							<th scope="row">User Name</th>
							<td><input type="text" name="username" /></td>
						</tr>
							<th scope="row">Password</th>
							<td><input type="text" name="password" /></td>
						</tr>
							<th scope="row">Email</th>
							<td><input type="text" name="email" /></td>
						</tr>
					</table>
					<input type="submit" name="register" value="Register" />
				</form>
				
				<?php
			else:
			
				dbConnect('ryanzero_booksite');	
				if($_POST['username']=='' or $_POST['password']=='' or $_POST['email']=='')
				{
					error('You did not complete the sign up form.');
				}
				
				$query = "select count(*) from Users where user_id = '$_POST[username]'";
				$result = mysql_query($query);

				if(mysql_result($result,0,0) > 0)
				{
					error('This user already exists!');
					die();
				}
				
				$sqlinsert = "insert into Users set user_id = '$_POST[username]',
								password = '$_POST[password]',
								email = '$_POST[email]',
								auth_level = 0";
				if(!mysql_query($sqlinsert))
				{
					error('The following error occurred: ' . mysql_error());
					die();
				}
				
				?>
				<p><b>User registered!</b></p>
				<p>You can now use this website! Go <a href="home.php">here</a> to get started.</p>
				<?php
			endif;
			?>
		</div>
	</div>	
</body>
</html>