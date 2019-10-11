<?php
$dbh = new PDO('mysql:dbname=centre;host=localhost', 'root', '');
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
?>