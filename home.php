<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Clarkson Book Exchange: Home</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="css/index2.css"/>
	<title>Home</title>
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
			<img src="css/hello.png"/>
			<a class="register" href="register.php" style="margin: auto auto"></a>
			<a class="login" href="profile.php" style="margin: auto auto"></a>
			
		</div>
	</div>
</body>
</html>
