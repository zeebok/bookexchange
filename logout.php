<?php

include 'access.php';

unset($_SESSION['uid']);
unset($_SESSION['pwd']);
unset($_SESSION['auth']);
session_destroy();

header('Location: home.php');

?>
