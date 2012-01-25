<?php
include_once 'common.php';

ini_set("display_errors", 0);

session_start();

$uid = isset($_POST['uid']) ? $_POST['uid'] : $_SESSION['uid'];
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : $_SESSION['pwd'];
$auth = isset($_SESSION['auth'])? $_SESSION['auth'] : 0;

if(!isset($uid))
{
	?>
	<h1> Login Required </h1>
	<p>Please log in to view this website. If you do not have a login name, you can <a href="register.php">register here</a> and have access to all of the site's features.</p>
	<p><form method="post" action="<?=$_SERVER['PHP_SELF']?>">
		Username: <input type="text" name="uid" /><br />
		Password: <input type="password" name="pwd" /><br />
		<input type="submit" value="Log In" />
	</form></p>
	<?php
	exit;
}

$_SESSION['uid'] = $uid;
$_SESSION['pwd'] = $pwd;
$_SESSION['auth'] = $auth;

dbConnect("booksite");
$query = "select * from Users where user_id = '$uid' and password = '$pwd'";
$result = mysql_query($query) or die(mysql_error());
if(!$result)
{
	error('A database error occured while checking your login details.');
}

if(mysql_num_rows($result) == 0)
{
	unset($_SESSION['uid']);
	unset($_SESSION['pwd']);
	?>
	<h1>Congratulations, you're wrong!</h1>
	<p>You did not provide the correct login credentials. Try again by clicking <a href="<?$_SERVER['PHP_SELF']?>">here</a>. Or if you'd like to register click <a href="register.php">here</a>
	<?php
	exit;
}
$row = mysql_fetch_array($result);
$_SESSION['auth'] = $row['auth_level'];
?>
