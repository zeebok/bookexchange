<?php

include 'access.php';

$error = mysql_query("select * from Listing where isbn = '$_GET[isbn]' and user_id = '$_SESSION[uid]'");

if(mysql_num_rows($error) == 0)
	header('Location: profile.php');
	
else
{
	$query = "delete from Listing where isbn = '$_GET[isbn]' and user_id = '$_SESSION[uid]'";
	$result = mysql_query($query);
	if(!$result)
	{
		error('Could not remove entry!\\n' . mysql_error());
		header('Location: profile.php');
	}
	
	error('Listing deleted!');
	header('Location: profile.php');
}
?>
