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
			<li><a class="profile" href="home.php"></a></li>
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

// IF statement that displays isbn books

$query = "select * from Book where isbn = '$_GET[isbn]'";
$result = mysql_query($query);
if(!$result)
{
	error('Could not query database!\\n' . mysql_error());
	die();
}

$num = mysql_num_rows($result);

if($num == 0)
{
	echo "<p>Could not find the book " . $_GET['isbn'] . "</p><br />";
}
elseif($num > 1)
{
	error('Duplicate book!\\n');
	die();
}
else
{
	$row = mysql_fetch_array($result);
	?>
	<p><b>ISBN:</b> <?=$row['isbn']?><br />
	<b>Title:</b> <?=$row['title']?><br />
	<b>Author:</b> <?=$row['author']?><br />
	<b>Edition:</b> <?=$row['edition']?><br />
	</p>


	<?php
	$query = "select * from Listing natural join Book where isbn = '$_GET[isbn]'";
	$list = mysql_query($query);
	if(!$list)
	{
		error('Could not retrieve listings of this book!\\n' . mysql_error());
		die();
	}
	
	elseif(mysql_num_rows($list) == 0)
	{
		?>
		<p>This book has no listings! Why not post a <a href="createlisting.php">new listing</a>?</p>
		<?php
	}
	else
	{
		?>
		<h3>Listings:</h3>
		<table class="prettytable">
			<tr>
				<th>User</th>
				<th>Condition</th>
				<th>Type</th>
				<th>Price</th>
			</tr>
			<?php
			while($row = mysql_fetch_array($list))
			{
				?>
				<tr>
				<td><a href="profile.php?user=<?=$row['user_id']?>"><?=$row['user_id']?></td>
				<td><?=$row['bookcondition']?></td>
				<td><?=$row['salereq']?></td>
				<td><?=$row['price']?></td>
				</tr>
				<?php
			}
		echo "</table>";
	}
}

?>
		</div>
		
	</div>
</body>
</html>
