<?php

session_start();
include 'access.php';

if(empty($_GET['user'])):

	header('Location: home.php');
	
else:

$query = "insert into Reviews set user_id = '$_GET[user]', reviewer_id = '$_SESSION[uid]', salereq = '$_POST[salereq]', review = '$_POST[review]'";

$result = mysql_query($query);
if(!$result)
{
	error('A database error occured while submitting your review.');
}

header('Location: profile.php?user="$_GET[user]"');

endif;
?>
