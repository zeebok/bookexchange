<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Book Exchange: Create Book Listing</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<title>Create Book Listing</title>
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
					<form method="get" id="searchform" action="browse.php">
						<fieldset class="search">
							<input type="text" class="box" />
							<button class="btn" title="Submit Search"></button>
						</fieldset>
					</form>
				</li>
			</ul>
		</div>
		<div id="pagebody">
			<?php 

			include'access.php';

			if(!isset($_POST['submit'])):
				//Create new book form
				?>
				<img src="css/createbook.png" style="margin-left:90px"/>
				<p>
					<form class="postlist" method="post" action="<?=$_SERVER['PHP_SELF']?>">
						<table class="listingtable">
							<tr>
								<th scope="row">ISBN</th>
									<td><input type="text" name="isbn" /></td>
							</tr>
								<th scope="row">Title</th>
									<td><input type="text" name="title" /></td>
							</tr>
								<th scope="row">Author</th>
									<td><input type="text" name="author" /></td>
							</tr>
								<th scope="row">Edition</th>
									<td><input type="text" name="edition" /></td>
							</tr>
								<th scope="row">Price</th>
									<td><input type="text" name="price" /></td>
							</tr>
						</table>
						<select name="condition">
							<option selected>Select Condition</option>
							<option value="new">New</option>
							<option value="Like New">Like New</option>
							<option value="good">Good</option>
							<option value="fair">Fair</option>
							<option value="poor">Poor</option>
							<option value="worthless">Worthless</option>
						</select>
						<select name="salereq">
							<option selected>Select Sell or Request</option>
							<option value="Sell">Sell Book</option>
							<option value="Request">Request Book</option>
						</select>
						<input type="submit" name="submit" value="Post Book Listing" />
					</form>
				</p>
				<?php
				
			else:


				if($_POST['isbn']=='' or $_POST['title']=='' or $_POST['author']==''
					or $_POST['edition']=='')
				{
					error('You did not complete the form!');
				}
				
				$query = "select count(*) from Book where isbn = '$_POST[isbn]'";
				$result = mysql_query($query);
				if(!$result)
				{
					error('There was an error querying the database for book listings!');
					die();
				}
				if(mysql_result($result,0,0) == 0)
				{
					//error('This book already exists!');
					$sqlinsert = "insert into Book set isbn = '$_POST[isbn]',
									title = '$_POST[title]', author = '$_POST[author]',
									edition = '$_POST[edition]'";
					if(!mysql_query($sqlinsert))
					{
						error('The following error occurred: ' . mysql_error());
						die();
					}
				}
				
				$newlist = "insert into Listing set isbn = '$_POST[isbn]',
							user_id = '$_SESSION[uid]', price = '$_POST[price]',
							bookcondition = '$_POST[condition]', salereq = '$_POST[salereq]'";
				if(!mysql_query($newlist))
				{
					error('There was an error adding your listing!\\n' . 'Error: ' . mysql_error());
					die();
				}
				
				?>
				<img src="css/approved.png" style="margin-left:40px"/>
				
				<?php
				
				
			endif;	
			?>
		</div>
	</div>
</body>
</html>
