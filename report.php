<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Interstudent Bookstore: Report User</title>
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

		if($_SESSION['auth'] > 0):
		
			$query = "select * from Fraud";
			$result = mysql_query($query);
			if(!$result)
			{
				error('Error occurred loading reports.' . mysql_error());
				die();
			}
			?>
			<h1>Abuse Reports</h1>
			<table class="prettytable">
			<th>User</th><th>Report</th>
			<?php
			while($row = mysql_fetch_array($result))
			{
				?>
				<tr>
				<td><a href="profile.php?user=<?=$row['user_id']?>"><?=$row['user_id']?></a></td>
				<td><?=$row['accusation']?></td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		
		elseif(!isset($_POST['report'])):
			//HTML for sign up
			?>
			<h1>Report a user</h1>
			<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<table class="listingtable">
						<th scope="row">Username</th>
						<td><input type="text" name="user" /></td>
					</tr>
						<th scope="row">Accusation</th>
						<td><input type="text" name="accusation" /></td>
					</tr>
				</table>
				<input type="submit" name="report" value="Report User" />
			</form>
			
			<?php
		else:
		
			
			$query = "insert into Fraud set user_id = '$_POST[user]', accusation = '$_POST[accusation]'";
			
			$result = mysql_query($query);
			if(!$result)
			{
				error('Error occurred sending report.' . mysql_error());
				die(mysql_error());
			}

			
			?>
			<p><b>User reported!</b></p>
			<p>Go back to your <a href="profile.php">profile</a> and get trading.</p>
			<?php
		endif;
		?>
		</div>
	</div>	
</body>
</html>
