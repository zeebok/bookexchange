<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Interstudent Bookstore: Profile</title>
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

include'access.php';

if(!isset($_GET['user']))
	$_GET['user'] = $_SESSION['uid'];

$query = "select * from Users where user_id = '$_GET[user]'";
$result = mysql_query($query);
if(!$result)
{
	error('Error querying database!\\n' . mysql_error());
	die();
}
elseif(mysql_num_rows($result) == 0)
{
	echo "<p>This user does not exist.</p><br />";
}
else
{
	$row = mysql_fetch_array($result);
	?>
	
	<h1><?=$row['user_id']?>'s Profile</h1>
	<p>User ID: <?=$row['user_id']?><br />
	User Email: <?=$row['email']?><br />
	Authorization Level: <?=$row['auth_level']?>
	<br />
	<br />
	
	<?php
	if($_GET['user'] == $_SESSION['uid'])
	{
		echo "<a href=edit.php>Edit Profile</a>";
		echo "<br /><a href=logout.php>Logout</a>";
	}
		
	if($_SESSION['auth'] > 0)
		echo "<br /><a href=report.php>View Reports</a>";	
		
	$query = "select * from Reviews where user_id = '$_GET[user]' or reviewer_id = '$_SESSION[uid]'";
	$result = mysql_query($query);
	if(!$result)
	{
		error('Error retrieving user review!\\n' . mysql_error());
		die();
	}
	elseif(mysql_num_rows($result) == 0)
	{
		echo "<p>This user has no reviews! Be the first to post a <a href='review.php?user=$row[user_id]'>review</a></p>";
	}
	else
	{
		?>
		<h3>Reviews:</h3>
		<table class="prettytable">
		<?php
		while($row = mysql_fetch_array($result))
		{
			?>
			<tr>
			<td>Reviewed by: <a href="profile.php?user=<?=$row['reviewer_id']?>"><?=$row['reviewer_id']?></a></td>
			<td><?=$row['review']?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<br />
		<?php
	}
	
	$query = "select * from Listing natural join Book where user_id = '$_GET[user]'";
	$result = mysql_query($query);
	if(!$result)
	{
		error('Error retrieving user listings!\\n' . mysql_error());
		die();
	}
	elseif(mysql_num_rows($result) == 0)
	{
		echo "<p>This user has no listings!</p>";
	}
	else
	{
		?>
		<h3>Listings:</h3>
		<table class="prettytable">
		<th>Title</th><th>Author</th><th>Condition</th><th>Price</th><th>Type</th><th>Remove?</th>
		<?php
		while($row = mysql_fetch_array($result))
		{
			?>
			<tr>
			<td><a href="showbook.php?isbn=<?=$row['isbn']?>"><?=$row['title']?></a><br /></td>
			<td><?=$row['author']?></td>
			<td><?=$row['bookcondition']?></td>
			<td><?=$row['price']?></td>
			<td><?=$row['salereq']?></td>
			<?php
			if($_GET['user'] == $_SESSION['uid'] or $_SESSION['auth'] > 0)
				echo "<td><a href='remove.php?isbn=$row[isbn]'>X</a></td>";
			?>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
}
?>
	</div>
</div>
</body>
</html>


