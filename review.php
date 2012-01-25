<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Book Exchange: Browse</title>
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

session_start();
include'access.php';

if(!isset($_GET['user']) or ($_GET['user'] == $_SESSION['uid'])):

	?>
	HTML of no user selected with something
	<?php

else:

	?>
	<form method="post" action="post.php?user=<?=$_GET['user']?>">
		Review for <?=$_GET['user']?>:<br />
		<input type="text" name="review" />
		<select name="salereq">
			<option value="Sell" selected>Sold Book</option>
			<option value="Request">Requested Book</option>
		</select>
		<input type="submit" value="Submit Review" />
	</form>
	<?php
	
endif;
?>
	</div>
</div>
</body>
</html>
	
