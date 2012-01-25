<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Interstudent Bookstore: Browse</title>
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

if(!isset($_GET['type']) and !isset($_GET['keyword']))
{
	$output = true;
}
elseif((strcmp($_GET['type'], 'user') != 0 and strcmp($_GET['type'], 'book') != 0) and !isset($_GET['keyword']))
{
	$output = true;
}
elseif(strcmp($_GET['type'], 'user') == 0)
{
	if(!isset($_GET['keyword']))
		$userquery = "select * from Users";
	
	else
		$userquery = "select * from Users where user_id like '%$_GET[keyword]%'";
	
}
elseif(strcmp($_GET['type'], 'book') == 0)
{
	if(!isset($_GET['keyword']))
		$bookquery = "select * from Book";
	
	else
		$bookquery = "select * from Book where isbn like '%$_GET[keyword]%' or title like '%$_GET[keyword]%' or author like '%$_GET[keyword]%'";
}
else
{
	$bookquery = "select * from Book where isbn like '%$_GET[keyword]%' or title like '%$_GET[keyword]%' or author like '%$_GET[keyword]%'";
	$userquery = "select * from Users where user_id like '%$_GET[keyword]%'";
}


if($output == true)
{
	?>
	<p>Select what you would like to browse:<br />
	<a href="browse.php?type=book">Books</a><br />
	<a href="browse.php?type=user">Users</a></p>
	<?php
}
else
{
	$bookresult = (isset($bookquery))? mysql_query($bookquery) : false;
	$userresult = (isset($userquery))? mysql_query($userquery) : false;
	if(!$bookresult && !$userresult)
	{
		error('Could not query database!\\n' . mysql_error());
		die(mysql_error());
	}
	
	$num = mysql_num_rows($bookresult) + mysql_num_rows($userresult);
	
	if($num == 0)
	{
		echo "<p>No results found!</p>";
	}
	else
	{
		?>
		
		<?=$num?> results found for <?=$_GET['keyword']?>!<br />
		
		<?php
		if($bookresult)
		{
			?>
			<h3>Books:</h3>
			<table class="prettytable">
			<th>Title</th><th>Author</th><th>Edition</th>
			<?php
			while($row = mysql_fetch_array($bookresult))
			{
				?>
				<tr>
				<td><a href="showbook.php?isbn=<?=$row['isbn']?>"><?=$row['title']?></td>
				<td><?=$row['author']?></td>
				<td><?=$row['edition']?></td>
				</a></tr>
				<?php
			}
			?>
			</table>
			<?php
		}
		
		if($userresult)
		{
			?>
			<h3>Users:</h3>
			<table class="prettytable">
			<?php
			while($row = mysql_fetch_array($userresult))
			{
				?>
				<tr>
				<td><a href="profile.php?user=<?=$row['user_id']?>"><?=$row['user_id']?></td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		}
	}
}
?>
	</div>
</div>
</body>
</html>
