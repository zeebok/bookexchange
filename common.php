<?php

$dbhost = 'localhost';
$dbuser = 'username';
$dbpass = 'password';

function dbConnect($db='') {
    global $dbhost, $dbuser, $dbpass;
    
    $dbcnx = mysql_connect($dbhost, $dbuser, $dbpass)
        or die('The site database appears to be down.');

    if ($db!='' and !mysql_select_db($db))
        die('The site database is unavailable.');
    
    return $dbcnx;
}

function error($msg) {
    ?>
    <html>
    <head>
    <script language="JavaScript">
        alert("<?=$msg?>");
        history.back();
    </script>
    </head>
    <body>
    </body>
    </html>
    <?
    exit;
}
?>